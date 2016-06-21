<?php

function menu($link, $id, $img, $alt, $title)
{
	$pagina = end(explode('/', $_SERVER['PHP_SELF']));
	if($pagina == $link)
	{
		$formato = '.'.end(explode('.', $img));
		$img = str_replace($formato, '', $img).'_over'.$formato;
		echo "<li><a href='$link'><img id='$id' src='img/$img' alt='$alt' title='$title' /></a></li>";
	}
	else
	{
		echo "<li><a href='$link'><img id='$id' src='img/$img' alt='$alt' title='$title' /></a></li>";
	}
	
}
?>