<?php session_start(); 
require_once('../classes/usuario.class.php');
require_once('../classes/noticia.class.php');
$usuario = usuario::carregaInfo();
$noticia = new noticia;

if(isset($_POST['titulo']) && isset($_POST['conteudo']))
{
	$titulo = $_POST['titulo'];
	$conteudo = $_POST['conteudo'];
	$id = 0;
	if(isset($_POST['id']))
	{
		$id = (int)$_POST['id'];
	}
	
	if($id>0)
	{
		if($noticia = noticia::getById((int)$id))
		{
			$noticia->titulo = $titulo;
			$noticia->conteudo= $conteudo;
			if($noticia->update())
			{
				//VERIFICAR QUAL ID ESTÁ RETORNANDO AQUI
				echo $noticia->id;
			}
			else
				{
					echo "0";
				}
			
		}
	}
	else
		{
			$noticia->idUsuario = $usuario->id;
			$noticia->titulo = $titulo;
			$noticia->conteudo = $conteudo;
			$id = 0;
			if($id = $noticia->insert($usuario->id))
			{
				echo $id;
			}
			else
				{
					echo "0";
				}
		}
}
else
	{
		echo "0";
	}
 
 ?>


