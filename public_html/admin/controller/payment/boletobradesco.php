<?php 
class ControllerPaymentBoletoBradesco extends Controller {
private $error = array(); 

public function index() {
$this->document->setTitle('Boleto Banco Bradesco');
$this->load->model('setting/setting');

if ($this->request->server['REQUEST_METHOD'] == 'POST') {
$this->load->model('setting/setting');
$this->model_setting_setting->editSetting('boletobradesco', $this->request->post);				
$this->session->data['success'] = 'Dados foram salvos com sucesso!';
$this->redirect(HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token']);
}

if (isset($this->error['warning'])) {
$this->data['error_warning'] = $this->error['warning'];
} else {
$this->data['error_warning'] = '';
}

if (isset($this->error['email'])) {
$this->data['error_email'] = $this->error['email'];
} else {
$this->data['error_email'] = '';
}
		
if (isset($this->error['encryption'])) {
$this->data['error_encryption'] = $this->error['encryption'];
} else {
$this->data['error_encryption'] = '';
}

$this->data['breadcrumbs'] = array();

$this->data['breadcrumbs'][] = array(
 'href'      => HTTPS_SERVER . 'index.php?route=common/home',
 'text'      => 'Inicial',
 'separator' => FALSE
 );

$this->data['breadcrumbs'][] = array(
 'href'      => HTTPS_SERVER . 'index.php?route=extension/payment',
 'text'      => 'Pagamentos',
 'separator' => ' :: '
 );

$this->data['breadcrumbs'][] = array(
 'href'      => HTTPS_SERVER . 'index.php?route=payment/boletobradesco',
 'text'      => 'Boleto Bradesco',
 'separator' => ' :: '
 );
				
$this->data['action'] = HTTPS_SERVER . 'index.php?route=payment/boletobradesco&token=' . $this->session->data['token'];
		
$this->data['cancel'] = HTTPS_SERVER . 'index.php?route=extension/payment&token=' . $this->session->data['token'];

$this->load->model('localisation/order_status');
		
if (isset($this->request->post['boletobradesco_sort_order'])) {
$this->data['boletobradesco_sort_order'] = $this->request->post['boletobradesco_sort_order'];
} else {
$this->data['boletobradesco_sort_order'] = $this->config->get('boletobradesco_sort_order'); 
}

if (isset($this->request->post['boletobradesco_nome'])) {
$this->data['boletobradesco_nome'] = $this->request->post['boletobradesco_nome'];
} else {
$this->data['boletobradesco_nome'] = $this->config->get('boletobradesco_nome'); 
} 

if (isset($this->request->post['boletobradesco_status'])) {
$this->data['boletobradesco_status'] = $this->request->post['boletobradesco_status'];
} else {
$this->data['boletobradesco_status'] = $this->config->get('boletobradesco_status'); 
} 


if (isset($this->request->post['boletobradesco_desconto'])) {
$this->data['boletobradesco_desconto'] = $this->request->post['boletobradesco_desconto'];
} else {
$this->data['boletobradesco_desconto'] = $this->config->get('boletobradesco_desconto'); 
}  

if (isset($this->request->post['boletobradesco_padrao'])) {
$this->data['boletobradesco_padrao'] = $this->request->post['boletobradesco_padrao'];
} else {
$this->data['boletobradesco_padrao'] = $this->config->get('boletobradesco_padrao'); 
} 

$this->data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

if (isset($this->request->post['boletobradesco_geo_zone_id'])) {
$this->data['boletobradesco_geo_zone_id'] = $this->request->post['boletobradesco_geo_zone_id'];
} else {
$this->data['boletobradesco_geo_zone_id'] = $this->config->get('boletobradesco_geo_zone_id'); 
} 

if (isset($this->request->post['boletobradesco_cedente'])) {
$this->data['boletobradesco_cedente'] = $this->request->post['boletobradesco_cedente'];
} else {
$this->data['boletobradesco_cedente'] = $this->config->get('boletobradesco_cedente'); 
} 

if (isset($this->request->post['boletobradesco_agencia'])) {
$this->data['boletobradesco_agencia'] = $this->request->post['boletobradesco_agencia'];
} else {
$this->data['boletobradesco_agencia'] = $this->config->get('boletobradesco_agencia'); 
} 

if (isset($this->request->post['boletobradesco_conta'])) {
$this->data['boletobradesco_conta'] = $this->request->post['boletobradesco_conta'];
} else {
$this->data['boletobradesco_conta'] = $this->config->get('boletobradesco_conta'); 
} 

if (isset($this->request->post['boletobradesco_agenciadv'])) {
$this->data['boletobradesco_agenciadv'] = $this->request->post['boletobradesco_agenciadv'];
} else {
$this->data['boletobradesco_agenciadv'] = $this->config->get('boletobradesco_agenciadv'); 
} 

if (isset($this->request->post['boletobradesco_conta'])) {
$this->data['boletobradesco_contadv'] = $this->request->post['boletobradesco_contadv'];
} else {
$this->data['boletobradesco_contadv'] = $this->config->get('boletobradesco_contadv'); 
} 

if (isset($this->request->post['boletobradesco_carteira'])) {
$this->data['boletobradesco_carteira'] = $this->request->post['boletobradesco_carteira'];
} else {
$this->data['boletobradesco_carteira'] = $this->config->get('boletobradesco_carteira'); 
} 

if (isset($this->request->post['boletobradesco_demo1'])) {
$this->data['boletobradesco_demo1'] = $this->request->post['boletobradesco_demo1'];
} else {
$this->data['boletobradesco_demo1'] = $this->config->get('boletobradesco_demo1'); 
} 

if (isset($this->request->post['boletobradesco_demo2'])) {
$this->data['boletobradesco_demo2'] = $this->request->post['boletobradesco_demo2'];
} else {
$this->data['boletobradesco_demo2'] = $this->config->get('boletobradesco_demo2'); 
} 

if (isset($this->request->post['boletobradesco_demo3'])) {
$this->data['boletobradesco_demo3'] = $this->request->post['boletobradesco_demo3'];
} else {
$this->data['boletobradesco_demo3'] = $this->config->get('boletobradesco_demo3'); 
} 

if (isset($this->request->post['boletobradesco_instrucao1'])) {
$this->data['boletobradesco_instrucao1'] = $this->request->post['boletobradesco_instrucao1'];
} else {
$this->data['boletobradesco_instrucao1'] = $this->config->get('boletobradesco_instrucao1'); 
} 

if (isset($this->request->post['boletobradesco_instrucao2'])) {
$this->data['boletobradesco_instrucao2'] = $this->request->post['boletobradesco_instrucao2'];
} else {
$this->data['boletobradesco_instrucao2'] = $this->config->get('boletobradesco_instrucao2'); 
} 

if (isset($this->request->post['boletobradesco_instrucao3'])) {
$this->data['boletobradesco_instrucao3'] = $this->request->post['boletobradesco_instrucao3'];
} else {
$this->data['boletobradesco_instrucao3'] = $this->config->get('boletobradesco_instrucao3'); 
}

if (isset($this->request->post['boletobradesco_instrucao4'])) {
$this->data['boletobradesco_instrucao4'] = $this->request->post['boletobradesco_instrucao4'];
} else {
$this->data['boletobradesco_instrucao4'] = $this->config->get('boletobradesco_instrucao4'); 
} 

if (isset($this->request->post['boletobradesco_aceite'])) {
$this->data['boletobradesco_aceite'] = $this->request->post['boletobradesco_aceite'];
} else {
$this->data['boletobradesco_aceite'] = $this->config->get('boletobradesco_aceite'); 
} 
 
 if (isset($this->request->post['boletobradesco_especie'])) {
$this->data['boletobradesco_especie'] = $this->request->post['boletobradesco_especie'];
} else {
$this->data['boletobradesco_especie'] = $this->config->get('boletobradesco_especie'); 
} 

if (isset($this->request->post['boletobradesco_cpf'])) {
$this->data['boletobradesco_cpf'] = $this->request->post['boletobradesco_cpf'];
} else {
$this->data['boletobradesco_cpf'] = $this->config->get('boletobradesco_cpf'); 
} 

if (isset($this->request->post['boletobradesco_vencimento'])) {
$this->data['boletobradesco_vencimento'] = $this->request->post['boletobradesco_vencimento'];
} else {
$this->data['boletobradesco_vencimento'] = $this->config->get('boletobradesco_vencimento'); 
} 
		
$this->load->model('localisation/geo_zone');
										
$this->data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();
		
$this->template = 'payment/boletobradesco.tpl';
$this->children = array(
'common/header',	
'common/footer'	
);
		
$this->response->setOutput($this->render(TRUE), $this->config->get('config_compression'));
}

	
}
?>
