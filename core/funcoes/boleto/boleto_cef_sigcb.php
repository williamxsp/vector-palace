<?php

// DADOS DA SUA CONTA - CEF
$dadosboleto["agencia"] = "1234"; // Num da agencia, sem digito
$dadosboleto["conta"] = "123"; 	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "0"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - CEF
$dadosboleto["conta_cedente"] = "123456"; // C�digo Cedente do Cliente, com 6 digitos (Somente N�meros)
$dadosboleto["carteira"] = "SR";  // C�digo da Carteira: pode ser SR (Sem Registro) ou CR (Com Registro) - (Confirmar com gerente qual usar)


// N�O ALTERAR!
include("include/funcoes_cef_sigcb.php"); 
include("include/layout_cef.php");
?>
