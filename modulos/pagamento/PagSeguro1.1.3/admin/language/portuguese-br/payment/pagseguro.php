<?php
// Heading
$_['heading_title']       			= 'PagSeguro';

// Text
$_['text_payment']        			= 'Pagamento';
$_['text_success']        			= 'Módulo PagSeguro atualizado com sucesso!';
$_['text_pagseguro'] 				= '<a onclick="window.open(\'http://www.pagseguro.com.br/\');"><img src="view/image/payment/pagseguro_uol.gif" alt="PagSeguro" title="PagSeguro" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_order_nao_efetivado'] 		= 'O pagamento no site do PagSeguro não foi concluído.';
$_['text_frete_loja']        		= 'pela loja';
$_['text_frete_pagseguro_pac']      = 'pelo PagSeguro usando PAC';
$_['text_frete_pagseguro_sedex']    = 'pelo PagSeguro usando Sedex';
$_['text_frete_pagseguro_nao_especificado'] = 'pelo PagSeguro. O cliente escolhe entre PAC e Sedex';

// Entry
$_['entry_token']         				= 'Token:<br /><span class="help">Token de Segurança</span>';
$_['entry_email']         				= 'Email:<br /><span class="help">E-mail de cadastro no PagSeguro</span>';
$_['entry_posfixo']         			= 'Pós-fixo para o número do pedido:<br /><span class="help">Útil para identificar no PagSeguro de qual loja pertence o pedido. Ex. para pedido de nro. 15 e pós-fixo "loja01", a referência do pedido no PagSeguro será "15_loja01" </span>';
$_['entry_tipo_frete']         			= 'Cálculo do frete feito:<br /><span class="help">Se optar pelo cálculo feito pela loja, escolha "Frete fixo" em Preferências de frete no PagSeguro senão marque "Frete por peso" para que o PagSeguro faça os cálculos.</span>';

$_['entry_order_aguardando_retorno'] 	= 'Status Aguardando retorno:<br /><span class="help">a loja aguarda o primeiro retorno da transação pelo PagSeguro.</span>';
$_['entry_order_aguardando_pagamento'] 	= 'Status Aguardando pagamento:<br /><span class="help">o comprador iniciou a transação, mas até o momento o PagSeguro não recebeu nenhuma informação sobre o pagamento.</span>';
$_['entry_order_analise'] 				= 'Status Em análise:<br /><span class="help">o comprador optou por pagar com um cartão de crédito e o PagSeguro está analisando o risco da transação.</span>';
$_['entry_order_paga'] 					= 'Status Paga:<br /><span class="help">a transação foi paga pelo comprador e o PagSeguro já recebeu uma confirmação da instituição financeira responsável pelo processamento.</span>';
$_['entry_order_disponivel'] 			= 'Status Disponível:<br /><span class="help">a transação foi paga e chegou ao final de seu prazo de liberação sem ter sido retornada e sem que haja nenhuma disputa aberta.</span>';
$_['entry_order_disputa'] 				= 'Status Disputa:<br /><span class="help">o comprador, dentro do prazo de liberação da transação, abriu uma disputa.</span>';
$_['entry_order_devolvida'] 			= 'Status Devolvida:<br /><span class="help">o valor da transação foi devolvido para o comprador.</span>';
$_['entry_order_cancelada'] 			= 'Status Cancelada:<br /><span class="help">a transação foi cancelada sem ter sido finalizada.</span>';

$_['entry_geo_zone']      			= 'Região geográfica:';
$_['entry_status']        			= 'Situação:';
$_['entry_sort_order']    			= 'Ordenação:';
$_['entry_update_status_alert'] 	= 'Alertar sobre mudança no status da transação:<br /><span class="help">Envia e-mail para o cliente avisando-o sobre mudança no status do pedido.</span>';

// Error
$_['error_permission']    		= 'Atenção: Você não possui permissão para modificar o PagSeguro!';
$_['error_token']         		= 'Digite o token de segurança';
$_['error_email']         		= 'Digite o e-mail de cadastro no PagSeguro';
?>