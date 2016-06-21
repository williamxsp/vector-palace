<?php


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - SUDAMERIS
$dadosboleto["agencia"]       = "0501";		// N�mero da agencia, sem digito
$dadosboleto["conta"]         = "6703255";	// N�mero da conta, sem digito
$dadosboleto["carteira"]      = "57";		// Deve possuir conv�nio - Carteira 57 (Sem Registro) ou 20 (Com Registro)


// N�O ALTERAR!
include("include/funcoes_sudameris.php");
include("include/layout_sudameris.php");
?>
