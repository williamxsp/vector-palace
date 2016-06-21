<?php
if(!isset($usuario->tipo) || $usuario->tipo != 1)
{
	header("Location: home.php");
}
?>