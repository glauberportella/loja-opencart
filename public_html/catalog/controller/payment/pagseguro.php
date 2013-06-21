<?php
class ControllerPaymentPagseguro extends Controller {
 	protected function index() {
	
		$this->language->load('payment/pagseguro');
		
	    $this->data['button_confirm'] = $this->language->get('button_confirm_pagseguro');
	    $this->data['text_information'] =  $this->language->get('text_information');
	    $this->data['text_wait'] = $this->language->get('text_wait');		
	
		require_once(DIR_SYSTEM . 'library/PagSeguroLibrary/PagSeguroLibrary.php');
		
		// Altera a codificação padrão da API do PagSeguro (ISO-8859-1)
		PagSeguroConfig::setApplicationCharset('UTF-8');
		
		$mb_substr = (function_exists("mb_substr")) ? true : false;
		
    	$this->load->model('checkout/order');
	    $order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);		
		
		$paymentRequest = new PagSeguroPaymentRequest();
		
		/* 
		 * Dados do cliente
		 */
		 
		// Ajuste no nome do comprador para o máximo de 50 caracteres exigido pela API
		$customer_name = trim($order_info['payment_firstname']) . ' ' . trim($order_info['payment_lastname']);
		
		if($mb_substr){
			$customer_name = mb_substr($customer_name, 0, 50, 'UTF-8');
		}
		else{
			$customer_name = utf8_encode(substr(utf8_decode($customer_name), 0, 50));
		}
		
		$paymentRequest->setCurrency($order_info['currency_code']);
		$paymentRequest->setSenderName($customer_name);
		$paymentRequest->setSenderEmail(trim($order_info['email'])); // há limitação de 60 caracteres de acordo com a API
		
		// OpenCart não separa o DDD do número do telefone. Assim, tentamos separá-los, mas somente se o telefone obedecer ao padrão de 10 dígitos
		$telefone = preg_replace ("/[^0-9]/", '', $order_info['telephone']);
		
		if(strlen($telefone) == 10) {
			$paymentRequest->setSenderPhone(substr($telefone, 0, 2),  substr($telefone, 2, strlen($telefone) - 1)); 
		}
  
	    /* 
	     * Frete
	     */
	    
		$tipo_frete = $this->config->get('pagseguro_tipo_frete');
		
		if($tipo_frete){
			$paymentRequest->setShippingType($tipo_frete);	    	
	    }
	    else{
	    	$paymentRequest->setShippingType(3); // 3: Não especificado
	    }		
 		
		$this->load->model('localisation/zone');
	    
	   	if ($this->cart->hasShipping()) {

			$zone = $this->model_localisation_zone->getZone($order_info['shipping_zone_id']);
			
			// Endereço para entrega		
			$paymentRequest->setShippingAddress(  
				Array(  
					'postalCode'=> preg_replace ("/[^0-9]/", '', $order_info['shipping_postcode']),
					'street' 	=> $order_info['shipping_address_1'],     
					'number' 	=> '', // Não há este campo no OpenCart
					'complement'=> '', // Não há este campo no OpenCart
					'district' 	=> $order_info['shipping_address_2'],         
					'city' 		=> $order_info['shipping_city'],        
					'state' 	=> (isset($zone['code'])) ? $zone['code'] : '',       
					'country' 	=> $order_info['shipping_iso_code_3']
				)  
			);
		}
		else{
			$zone = $this->model_localisation_zone->getZone($order_info['payment_zone_id']);
			
			// Endereço para entrega		
			$paymentRequest->setShippingAddress(  
				Array(  
					'postalCode'=> preg_replace ("/[^0-9]/", '', $order_info['payment_postcode']),
					'street' 	=> $order_info['payment_address_1'],     
					'number' 	=> '', // Não há este campo no OpenCart
					'complement'=> '', // Não há este campo no OpenCart
					'district' 	=> $order_info['payment_address_2'],         
					'city' 		=> $order_info['payment_city'],        
					'state' 	=> (isset($zone['code'])) ? $zone['code'] : '',       
					'country' 	=> $order_info['payment_iso_code_3']
				)  
			);			
		}	   	

		/*
		 * Produtos
		 */
		
