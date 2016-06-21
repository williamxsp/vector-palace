<?php


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA
$dadosboleto["agencia"]             = $agencia;     // Num da agencia, sem digito
$dadosboleto["agencia_dv"]          = $agencia_dv;  // Digito do Num da agencia
$dadosboleto["conta"]               = $conta;       // Num da conta, sem digito
$dadosboleto["conta_dv"]            = $conta_dv;    // Digito do Num da conta

// DADOS PERSONALIZADOS
$dadosboleto["conta_cedente"]       = $dadosboleto["conta"];    // ContaCedente do Cliente, sem digito (Somente N�meros)
$dadosboleto["conta_cedente_dv"]    = $dadosboleto["conta_dv"]; // Digito da ContaCedente do Cliente
$dadosboleto["carteira"]            = "121";                    // C�digo da Carteira: 121


// N�O ALTERAR!
include("include/funcoes_sofisa.php"); 
include("include/layout_sofisa.php");
?>
