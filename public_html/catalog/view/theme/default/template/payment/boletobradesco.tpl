<script type="text/javascript">
<!--
window.name='loja';
function vai()
{
window.location = 'index.php?route=checkout/success';
return true;
}
//-->
</script>
<?php
//Variaveis da compra.
$msg = '<center><a href="'.HTTPS_SERVER.'boleto/boletobradesco/boleto_bradesco.php?boleto='.$pedido.'" onclick="javascript:vai();" target="_blank">
<img src="boleto/boletobradesco/images/gerar_boleto_bradesco.png" /></a></center>';
echo $msg;
?>
