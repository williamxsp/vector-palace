<?php 
require('database.class.php');

	class estado extends database
	{
		public $id;
		public $uf;
		public $nome;
		
		public static function getAll()
		{
			$sql = "SELECT * FROM estados";
			$db = new database;
			$query = $db->query($sql);
			$result = array();
			while($row = $query->fetch_object())
			{
				$result[] = $row;
			}
			$db->close();
			return $result;
		}
	}
 ?>