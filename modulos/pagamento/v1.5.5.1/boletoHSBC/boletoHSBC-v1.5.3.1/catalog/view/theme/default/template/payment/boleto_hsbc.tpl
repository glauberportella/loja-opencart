<!--
/*
	OpenCart
	v1.5.3.1
	Atualização Boleto Bancario.
	Empresa Brasilnaweb
	www.brasilnaweb.com.br
	Feito por 
	Tiago Agenor
	http://www.tiagoagenor.com.br/novo
*/
-->
<div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;"><?php echo $text_instruction; ?><br />

<br />

<?php

/*$valorBoleto = $valorpedido;

if((!empty($desconto)) AND ($desconto>0)){

	$valorBoleto = $valorBoleto-(($valorBoleto/100)*$desconto);

	 echo '<p>Valor total de '.number_format($valorBoleto, 2, ',', '').' com desconto de '.$desconto.'%</p><br />';

}*/

?>

  <p style="text-align: center;"><a href="index.php?route=payment/boleto_hsbc/callback&order_id=<?php echo $idboleto; ?>" target="_blank"><img src="<?php echo HTTPS_SERVER ?>/boleto/imagens/gerar_boleto_hsbc.png" alt="Gerar Boleto HSBC" title="Gerar Boleto HSBC" /></a></p>

  <br />

  <?php echo $text_payment; ?></div>

<div class="buttons">

	<div align="right"><a id="button-confirm" class="button"><span><?php echo $button_continue; ?></span></a></div>

</div>

<script type="text/javascript"><!--

$('#button-confirm').bind('click', function() {

  $.ajax({ 

    type: 'GET',

    url: 'index.php?route=payment/boleto_hsbc/confirm',

    success: function() {

      location = '<?php echo $continue; ?>';

    }   

  });

});

--></script>

