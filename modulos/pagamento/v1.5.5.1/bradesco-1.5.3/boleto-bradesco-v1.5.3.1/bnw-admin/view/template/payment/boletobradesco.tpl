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
  <div class="left"></div>
  <div class="right"></div>
  <div class="heading">
    <h1><img src="view/image/payment.png" alt="" />Boleto Bancario - Bradesco</h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span>Salvar</span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span>Cancelar</span></a></div>
  </div>
  <div class="content">
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
      <table class="form">
	  
	  <tr><td colspan='2'><h2>Dados de Configuracoes</h2></td></tr>
	  
	        <tr>
        <td width="18%"><span class="required">*</span> Nome do Modulo:</td>
        <td width="82%">
		<input type="text" name="boletobradesco_nome" value="<?php echo $boletobradesco_nome; ?>" size='80' />
          <br />

      </tr>
	  
	   <tr>
        <td>Status Padrao dos Pedidos</td>
        <td><select name="boletobradesco_padrao">
          <?php foreach ($order_statuses as $order_status) { ?>
          <?php if ($order_status['order_status_id'] == $boletobradesco_padrao) { ?>
          <option value="<?php echo $order_status['order_status_id']; ?>" selected="selected">
		  <?php echo $order_status['name']; ?></option>
          <?php } else { ?>
          <option value="<?php echo $order_status['order_status_id']; ?>">
		  <?php echo $order_status['name']; ?></option>
          <?php } ?>
          <?php } ?>
        </select></td>
      </tr>
	  
	  	  <tr>
        <td>Zona:</td>
        <td><select name="boletobradesco_geo_zone_id">
            <option value="0">Todas as Zonas</option>
            <?php foreach ($geo_zones as $geo_zone) { ?>

            <option value="<?php echo $geo_zone['geo_zone_id']; ?>"><?php echo $geo_zone['name']; ?></option>

            <?php } ?>
          </select></td>
      </tr>
	  	  

      <tr>
        <td>Ordem:</td>
        <td><input type="text" name="boletobradesco_sort_order" value="<?php echo $boletobradesco_sort_order; ?>" size="1" /></td>
      </tr>
	  
	  <!--tr>
        <td width="18%"><span class="required">*</span> Desconto em %:</td>
        <td width="82%">
		<input type="text" name="boletobradesco_desconto" value="<?php echo $boletobradesco_desconto; ?>" size='2' />
          <br />

      </tr -->
	  
	  <tr>
        <td>Status:</td>
        <td><select name="boletobradesco_status">
            <?php if ($boletobradesco_status) { ?>
            <option value="1" selected="selected">Ativo</option>
            <option value="0">Inativo</option>
            <?php } else { ?>
            <option value="1">Ativo</option>
            <option value="0" selected="selected">Inativo</option>
            <?php } ?>
          </select></td></tr>
	  
	  <tr><td colspan='2'><h2>Dados do Boleto</h2></td></tr>
	  
      <tr>
        <td width="18%"><span class="required">*</span> Cedente:</td>
        <td width="82%">
		<input type="text" name="boletobradesco_cedente" value="<?php echo $boletobradesco_cedente; ?>" size='80' />
          <br />

      </tr>
	  
	        <tr>
        <td width="18%"><span class="required">*</span> Agencia:</td>
        <td width="82%">
		<input type="text" name="boletobradesco_agencia" value="<?php echo $boletobradesco_agencia; ?>" />
          <br />

      </tr>
	  
	  	        <tr>
        <td width="18%"><span class="required">*</span> DV Agencia:</td>
        <td width="82%">
		<input type="text" name="boletobradesco_agenciadv" value="<?php echo $boletobradesco_agenciadv; ?>" />
          <br />

      </tr>
	  
	        <tr>
        <td width="18%"><span class="required">*</span> Conta:</td>
        <td width="82%"><input type="text" name="boletobradesco_conta" value="<?php echo $boletobradesco_conta; ?>" />
          <br />

		  
      </tr>
	  
	    <tr>
        <td width="18%"><span class="required">*</span> DV Conta:</td>
        <td width="82%"><input type="text" name="boletobradesco_contadv" value="<?php echo $boletobradesco_contadv; ?>" />
          <br />

		  
      </tr>
	  
	        <tr>
        <td width="18%"><span class="required">*</span> Carteira (06):</td>
        <td width="82%"><input type="text" name="boletobradesco_carteira" value="<?php echo $boletobradesco_carteira; ?>" />
          <br />

      </tr>

  
	  
	<tr>
        <td width="18%"><span class="required">*</span> Demostrativo 01:</td>
        <td width="82%"><input type="text" name="boletobradesco_demo1" value="<?php echo $boletobradesco_demo1; ?>" size='80' />
          <br />

      </tr>
	  
	  <tr>
        <td width="18%"><span class="required">*</span> Demostrativo 02:</td>
        <td width="82%"><input type="text" name="boletobradesco_demo2" value="<?php echo $boletobradesco_demo2; ?>" size='80' />
          <br />

      </tr>
	  
	  <tr>
        <td width="18%"><span class="required">*</span> Demostrativo 03:</td>
        <td width="82%"><input type="text" name="boletobradesco_demo3" value="<?php echo $boletobradesco_demo3; ?>" size='80' />
          <br />

      </tr>
	  
	
	<tr>
        <td width="18%"><span class="required">*</span> Instrucao 01:</td>
        <td width="82%"><input type="text" name="boletobradesco_instrucao1" value="<?php echo $boletobradesco_instrucao1; ?>" size='80' />
          <br />

      </tr>
	  
	<tr>
        <td width="18%"><span class="required">*</span> Instrucao 02:</td>
        <td width="82%"><input type="text" name="boletobradesco_instrucao2" value="<?php echo $boletobradesco_instrucao2; ?>" size='80' />
          <br />

      </tr>
	  
	  
	  <tr>
        <td width="18%"><span class="required">*</span> Instrucao 03:</td>
        <td width="82%"><input type="text" name="boletobradesco_instrucao3" value="<?php echo $boletobradesco_instrucao3; ?>" size='80' />
          <br />

      </tr>
	  
	  
	  <tr>
        <td width="18%"><span class="required">*</span> Instrucao 04:</td>
        <td width="82%"><input type="text" name="boletobradesco_instrucao4" value="<?php echo $boletobradesco_instrucao4; ?>" size='80' />
          <br />

      </tr>
	  
	  
	  <tr>
        <td width="18%"><span class="required">*</span> Aceite:</td>
        <td width="82%"><input type="text" name="boletobradesco_aceite" value="<?php echo $boletobradesco_aceite; ?>" />
          <br />

      </tr>
	  
	  <tr>
        <td width="18%"><span class="required">*</span> Especie:</td>
        <td width="82%"><input type="text" name="boletobradesco_especie" value="<?php echo $boletobradesco_especie; ?>" />
          <br />

      </tr>
	  
	  
	  <tr>
        <td width="18%"><span class="required">*</span> CPF/CNPJ do Boleto:</td>
        <td width="82%"><input type="text" name="boletobradesco_cpf" value="<?php echo $boletobradesco_cpf; ?>" />
          <br />

      </tr>
	  
	  <tr>
        <td width="18%"><span class="required">*</span> Vencimento em Dias:</td>
        <td width="82%"><input type="text" name="boletobradesco_vencimento" value="<?php echo $boletobradesco_vencimento; ?>" />
          <br />

      </tr>
	  
	  
	  
	  


	  
	  

	  
    </table>
    </form>
  </div>
</div>
<?php echo $footer; ?>