 		foreach ($this->cart->getProducts() as $product) {
			$options_names = '';
	    	
			foreach ($product['option'] as $option) {
	    		$options_names .= '/'.$option['name'];
	    	}
			// limite de 100 caracteres para a descrição do produto
			if($mb_substr){
				$description = mb_substr($product['model'].'-'.$product['name'].$options_names, 0, 100, 'UTF-8');
			}
			else{
				$description = utf8_encode(substr(utf8_decode($product['model'].'-'.$product['name'].$options_names), 0, 100));
			}
			
	    	$item = Array(
				'id' => $product['product_id'],
				'description' => $description,
				'quantity' => $product['quantity'],
				'amount' => $this->currency->format($product['price'], $order_info['currency_code'], false, false)
			);
			
			// O frete será calculado pelo PagSeguro.
			if($tipo_frete){
				$peso = $this->getPesoEmGramas($product['weight_class_id'], $product['weight'])/$product['quantity'];
				$item['weight'] = round($peso);
			}

			$paymentRequest->addItem($item);
	    }
	    
	    // Referência do pedido no PagSeguro
 		if($this->config->get('pagseguro_posfixo') != ""){
	    	$paymentRequest->setReference($this->session->data['order_id']."_".$this->config->get('pagseguro_posfixo'));
	    }
	    else{
			$paymentRequest->setReference($this->session->data['order_id']);
	    }	    

		// url para redirecionar o comprador ao finalizar o pagamento
		$paymentRequest->setRedirectUrl($this->url->link('checkout/success'));		
	    
	    // obtendo frete, descontos e taxas 
		$total = $this->currency->format($order_info['total'] - $this->cart->getSubTotal(), $order_info['currency_code'], false, false);

		if ($total > 0) {
	    	$item = Array(
				'id' 			=> 'extra_amount',
				'description' 	=> $this->language->get('text_extra_amount'),
				'quantity' 		=> 1,
				'amount' 		=> $total
			);
			$paymentRequest->addItem($item);			
		} 
		else if($total < 0) {
			$paymentRequest->setExtraAmount($total);
		}  
	    
