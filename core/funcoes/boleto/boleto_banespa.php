<?php

// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS PERSONALIZADOS - Banespa
$dadosboleto["codigo_cedente"] = "40013012168"; // C�digo do cedente (Somente 11 digitos)
$dadosboleto["ponto_venda"] = "400"; // Ponto de Venda = Agencia 
$dadosboleto["carteira"] = "COB";  // COB - SEM Registro
$dadosboleto["nome_da_agencia"] = "ACLIMA��O";  // Nome da agencia (Opcional)


// N�O ALTERAR!
include("include/funcoes_banespa.php"); 
include("include/layout_banespa.php");
?>
