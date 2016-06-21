<?php

// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS PERSONALIZADOS - HSBC
$dadosboleto["codigo_cedente"] = "1122334"; // C�digo do Cedente (Somente 7 digitos)
$dadosboleto["carteira"] = "CNR";  // C�digo da Carteira


// N�O ALTERAR!
include("include/funcoes_hsbc.php"); 
include("include/layout_hsbc.php");
?>
