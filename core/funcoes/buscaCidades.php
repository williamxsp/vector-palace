<?php
require('../classes/cidade.class.php');

$idEstado = 0;

if(isset($_GET['idEstado']))
{
	$idEstado = (int)$_GET['idEstado'];
}
$cidades = new cidade;
$cidades->idEstado = $idEstado;
$cidades->carregaCidades();

	foreach ($cidades->cidades as $id => $cidade) {
		?>
			<option value="<?php echo $cidade['id']; ?>"><?php echo $cidade['nome'];?></option>
		<?php
	}

?>