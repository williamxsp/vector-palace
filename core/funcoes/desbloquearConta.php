<?php
require('../classes/usuario.class.php');
if(isset($_POST['email']) && isset($_POST['cod']) && isset($_POST['cpf']))
{
	$email = $_POST['email'];
	$cod= $_POST['cod'];
	$cpf= $_POST['cpf'];
	
	echo usuario::desbloquear($email, $cod, $cpf);
}
else
	{
		echo "Usuário ou código inválido";
	}
?>