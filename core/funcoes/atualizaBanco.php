<?php session_start(); ?>
<?php require_once('../classes/usuario.class.php')?>
<?php require_once('../classes/banco.class.php')?>
<?php
	$usuario = usuario::carregaInfo();
	
	$idBanco = 0;
	
	if(isset($_POST['idBanco']))
	{
		$idBanco = (int)$_POST['idBanco'];
	}

	if($idBanco)
	{

		$usuario = usuario::getById($usuario->id);
		$usuario->idBanco = $idBanco;
		echo $usuario->update();
	}
	
?>

