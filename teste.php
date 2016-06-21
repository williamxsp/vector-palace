<?php 
		$caracteres = '0123456789abcdefghijklmnopqrstuvwxyz';
		$randomPass = '';
		$novaSenha = '';

		for($p = 0; $p < 5; $p++) {
			$randomPass .= $caracteres[mt_rand(0, 35)];
		}
		echo $randomPass;
		
?>