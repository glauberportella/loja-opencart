<?php
/*
* Módulo de Pagamento Boleto Bancário Sicredi
* Feito sobre OpenCart 1.5.1.3
* Autor Guilherme Desimon - http://www.desimon.net
* @01/2012
* Sob licença GPL.
*/
// Text
$_['text_title'] = 'Boleto HSBC';
$_['text_instruction'] = 'Pagamento preferencialmente nas Ag&ecirc;ncias do HSBC. ';  
$_['text_linkboleto'] = '<a href="'.HTTPS_SERVER.'index.php?route=payment/boleto_hsbc/callback&order_id=%s" target="_blank"><img src="'.HTTPS_SERVER.'boleto/imagens/gerarboleto.jpg" alt="Gerar Segunda Via do Boleto" title="Gerar Segunda Via do Boleto" /></a>';
$_['text_payment'] = 'Seu pedido n&#227;o ser&aacute; enviado at&eacute; o recebimento da confirma&ccedil;&#227;o do pagamento.';
?>