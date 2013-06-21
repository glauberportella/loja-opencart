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
<?php echo $header; ?>
<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div id="content">
    <div class="box">
      <div class="left"></div>
      <div class="right"></div>
      <div class="heading">
        <h1><img src="view/image/payment.png" alt="" /><?php echo $heading_title; ?></h1>
        <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location='<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
      <div class="content">
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td width="25%"><?php echo $entry_status; ?></td>
            <td><select name="boleto_cef_sigcb_status">
              <?php if ($boleto_cef_sigcb_status) { ?>
              <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
              <option value="0"><?php echo $text_disabled; ?></option>
              <?php } else { ?>
              <option value="1"><?php echo $text_enabled; ?></option>
              <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
              <?php } ?>
            </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_geo_zone; ?></td>
            <td><select name="boleto_cef_sigcb_geo_zone_id">
              <option value="0"><?php echo $text_all_zones; ?></option>
              <?php foreach ($geo_zones as $geo_zone) { ?>
              <?php if ($geo_zone['geo_zone_id'] == $boleto_cef_sigcb_geo_zone_id) { ?>
              <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
              <?php } ?>
              <?php } ?>
            </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_order_status; ?></td>
            <td><select name="boleto_cef_sigcb_order_status_id">
              <?php foreach ($order_statuses as $order_status) { ?>
              <?php if ($order_status['order_status_id'] == $boleto_cef_sigcb_order_status_id) { ?>
              <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
              <?php } else { ?>
              <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
              <?php } ?>
              <?php } ?>
            </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_logo; ?></td>
            <td><input type="text" name="boleto_cef_sigcb_logo" value="<?php echo $boleto_cef_sigcb_logo; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_identificacao; ?></td>
            <td><input type="text" name="boleto_cef_sigcb_identificacao" value="<?php echo $boleto_cef_sigcb_identificacao; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_cpf_cnpj; ?></td>
            <td><input name="boleto_cef_sigcb_cpf_cnpj" type="text" id="boleto_cef_sigcb_cpf_cnpj" value="<?php echo $boleto_cef_sigcb_cpf_cnpj; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_endereco; ?></td>
            <td><input name="boleto_cef_sigcb_endereco" type="text" id="boleto_cef_sigcb_endereco" value="<?php echo $boleto_cef_sigcb_endereco; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_cidade_uf; ?></td>
            <td><input name="boleto_cef_sigcb_cidade_uf" type="text" id="boleto_cef_sigcb_cidade_uf" value="<?php echo $boleto_cef_sigcb_cidade_uf; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_cedente; ?></td>
            <td><input name="boleto_cef_sigcb_cedente" type="text" id="boleto_cef_sigcb_cedente" value="<?php echo $boleto_cef_sigcb_cedente; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_agencia; ?></td>
            <td><input name="boleto_cef_sigcb_agencia" type="text" id="boleto_cef_sigcb_agencia" value="<?php echo $boleto_cef_sigcb_agencia; ?>" maxlength="4" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_conta; ?></td>
            <td><input name="boleto_cef_sigcb_conta" type="text" id="boleto_cef_sigcb_conta" value="<?php echo $boleto_cef_sigcb_conta; ?>" maxlength="5" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_conta_cedente; ?></td>
            <td><input name="boleto_cef_sigcb_conta_cedente" type="text" id="boleto_cef_sigcb_conta_cedente" value="<?php echo $boleto_cef_sigcb_conta_cedente; ?>" maxlength="6" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_carteira; ?></td>
            <td><input name="boleto_cef_sigcb_carteira" type="text" id="boleto_cef_sigcb_carteira" value="<?php echo $boleto_cef_sigcb_carteira; ?>" maxlength="3" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_dia_prazo_pg; ?></td>
            <td><input name="boleto_cef_sigcb_dia_prazo_pg" type="text" id="boleto_cef_sigcb_dia_prazo_pg" value="<?php echo $boleto_cef_sigcb_dia_prazo_pg; ?>" maxlength="2" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_taxa_boleto; ?></td>
            <td><input name="boleto_cef_sigcb_taxa_boleto" type="text" id="boleto_cef_sigcb_taxa_boleto" value="<?php echo $boleto_cef_sigcb_taxa_boleto; ?>" maxlength="4" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_nosso_numero1; ?></td>
            <td><input name="boleto_cef_sigcb_nosso_numero1" type="text" id="boleto_cef_sigcb_nosso_numero1" value="<?php echo $boleto_cef_sigcb_nosso_numero1; ?>" maxlength="3" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_nosso_numero2; ?></td>
            <td><input name="boleto_cef_sigcb_nosso_numero2" type="text" id="boleto_cef_sigcb_nosso_numero2" value="<?php echo $boleto_cef_sigcb_nosso_numero2; ?>" maxlength="3" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_nosso_numero3; ?></td>
            <td><input name="boleto_cef_sigcb_nosso_numero3" type="text" id="boleto_cef_sigcb_nosso_numero3" value="<?php echo $boleto_cef_sigcb_nosso_numero3; ?>" maxlength="9" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_nosso_numero_const1; ?></td>
            <td><input name="boleto_cef_sigcb_nosso_numero_const1" type="text" id="boleto_cef_sigcb_nosso_numero_const1" value="<?php echo $boleto_cef_sigcb_nosso_numero_const1; ?>" maxlength="1" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_nosso_numero_const2; ?></td>
            <td><input name="boleto_cef_sigcb_nosso_numero_const2" type="text" id="boleto_cef_sigcb_nosso_numero_const2" value="<?php echo $boleto_cef_sigcb_nosso_numero_const2; ?>" maxlength="2" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_demonstrativo1; ?></td>
            <td><input name="boleto_cef_sigcb_demonstrativo1" type="text" id="boleto_cef_sigcb_demonstrativo1" value="<?php echo $boleto_cef_sigcb_demonstrativo1; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_demonstrativo2; ?></td>
            <td><input name="boleto_cef_sigcb_demonstrativo2" type="text" id="boleto_cef_sigcb_demonstrativo2" value="<?php echo $boleto_cef_sigcb_demonstrativo2; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_demonstrativo3; ?></td>
            <td><input name="boleto_cef_sigcb_demonstrativo3" type="text" id="boleto_cef_sigcb_demonstrativo3" value="<?php echo $boleto_cef_sigcb_demonstrativo3; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_instrucoes1; ?></td>
            <td><input name="boleto_cef_sigcb_instrucoes1" type="text" id="boleto_cef_sigcb_instrucoes1" value="<?php echo $boleto_cef_sigcb_instrucoes1; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_instrucoes2; ?></td>
            <td><input name="boleto_cef_sigcb_instrucoes2" type="text" id="boleto_cef_sigcb_instrucoes2" value="<?php echo $boleto_cef_sigcb_instrucoes2; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_instrucoes3; ?></td>
            <td><input name="boleto_cef_sigcb_instrucoes3" type="text" id="boleto_cef_sigcb_instrucoes3" value="<?php echo $boleto_cef_sigcb_instrucoes3; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_instrucoes4; ?></td>
            <td><input name="boleto_cef_sigcb_instrucoes4" type="text" id="boleto_cef_sigcb_instrucoes4" value="<?php echo $boleto_cef_sigcb_instrucoes4; ?>" /></td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="boleto_cef_sigcb_sort_order" value="<?php echo $boleto_cef_sigcb_sort_order; ?>" size="1" /></td>
          </tr>
        </table>
     
    </form>
    </div>
    </div>
</div>
<script type="text/javascript"><!--
$.tabs('.tabs a'); 
//--></script>
<?php echo $footer; ?>
