<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <?php if ($error_warning) { ?>
  <div class="warning"><?php echo $error_warning; ?></div>
  <?php } ?>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/payment.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
    </div>
    <div class="content">
	  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
	    <table class="form">
	      <tr>
	        <td><span class="required">*</span> <?php echo $entry_token; ?></td>
	        <td><input type="text" name="pagseguro_token" value="<?php echo $pagseguro_token; ?>" size="50%" />
	          <?php if ($error_token) { ?>
	          <span class="error"><?php echo $error_token; ?></span>
	          <?php } ?></td>
	      </tr>
	      <tr>
	        <td><span class="required">*</span> <?php echo $entry_email; ?></td>
	        <td><input type="text" name="pagseguro_email" value="<?php echo $pagseguro_email; ?>" size="50%" />
	          <?php if ($error_email) { ?>
	          <span class="error"><?php echo $error_email; ?></span>
	          <?php } ?></td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_posfixo; ?></td>
	        <td><input type="text" name="pagseguro_posfixo" value="<?php echo $pagseguro_posfixo; ?>" /></td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_tipo_frete; ?></td>
	        <td>
			  <select name="pagseguro_tipo_frete">
	            <?php if ($pagseguro_tipo_frete == '0') { ?>
	            <option value="0" selected="selected"><?php echo $text_frete_loja; ?></option>
	            <?php } else { ?>
	            <option value="0"><?php echo $text_frete_loja; ?></option>
	            <?php } ?>
	            <?php if ($pagseguro_tipo_frete == '1') { ?>
	            <option value="1" selected="selected"><?php echo $text_frete_pagseguro_pac; ?></option>
	            <?php } else { ?>
	            <option value="1"><?php echo $text_frete_pagseguro_pac; ?></option>
	            <?php } ?>
	            <?php if ($pagseguro_tipo_frete == '2') { ?>
	            <option value="2" selected="selected"><?php echo $text_frete_pagseguro_sedex; ?></option>
	            <?php } else { ?>
	            <option value="2"><?php echo $text_frete_pagseguro_sedex; ?></option>
	            <?php } ?>
	            <?php if ($pagseguro_tipo_frete == '3') { ?>
	            <option value="3" selected="selected"><?php echo $text_frete_pagseguro_nao_especificado; ?></option>
	            <?php } else { ?>
	            <option value="3"><?php echo $text_frete_pagseguro_nao_especificado; ?></option>
	            <?php } ?>		            		            	            
	          </select>
			</td>
	      </tr>	      	      
	      <tr>
	        <td><?php echo $entry_order_aguardando_retorno; ?></td>
	        <td><select name="pagseguro_order_aguardando_retorno" id="pagseguro_order_aguardando_retorno">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_order_aguardando_retorno) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	        </td>
	      </tr>      
	      
	      <tr>
	        <td><?php echo $entry_order_aguardando_pagamento; ?></td>
	        <td><select name="pagseguro_order_aguardando_pagamento" id="pagseguro_order_aguardando_pagamento">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_order_aguardando_pagamento) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	        </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_analise; ?></td>
	        <td><select name="pagseguro_order_analise" id="pagseguro_order_analise">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_order_analise) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	        </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_paga; ?></td>
	        <td><select name="pagseguro_order_paga" id="pagseguro_order_paga">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_order_paga) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_disponivel; ?></td>
	        <td><select name="pagseguro_order_disponivel" id="pagseguro_order_disponivel">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_order_disponivel) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_disputa; ?></td>
	        <td><select name="pagseguro_order_disputa" id="pagseguro_order_disputa">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_order_disputa) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_order_devolvida; ?></td>
	        <td><select name="pagseguro_order_devolvida" id="pagseguro_order_devolvida">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_order_devolvida) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>	
	      <tr>
	        <td><?php echo $entry_order_cancelada; ?></td>
	        <td><select name="pagseguro_order_cancelada" id="pagseguro_order_cancelada">
	          <?php foreach ($order_statuses as $order_status) { ?>
	          <?php if ($order_status['order_status_id'] == $pagseguro_order_cancelada) { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected"><?php echo $order_status['name']; ?></option>
	          <?php } else { ?>
	          <option value="<?php echo $order_status['order_status_id']; ?>"><?php echo $order_status['name']; ?></option>
	          <?php } ?>
	          <?php } ?>
	        </select>
	         </td>
	      </tr>			  
	      <tr>
	        <td><?php echo $entry_update_status_alert; ?></td>
	        <td>
			  <select name="pagseguro_update_status_alert">
	            <?php if ($pagseguro_update_status_alert) { ?>
	            <option value="1" selected="selected"><?php echo $text_yes; ?></option>
	            <option value="0"><?php echo $text_no; ?></option>
	            <?php } else { ?>
	            <option value="1"><?php echo $text_yes; ?></option>
	            <option value="0" selected="selected"><?php echo $text_no; ?></option>
	            <?php } ?>
	          </select>
			</td>
	      </tr>		      
	      <tr>
	        <td><?php echo $entry_geo_zone; ?></td>
	        <td>
			  <select name="pagseguro_geo_zone_id">
	            <option value="0"><?php echo $text_all_zones; ?></option>
	            <?php foreach ($geo_zones as $geo_zone) { ?>
	            <?php if ($geo_zone['geo_zone_id'] == $pagseguro_geo_zone_id) { ?>
	            <option value="<?php echo $geo_zone['geo_zone_id']; ?>" selected="selected"><?php echo $geo_zone['name']; ?></option>
	            <?php } else { ?>
	            <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>
	           <?php } ?>
	            <?php } ?>
	          </select>
			</td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_status; ?></td>
	        <td>
			  <select name="pagseguro_status">
	            <?php if ($pagseguro_status) { ?>
	            <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
	            <option value="0"><?php echo $text_disabled; ?></option>
	            <?php } else { ?>
	            <option value="1"><?php echo $text_enabled; ?></option>
	            <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
	            <?php } ?>
	          </select>
			</td>
	      </tr>
	      <tr>
	        <td><?php echo $entry_sort_order; ?></td>
	        <td><input type="text" name="pagseguro_sort_order" value="<?php echo $pagseguro_sort_order; ?>" size="1" /></td>
	      </tr>
	    </table>
      </form>
    </div>
  </div>
</div>
<?php echo $footer; ?> 