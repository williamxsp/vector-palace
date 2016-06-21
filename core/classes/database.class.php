<?php
if(!class_exists('database')){
  class database extends mysqli
  {
	
	private $user;
	private $pass;
	private $host;
	private $dbname;
	
	
	public function __construct()
	{

		try
		{
			if($_SERVER['HTTP_HOST'] == 'localhost')
			{
				$this->user = "root";
				$this->pass = "azul*22";
				$this->host = "localhost";
				$this->dbname = "tcc";
			}
			else
				{
					$this->user = "archangelo14";
					$this->pass = "vector1020";
					$this->host = "186.202.13.23";
					$this->dbname = "archangelo14";	
				}

			parent::__construct($this->host, $this->user, $this->pass, $this->dbname); 

		}
		catch(Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	public static function setFeedBack($status, $positivo = '', $negativo = '')
	{
		if(!isset($_SESSION))
		{
			session_start();
			echo 1;
			die();
		}
		
		if($status)
		{
			$_SESSION['msg'] = $positivo;
			$_SESSION['tipo'] = 'positivo';
		}
		else
		{
			$_SESSION['msg'] = $negativo;
			$_SESSION['tipo'] = 'erro';
		}
	}
	
	public static function getFeedBack()
	{

		if(isset($_SESSION['msg']))
		{
			if(isset($_SESSION['tipo']))
			{
				if($_SESSION['tipo'] == 'positivo')
				{
						echo "<div class='ui-widget'>
									<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0.7em;'> 
										<p><span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
										".$_SESSION['msg']."
										</p>
									</div>
								</div>";	
				}
				else
					{
						echo "<div class='ui-widget'>
								<div class='ui-state-error ui-corner-all' style='padding: 0 .7em;'> 
									<p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span>
									".$_SESSION['msg']." 
									</p>
								</div>
								</div>";
					}
			}
			unset($_SESSION['msg']);
		}
	}
	
	public static function dataToDb($data)//Converte a data de dd/mm/Y para dd-mm-Y
	{
		if(strpos($data, '/'))
		{
			$novaData = explode('/', $data);
			if(count($novaData) == 3)
			{
				$data = $novaData[2].'-'.$novaData[1].'-'.$novaData[0];
			}
		}
		return $data;
	}
	
	public static function dataToUser($data)//Converete a data para ser exibida para o usuário dd/mm/Y
	{
		if(strpos($data, '-'))
		{
			$novaData = explode('-', $data);
			if(count($novaData) == 3)
			{
				$data = $novaData[2].'/'.$novaData[1].'/'.$novaData[0];
			}
		}
		return $data;
	} 
	
	public static function removeMarcacao($valor)
	{
		$inteiro = 0;
		$double = 0;
		
		$valor = str_replace('.', '', $valor);
		$valor = explode(',', $valor);
		
		if(isset($valor[0]))
		{
			$inteiro = $valor[0];
			if(isset($valor[1]))
			{
				$double = floatval('0.'.$valor[1]);
			}
		}
		else
			{
				$inteiro = $valor;
			}
		 

		$valor = floatval($inteiro+$double);

		return $valor;
	}
	
  } //endclass
  
  
  }  
?>
