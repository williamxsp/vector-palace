<?php 
	include('database.class.php');
	
	class condominio extends database
	{
		public $idCondominio;
		public $descricao;
		
		public static function getAll()
		{
			$sql = "SELECT id, descricao from condominios";
			$result = array();
			$db = new database;
			
			if($query = $db->query($sql))
			{
				while($row = $query->fetch_object())
				{
					$result[] = $row;
				}
				
			}
			else
				{
					return false;
				}
				
			return $result;
			
		}
		
		public static function getById($id)
		{
			if(!(int)$id){return false;} //checa se recebemos um número válido
			
			$sql = "SELECT id, descricao FROM condominios WHERE id = ?";
			$db = new database;
			$result = FALSE;
			$statement = $db->stmt_init();
			
			$idCondominio = FALSE;
			$descricao;
			
			if($statement->prepare($sql))
			{
				$statement->bind_param('i', $id);
				$statement->execute();
				$statement->bind_result($idCondominio, $descricao);
				$statement->fetch();
				$statement->close();
			}
			
			if($id)
			{
				$result = new self;
				$result->idCondominio = $idCondominio;
				$result->descricao  = $descricao;
			}
			$db->close();
			return $result;
		}
		
		public function insert()
		{
			$sql = "INSERT INTO condominios (descricao) VALUES (?)";
			$affected_rows = FALSE;
			$db = new database;
			$statement = $db->stmt_init();
			
			if($statement->prepare($sql))
			{
				$statement->bind_param('s', $this->descricao);
				$statement->execute();
				$affected_rows = $statement->affected_rows;
				$statement->close();
			}
			$db->close();
			return $affected_rows;
			
		}
		
		public function delete()
		{
			$affected_rows = FALSE;
			$sql = "DELETE FROM condominios WHERE id = ?";
			$db = new database;
			$stmt = $db->stmt_init();
			
			if($stmt->prepare($sql))
			{
				$stmt->bind_param('i', $this->idCondominio);
				$stmt->execute();
				$affected_rows = $stmt->affected_rows;
				$stmt->close();
			}
			
			$db->close();
			return $affected_rows;
		}
		public function update()
		{
			$sql = "UPDATE condominios SET descricao = ? WHERE id = ?";
			$affected_rows = FALSE;
			$db = new database;
			$stmt = $db->stmt_init();
			
			if($stmt->prepare($sql))
			{
				$stmt->bind_param('si', $this->descricao, $this->idCondominio);
				$stmt->execute();
				$affected_rows = $stmt->affected_rows;
				$stmt->close();
			}
			$db->close();
			return $affected_rows;
		}
	}

 ?>