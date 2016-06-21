<?php

// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - SICREDI
$dadosboleto["agencia"] = "1234"; 	// Num da agencia (4 digitos), sem Digito Verificador
$dadosboleto["conta"] = "12345"; 	// Num da conta (5 digitos), sem Digito Verificador
$dadosboleto["conta_dv"] = "6"; 	// Digito Verificador do Num da conta

// DADOS PERSONALIZADOS - SICREDI
$dadosboleto["posto"]= "18";      // C�digo do posto da cooperativa de cr�dito
$dadosboleto["byte_idt"]= "2";	  // Byte de identifica��o do cedente do bloqueto utilizado para compor o nosso n�mero.
                                  // 1 - Idtf emitente: Cooperativa | 2 a 9 - Idtf emitente: Cedente
$dadosboleto["carteira"] = "A";   // C�digo da Carteira: A (Simples) 


// N�O ALTERAR!
include("include/funcoes_sicredi.php"); 
include("include/layout_sicredi.php");
?>
