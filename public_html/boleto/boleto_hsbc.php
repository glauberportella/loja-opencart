<?php
// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 5;
$taxa_boleto = "0,00";
$data_venc = date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 166400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = "14,90"; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["numero_documento"] = "001";	// Número do documento - REGRA: Máximo de 13 digitos
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = "Pontual Acabamentos Gráficos";
$dadosboleto["endereco1"] = "Rua: Luiz Amora, 699";
$dadosboleto["endereco2"] = "Curitiba - PR - CEP: 81020-680";

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "";
$dadosboleto["demonstrativo2"] = "Hospedagem do site www.pontualacabamentos.com.br<br>Taxa bancária - R$ ".$taxa_boleto;
$dadosboleto["demonstrativo3"] = "";
$dadosboleto["instrucoes1"] = "- Sr. Caixa, após o vencimento, cobrar multa R$ 3,99 e R$ 0,33 por dia de atraso";
$dadosboleto["instrucoes2"] = "";
$dadosboleto["instrucoes3"] = "";
$dadosboleto["instrucoes4"] = "Emitido por linecenter Brasil - www.linecenter.com.br";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "";		
$dadosboleto["uso_banco"] = ""; 	
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


// DADOS PERSONALIZADOS - HSBC
$dadosboleto["codigo_cedente"] = "3663698"; // Código do Cedente (Somente 7 digitos)
$dadosboleto["carteira"] = "CNR";  // Código da Carteira

// SEUS DADOS
$dadosboleto["identificacao"] = "Danilo Wiener";
$dadosboleto["cpf_cnpj"] = "022.052.689-37";
$dadosboleto["endereco"] = "";
$dadosboleto["cidade_uf"] = "Curitiba - PR";
$dadosboleto["cedente"] = "www.linecenter.com.br";

// NÃO ALTERAR!
include("include/funcoes_hsbc.php"); 
include("include/layout_hsbc.php");
?>
