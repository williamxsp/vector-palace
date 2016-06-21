<?php


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - NOSSA CAIXA
/*$dadosboleto["agencia"] = "0033"; // Num da agencia, sem digito
$dadosboleto["conta"] = "0001131"; 	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "1"; 	// Digito do Num da conta*/

// DADOS PERSONALIZADOS - CEF
$dadosboleto["agencia"] = "0033"; // Num da agencia, sem digito
$dadosboleto["conta_cedente"] = "001131"; // ContaCedente do Cliente, sem digito (Somente 6 digitos)
$dadosboleto["conta_cedente_dv"] = "1"; // Digito da ContaCedente do Cliente
$dadosboleto["carteira"] = "5";  // C�digo da Carteira -> 5-Cobran�a Direta ou 1-Cobran�a Simples
$dadosboleto["modalidade_conta"] = "04";  // modalidade da conta 02 posi��es

// SEUS DADOS
$dadosboleto["identificacao"] = "BoletoPhp - C�digo Aberto de Sistema de Boletos";
$dadosboleto["cpf_cnpj"] = "";
$dadosboleto["endereco"] = "Coloque o endere�o da sua empresa aqui";
$dadosboleto["cidade_uf"] = "Cidade / Estado";
$dadosboleto["cedente"] = "Coloque a Raz�o Social da sua empresa aqui";

// N�O ALTERAR!
include("include/funcoes_nossacaixa.php"); 
include("include/layout_nossacaixa.php");
?>
