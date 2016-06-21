<?php
	session_start(); 
	include("../../classes/usuario.class.php");
	include("../../classes/noticia.class.php");
	$usuario = usuario::carregaInfo();
	include("../checaAdmin.php");
	$noticia = new noticia;
	if(!isset($_POST['id']))
	{
		noticia::setFeedBack(false, '', 'Notícia inválida');
	}
	else
		{
			if($noticia = noticia::getById($_POST['id']))
			{
				$noticia->delete();
			}
			else
				{
				noticia::setFeedBack(false, '', 'Notícia inválida');	
				}
		}
?>