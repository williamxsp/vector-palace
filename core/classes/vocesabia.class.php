<?php  require('database.class.php'); ?>

<?php
	class vocesabia extends database
	{
		public $id;
		public $descricao;
		
		public static function getRandom()
		{
			$sql = "SELECT id, descricao
					FROM vocesabia
					ORDER BY RAND()
					LIMIT 1";
		
			$db = new database;
			$result = FALSE;
			
			$query = $db->query($sql);
			
			$result = $query->fetch_object();
			$db->close();			
			return $result;
		}
		
		public function insert()
		{
			$affected_rows = 0;
			$sql = "INSERT INTO vocesabia (descricao) values (?)";
			$db = new database;
			
			$stmt = $db->stmt_init();
			
			if($stmt->prepare($sql))
			{
				$stmt->bind_param('s', $this->descricao);
				$stmt->execute();
				$affected_rows = $stmt->affected_rows;
				$stmt->close();
			}
			
			$db->close();
			
			return $affected_rows;
			
		}
		
		public function delete()
		{
			$affected_rows = 0;
			$sql = "DELETE FROM vocesabia WHERE id = ?";
			$db = new database;
			$stmt = $db->stmt_init();
			
			if($stmt->prepare($sql))
			{
				//$stmt->bind_param()
			}
		}
		
		public function update()
		{
			
		}

	}
	

?>