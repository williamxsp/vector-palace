<?php 
	require('core/classes/usuario.class.php');
	session_start();
	session_destroy();
	
 	setcookie ("logado", "", time()-60*60*24*100); 
	usuario::setFeedBack(true, "Logout efetuado com sucesso", '');
	header("Location: login.php"); 
?>