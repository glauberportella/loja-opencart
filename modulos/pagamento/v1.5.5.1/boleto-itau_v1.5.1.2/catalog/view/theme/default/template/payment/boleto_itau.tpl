<h2><?php echo $text_instruction; ?></h2><br />
<h3><?php echo $text_instruction2; ?></h3><br />
<p><?php echo $text_payment; ?></p>
<div class="buttons">
  <div class="right"><a id="button-confirm" class="button" href="index.php?route=payment/boleto_itau/callback&order_id=<?php echo $idboleto; ?>" target="_blank"><span><?php echo $button_continue; ?></span></a></div>
</div>
<script type="text/javascript"><!--
$('#button-confirm').bind('click', function() {
	$.ajax({ 
		type: 'GET',
		url: 'index.php?route=payment/boleto_itau/confirm',
		success: function() {
			location = '<?php echo $continue; ?>';
		}		
	});
});
//--></script> 
