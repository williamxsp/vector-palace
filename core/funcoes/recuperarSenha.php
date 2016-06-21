<?php
	if(isset($_POST['cpf']))
	{
		include("../classes/usuario.class.php");
		echo usuario::recuperarSenha($_POST['cpf']);
	}
	else
		{
			header("Location: index.php");
		}
?>