	   	/* 
	   	 * Fazendo a chamada para a API de Pagamentos do PagSeguro. 
	   	 * Se tiver sucesso, retorna o código (url) de requisição para este pagamento.
	   	 */
		try {
			$credentials = new PagSeguroAccountCredentials($this->config->get('pagseguro_email'), $this->config->get('pagseguro_token'));
			$url = $paymentRequest->register($credentials);
			$this->data['url'] = $url;

		} catch (PagSeguroServiceException $e) {
			$this->log->write('PagSeguro: '.$e->getMessage());
			die($e->getMessage());
		}		
		
	    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/pagseguro.tpl')) {
	    	$this->template = $this->config->get('config_template') . '/template/payment/pagseguro.tpl';
	    }
	    else{
	      	$this->template = 'default/template/payment/pagseguro.tpl';
	    }	
			
	    $this->render();
	  }
		
	public function confirm() {
	    
		$this->load->model('checkout/order');
		
    	$this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('pagseguro_order_aguardando_retorno'));
    	/*
    	$this->cart->clear();
    		
    	unset($this->session->data['shipping_method']);
    	unset($this->session->data['shipping_methods']);
    	unset($this->session->data['payment_method']);
    	unset($this->session->data['payment_methods']);
    	unset($this->session->data['guest']);
    	unset($this->session->data['comment']);
    	unset($this->session->data['order_id']);
    	unset($this->session->data['coupon']);
    	unset($this->session->data['voucher']);
    	unset($this->session->data['vouchers']);
		*/    	
	}
			
	public function callback() {
		
		require_once(DIR_SYSTEM . 'library/PagSeguroLibrary/PagSeguroLibrary.php');
		
		$code = (isset($_POST['notificationCode']) && trim($_POST['notificationCode']) !== ""  ? trim($_POST['notificationCode']) : null);
    	$type = (isset($_POST['notificationType']) && trim($_POST['notificationType']) !== ""  ? trim($_POST['notificationType']) : null);
    	
    	if($code && $type) {

    		$notificationType = new PagSeguroNotificationType($type);
    		$strType = $notificationType->getTypeFromValue();
    		
    		switch($strType) {
				
				case 'TRANSACTION':
					
    				$credentials = new PagSeguroAccountCredentials($this->config->get('pagseguro_email'), $this->config->get('pagseguro_token'));
										
    		    	try {
			    		$transaction = PagSeguroNotificationService::checkTransaction($credentials, $code);
			    		
			    		$transactionStatus	= $transaction->getStatus();
			    		$id_pedido 			= explode('_', $transaction->getReference());
			    		$paymentMethod 		= $transaction->getPaymentMethod();
			    		$parcelas 			= $transaction->getInstallmentCount();
						$pagSeguroShipping 	= $transaction->getShipping(); 
						  
						$this->load->model('checkout/order');
						$order = $this->model_checkout_order->getOrder($id_pedido[0]);
						
						// Obtendo o tipo de pagamento escolhido
						$payment_code = $paymentMethod->getCode();
    		    		$comment = "Tipo de pagamento: ".$payment_code->getTypeFromValue()." / Parcelas: ".$parcelas . "\n\n";
    		    		
    		    		// Obtendo o tipo e o valor do frete
						$pagSeguroShippingType = $pagSeguroShipping->getType(); 
						$valor_frete = $pagSeguroShipping->getCost();
						
						// Valor 1: Pac, valor 2: Sedex, valor 3: não especificado ou cálculo não realizado pelo PagSeguro
    		    		if($pagSeguroShippingType->getValue() != 3){
    		    			$comment .= "Tipo de frete escolhido no PagSeguro: ".$pagSeguroShippingType->getTypeFromValue()." / Valor: ".$this->currency->format($valor_frete, $order['currency_code'], false, false);
    		    		}
	    
					    $update_status_alert = false;
					    if($this->config->get('pagseguro_update_status_alert')){
					    	$update_status_alert = true;
					    }
					    
						switch($transactionStatus->getTypeFromValue()){
				
							case 'WAITING_PAYMENT':
								if ($order['order_status_id'] == '0') {
									$this->model_checkout_order->confirm($id_pedido[0], $this->config->get('pagseguro_order_aguardando_pagamento'), $comment);
								}
								else if($order['order_status_id'] != $this->config->get('pagseguro_order_aguardando_pagamento')){
									$this->model_checkout_order->update($id_pedido[0], $this->config->get('pagseguro_order_aguardando_pagamento'), $comment, $update_status_alert);
								}
								break;
											
							case 'IN_ANALYSIS':
								if($order['order_status_id'] != $this->config->get('pagseguro_order_analise')){
									$this->model_checkout_order->update($id_pedido[0], $this->config->get('pagseguro_order_analise'), '', $update_status_alert);
								}
								break;
							
							case 'PAID':
								if($order['order_status_id'] != $this->config->get('pagseguro_order_paga')){
									$this->model_checkout_order->update($id_pedido[0], $this->config->get('pagseguro_order_paga'), '', $update_status_alert);
								}
								break;
							case 'AVAILABLE':
								if($order['order_status_id'] != $this->config->get('pagseguro_order_disponivel')){
									$this->model_checkout_order->update($id_pedido[0], $this->config->get('pagseguro_order_disponivel'), '', false);
								}
								break;
							case 'IN_DISPUTE':
								if($order['order_status_id'] != $this->config->get('pagseguro_order_disputa')){
									$this->model_checkout_order->update($id_pedido[0], $this->config->get('pagseguro_order_disputa'), '', $update_status_alert);
								}
								break;
							case 'REFUNDED':
								if($order['order_status_id'] != $this->config->get('pagseguro_order_devolvida')){
									$this->model_checkout_order->update($id_pedido[0], $this->config->get('pagseguro_order_devolvida'), '', $update_status_alert);
								}
								break;
							case 'CANCELLED':
								if($order['order_status_id'] != $this->config->get('pagseguro_order_cancelada')){
									$this->model_checkout_order->update($id_pedido[0], $this->config->get('pagseguro_order_cancelada'), '', $update_status_alert);
								}
								break;																																
						}						
			    		
			    	} catch (PagSeguroServiceException $e) {
			    		$this->log->write('PagSeguro: '.$e->getMessage());
			    		//die($e->getMessage());
			    	}					
					break;
				
				default:
					$this->log->write('PagSeguro: tipo de notificação desconhecido ['.$notificationType->getValue().']');
			}    		
    	}
    	else{
    		$this->log->write('PagSeguro: Parâmetros de notificação inválidos.');
    	}	
	}
	
	private function getPesoEmGramas($weight_class_id, $peso){
		
		if($this->weight->getUnit($weight_class_id) == 'g'){
			return $peso;
		}
		return $peso * 1000;
	}
}
?>
