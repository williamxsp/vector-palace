<?php
	require('database.class.php');

	class banco extends database
	{
		public $id;
		public $descricao = '';
		public $nomeArquivo;
		
		public function getAll()
		{
			$sql = "SELECT * FROM bancos";
			$db = new database;
			$query = $db->query($sql);
			$result = array();
			
			while($row = $query->fetch_object())
			{
				$result[] = $row;
			}
			return $result;
		}
		
		public function getById($idBanco)
		{
			$result = array();
			$sql = "SELECT id, descricao, nomeArquivo FROM bancos WHERE id = ?";
			$db = new database;
			$stmt = $db->stmt_init();
			$id = 0;
			$descricao;
			$nomeArquivo;
			
			if($stmt->prepare($sql))
			{
				$stmt->bind_param('i', $idBanco);
				$stmt->execute();
				$stmt->bind_result($id, $descricao, $nomeArquivo);
				$stmt->fetch();
				$stmt->close();
			}
			$db->close();
			
			if($id)
			{
				$result = new self;
				$result->id = $id;
				$result->descricao = $descricao;
				$result->nomeArquivo = $nomeArquivo;
			}
			else
				{
					return false;
				}
				return $result;
		}
	}

?>