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
<div style="background: #F7F7F7; border: 1px solid #DDDDDD; padding: 10px; margin-bottom: 10px;">
  <?php echo $text_instruction; ?><br />
  <br />
  <center><a href="index.php?route=payment/boleto_cef_sigcb/callback&order_id=<?php echo $idboleto; ?>" target="_blank"><img src="boleto/imagens/gerar_boleto_caixa.png" /></a></center><br />
  <br />
  <?php echo $text_payment; ?>
</div>
<div class="buttons">
      <div align="right"><a id="button-confirm" class="button"><span><?php echo $button_continue; ?></span></a></div>
  </table>
</div>
<script type="text/javascript"><!--
$('#button-confirm').bind('click', function() {
  $.ajax({ 
    type: 'GET',
    url: 'index.php?route=payment/boleto_cef_sigcb/confirm',
    success: function() {
      location = '<?php echo $continue; ?>';
    }   
  });
});
--></script>