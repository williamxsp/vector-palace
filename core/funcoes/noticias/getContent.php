<?php
require("../../classes/noticia.class.php");
if(isset($_POST['id']))
{
	$id = (int)$_POST['id'];
	$noticia = noticia::getById($id);
	if(is_object($noticia))
	{
		echo $noticia->conteudo;
	}
	else
		{
			
		}
}
else
	{
		
	}


 ?>