<?php
class ControllerPaymentBoletoBradesco extends Controller {
  protected function index() {
    $this->data['button_confirm'] = 'Confirmar';
	$this->data['button_back'] = 'Voltar';

	
	$this->load->model('checkout/order');
	$order_info = $this->model_checkout_order->getOrder($this->session->data['order_id']);
    $this->data['pedido'] = $order_info['order_id'];
	
	$this->data['desconto'] = $this->config->get('boletobradesco_desconto');
	$this->data['valorpedido'] = $order_info['total'];
	
    $this->data['back'] = HTTPS_SERVER . 'index.php?route=checkout/payment';
    $this->data['continue'] = HTTPS_SERVER . 'index.php?route=checkout/success';
    if ($this->request->get['route'] != 'checkout/guest_step_3') {
 	 $this->data['back'] = HTTPS_SERVER . 'index.php?route=checkout/payment';
    } else {
      $this->data['back'] = HTTPS_SERVER . 'index.php?route=checkout/guest_step_2';
    }	
    $this->id = 'payment';
    if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/boletobradesco.tpl')) {
	  $this->template = $this->config->get('config_template') . '/template/payment/boletobradesco.tpl';
	} else {
	  $this->template = 'default/template/payment/boletobradesco.tpl';
	}	
	$this->render();
  }

  public function confirm() {
		$this->load->library('encryption');
		
		$encryption = new Encryption($this->config->get('config_encryption'));
		$order_id = $encryption->encrypt($this->session->data['order_id']);

		$this->load->model('checkout/order');

		$comment  = "Boleto Bancario Gerado\n";
		$comment .= "Aguardando Confirmacao de Pagamento.\n";
		
		$this->model_checkout_order->confirm($this->session->data['order_id'], $this->config->get('boletobradesco_padrao'), $comment);
		
		if (isset($this->session->data['order_id'])) { //Limpa a sessão
			$this->cart->clear();
			
			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['comment']);
			unset($this->session->data['order_id']);	
			unset($this->session->data['coupon']);
		}
		
        $ouput = "<script>window.location = 'index.php';</script>";  

		
		$this->response->setOutput($ouput);
	}
	
	
	
	
  
}
?>

