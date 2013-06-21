<?php
global $itemId;
if(isset($_POST['item_id'])) $itemId = $_POST['item_id'];
if($itemId=="" || $itemId==NULL || !isset($itemId)){
$itemId = $_GET['boleto'];
}
include "dados.php";

//Variaveis do modulo
$BoletodiasVencimento = $config->get('boletobradesco_vencimento');
$BoletoCedenteDocumento = $config->get('boletobradesco_cpf');
$BoletoEspecie = 'R$';
$BoletoEspecieDoc = $config->get('boletobradesco_especie');
$BoletoAceite = $config->get('boletobradesco_aceite');
$BoletoInstrucaoU = $config->get('boletobradesco_instrucao1');
$BoletoInstrucaoD = $config->get('boletobradesco_instrucao2');
$BoletoInstrucaoT = $config->get('boletobradesco_instrucao3');
$BoletoInstrucaoQ = $config->get('boletobradesco_instrucao4');
$BoletoDemoU = $config->get('boletobradesco_demo1');
$BoletoDemoD = $config->get('boletobradesco_demo2');
$BoletoDemoT = $config->get('boletobradesco_demo3');
$BoletoCedente = $config->get('boletobradesco_cedente');
$BoletoCarteira = $config->get('boletobradesco_carteira');
$BoletoAgencia = $config->get('boletobradesco_agencia');
$BoletoConta = $config->get('boletobradesco_conta');

$BoletoDVC = $config->get('boletobradesco_contadv');
$BoletoDVA = $config->get('boletobradesco_agenciadv');

$desconto = $config->get('boletobradesco_desconto');
//Variaveis da compra.

$valorBoleto = $pedido->row['total'];
if((!empty($desconto)) AND ($desconto>0)){
$valorBoleto = $valorBoleto-(($valorBoleto/100)*$desconto);
}

$sacadoBoleto = $pedido->row['firstname']." ".$pedido->row['lastname'];
$enderecoBoleto = $pedido->row['shipping_address_1']." - ".$pedido->row['shipping_address_2']." - ".$pedido->row['shipping_city']."<br>Cidade: ".$pedido->row['shipping_city']." CEP: ".$pedido->row['shipping_postcode'];

$prazo = $BoletodiasVencimento;

$data_venc = date("d/m/Y", time() + ($prazo * 86400)); 
$valor_cobrado = $valorBoleto;
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado, 2, ',', '');

$dadosboleto["nosso_numero"] = $itemId;
$dadosboleto["numero_documento"] = $itemId;
$dadosboleto["data_vencimento"] = $data_venc;

$dadosboleto["data_documento"] = date("d/m/Y");
$dadosboleto["data_processamento"] = date("d/m/Y");
$dadosboleto["valor_boleto"] = $valor_boleto;

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $sacadoBoleto;
$dadosboleto["endereco1"] = $enderecoBoleto;
$dadosboleto["endereco2"] = '';
// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = $BoletoDemoU;
$dadosboleto["demonstrativo2"] = $BoletoDemoD;
$dadosboleto["demonstrativo3"] = $BoletoDemoT;
$dadosboleto["instrucoes1"] = $BoletoInstrucaoU;
$dadosboleto["instrucoes2"] = $BoletoInstrucaoD;
$dadosboleto["instrucoes3"] = $BoletoInstrucaoT;
$dadosboleto["instrucoes4"] = $BoletoInstrucaoQ;

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = 1;
$dadosboleto["valor_unitario"] = $valor_boleto;
$dadosboleto["aceite"] = $BoletoAceite;		
$dadosboleto["especie"] = $BoletoEspecie;

$dadosboleto["uso_banco"] = ""; 	
$dadosboleto["especie_doc"] = $BoletoEspecieDoc;




// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - ITAÚ
$dadosboleto["agencia"] = $BoletoAgencia;
$dadosboleto["conta"] = $BoletoConta;
$dadosboleto["agencia_dv"] = $BoletoDVA; // Digito do Num da agencia
$dadosboleto["conta_dv"] = $BoletoDVC; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - ITAÚ
$dadosboleto["conta_cedente"] = $BoletoConta; // ContaCedente do Cliente, sem digito (Somente Números)
$dadosboleto["conta_cedente_dv"] = $BoletoDVC; // Digito da ContaCedente do Cliente

$dadosboleto["carteira"] = $BoletoCarteira;
//$dadosboleto["carteira"] = "175";  // Código da Carteira: pode ser 175 ou 109

// SEUS DADOS
$dadosboleto["identificacao"] = "Impressão de Boleto Online (BANCO BRADESCO)";

$dadosboleto["cpf_cnpj"] = $BoletoCedenteDocumento;
$dadosboleto["cedente"] = $BoletoCedente;

// NÃO ALTERAR!
include("include/funcoes_bradesco.php"); 
include("include/layout_bradesco.php");
?>
<script language="javascript">
//self.print();
</script>