<?php

// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - UNIBANCO
$dadosboleto["agencia"] = "0123"; // Num da agencia, sem digito
$dadosboleto["conta"] = "100618"; 	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "9"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - UNIBANCO
$dadosboleto["codigo_cliente"] = "2031671"; // Codigo do Cliente
$dadosboleto["carteira"] = "20";  // C�digo da Carteira


// N�O ALTERAR!
include("include/funcoes_unibanco.php"); 
include("include/layout_unibanco.php");
?>
