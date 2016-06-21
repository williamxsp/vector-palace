<?php

// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - BANESTES
$dadosboleto["conta"] = "1.222.333"; 	// Num da conta corrente
$dadosboleto["agencia"] = "123"; 	    // Num da ag�ncia

// DADOS PERSONALIZADOS - BANESTES
$dadosboleto["carteira"] = "00"; // Carteira do Tipo COBRAN�A SEM REGISTRO (Carteira 00) - N�o � Carteira 11
$dadosboleto["tipo_cobranca"] = "2";  // 2- Sem registro; 
									  // 3- Caucionada; 
									  // 4,5,6 e 7-Cobran�a com registro


// N�O ALTERAR!
include("include/funcoes_banestes.php"); 
include("include/layout_banestes.php");
?>
