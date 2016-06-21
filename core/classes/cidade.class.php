<?php 
require('database.class.php');

	class cidade extends database
	{
		public $id;
		public $idEstado = 0;
		public $uf;
		public $nome;
		public $cidades;
		
		public function carregaCidades()
		{
			$this->cidades = array();
			$sql = "SELECT id, uf, nome FROM cidades WHERE idEstado = ?";
			$db = new database;
			$stmt = $db->stmt_init();
			
			if($stmt->prepare($sql))
			{
				$stmt->bind_param('i', $this->idEstado);
				$stmt->execute();
				$stmt->bind_result($id, $uf, $nome);
				while($row = $stmt->fetch())
				{
					$this->cidades[] = array('id' => $id, 'uf' => $uf, 'nome' => $nome, );
				}
				$stmt->close();
			}
			$db->close();
			return true;
		}
	}
 ?>