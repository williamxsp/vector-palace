<?php
	session_start(); 
	include("../../classes/usuario.class.php");
	include("../../classes/cobranca.class.php");
	$usuario = usuario::carregaInfo();
	include("../checaAdmin.php");
	
	
	if(isset($_POST['c']) && isset($_POST['descricao']) && isset($_POST['valor']) && isset($_POST['vencimento']))
	{
		$condominos = $_POST['c'];
		$condominos = explode(",", $condominos);
		$descricao = $_POST['descricao'];
		$valor = $_POST['valor'];
		$vencimento = $_POST['vencimento'];
		
		$cobranca = new cobranca;
		$cobranca->descricao = $descricao;
		$cobranca->valor = cobranca::removeMarcacao($valor);
		$cobranca->vencimento = cobranca::dataToDb($vencimento);
		foreach($condominos as $c)
		{
			$cobranca->idUsuario = $c;
			$cobranca->insert();
		}
	}


?>
