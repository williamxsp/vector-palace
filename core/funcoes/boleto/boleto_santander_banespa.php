<?php


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS PERSONALIZADOS - SANTANDER BANESPA
$dadosboleto["codigo_cliente"] = "0707077"; // C�digo do Cliente (PSK) (Somente 7 digitos)
$dadosboleto["ponto_venda"] = "1333"; // Ponto de Venda = Agencia
$dadosboleto["carteira"] = "102";  // Cobran�a Simples - SEM Registro
$dadosboleto["carteira_descricao"] = "COBRAN�A SIMPLES - CSR";  // Descri��o da Carteira


// N�O ALTERAR!
include("include/funcoes_santander_banespa.php"); 
include("include/layout_santander_banespa.php");
?>
