<?php  require_once('database.class.php'); ?>
<?php  require_once('usuario.class.php'); ?>

<?php
	class noticia extends database
	{
		public $id;
		public $idUsuario;
		public $imagem;
		public $nomeUsuario;
		public $titulo;
		public $data;
		public $conteudo;
		public $tags ='';
		public $aprovado = 0;
		
		
		
	public function insert($tipo = 0)
		{
			$aprovado;
			
			if($tipo == 1)
			{
				$aprovado = 1;
			}
			else
				{
					$aprovado = 0;
				}
			
			$affected_rows = 0;
			$insert_id = 0;
			$db = new database;
			$sql = "INSERT INTO noticias(idUsuario, titulo, data, conteudo, tags, aprovado) VALUES (?, ?, NOW(), ?, ?, $aprovado)";
			$stmt = $db->stmt_init();

			if($stmt->prepare($sql))
			{
				$stmt->bind_param('isss', $this->idUsuario, $this->titulo, $this->conteudo, $this->tags);
				$stmt->execute();
				$insert_id = $stmt->insert_id;
				$stmt->close();
			}
			
			$db->close();
			
			if($insert_id > 0)
			{
				if($aprovado == 0)
				{
				$this->setFeedBack(true, "Notícia cadastrada com sucesso. Aguarde o administrador aprovar sua notícia", "Não foi possível cadastrar a sua notícia");
				$this->sendMail("administrador@localhost.com", "Vector Palace - Notícia cadastrada com sucesso", "Uma nova notícia foi cadastrada");
				}
				else
					{
						$this->setFeedBack(true, "Notícia cadastrada com sucesso.", "Não foi possível cadastrar a sua notícia");
					}
				
			}
			else
				{
									$this->setFeedBack(false, "Notícia cadastrada com sucesso. Aguarde o administrador aprovar sua notícia", "Não foi possível cadastrar a sua notícia");
				}
			$this->id = $insert_id;
			
			return $this->id;
			
					
	}
		
		public static function getAll($inicio = 0, $quantidade = 5, $aprovados = 2)
		{
			// APROVADOS 
			// 0 = AGUARDANDOAPROVACAO
			// 1 = APROVADO
			// 2 = TODOS
			$result = array();
			$db = new database;
			
			if($aprovados == 0)
			{
				$aprovados = "AND aprovado = 0";
			}
			elseif($aprovados == 1)
				{
					$aprovados = 'AND aprovado = 1';
				}
			else
				{
					$aprovados = '';
				}
			
			$sql = "SELECT noticias.id, idUsuario, nome as nomeUsuario, titulo, data, conteudo, tags, aprovado 
			FROM noticias 
			INNER JOIN usuarios
			ON noticias.idUsuario = usuarios.id WHERE 1=1 $aprovados ORDER BY data DESC, id DESC LIMIT $inicio, $quantidade";
			$query = $db->query($sql);
			
			while($row = $query->fetch_object())
			{
				$result[] = $row;
			}
			
			return $result;
		}
		
		public static function getTotalAprovados()
		{
			$sql = "select count(*) as total from noticias where aprovado = 1";
			$db = new database;
			$query = $db->query($sql);
			$row = array();
			$row = $query->fetch_object();
			$db->close();
			return $row->total;
		}
		
		public static function getAguardandoAprovacao()
		{
			$sql = "select count(*) as total from noticias where aprovado = 0";
			$db = new database;
			$query = $db->query($sql);
			$row = array();
			$row = $query->fetch_object();
			$db->close();
			return $row->total;
		}
		
		public static function getTotal()
		{
			$sql = "select count(*) as total from noticias";
			$db = new database;
			$query = $db->query($sql);
			$row = array();
			$row = $query->fetch_object();
			$db->close();
			return $row->total;
		}
		
		public static function getById($idNoticia)
		{
			$result = FALSE;
			$id = FALSE;
			$idUsuario;
			$nomeUsuario;
			$titulo;
			$data;
			$conteudo;
			$tags;
			$aprovado;
			$sql = "SELECT noticias.id, idUsuario, nome, titulo, data, conteudo, tags, aprovado 
			FROM noticias 
			INNER JOIN usuarios
			ON noticias.idUsuario = usuarios.id where noticias.id = ?";
			
			$db = new database;
			
			$stmt = $db->stmt_init();
			if($stmt->prepare($sql))
			{
				$stmt->bind_param('i', $idNoticia);
				$stmt->execute();
				$stmt->bind_result($id, $idUsuario, $nomeUsuario, $titulo, $data, $conteudo, $tags, $aprovado);
				$stmt->fetch();
				$stmt->close();
			}

			if($id)
			{
				$result = new self;
				$result->id = $id;
				$result->idUsuario = $idUsuario;
				$result->nomeUsuario = $nomeUsuario;
				$result->titulo = $titulo;
				$result->data  = $data;
				$result->conteudo = $conteudo;
				$result->tags = $tags;
				$result->aprovado = $aprovado;
			}
			$db->close();
			return $result;
			
			
		}

	public function update()
	{
		$affected_rows = 0;
		$sql = "UPDATE noticias SET idUsuario = ?, titulo = ?, data = ?, conteudo = ?, tags = ?, aprovado = ? WHERE id = ?";
		$db = new database;
		$stmt = $db->stmt_init();
		
		if($stmt->prepare($sql))
		{
			$stmt->bind_param('issssii', $this->idUsuario, $this->titulo, $this->data, $this->conteudo, $this->tags, $this->aprovado, $this->id);
			$stmt->execute();
			$affected_rows = $stmt->affected_rows;
			$stmt->close();
		}
		$db->close();
		if($affected_rows >= 0 )
		{
			$this->setFeedBack(true, "Notícia atualizada com sucesso", "Não foi possível atualizar essa notícia");
			return true;
		}
		else
			{
				$this->setFeedBack(true, "Notícia atualizada com sucesso", "Não foi possível atualizar essa notícia");
				return false;
			}
		
	}
	
	public function delete()
	{
		$affected_rows = 0;
		$sql = "DELETE FROM noticias WHERE id = ?";
		$db = new database;
		$stmt = $db->stmt_init();
		
		if($stmt->prepare($sql))
		{
			$stmt->bind_param('i', $this->id);
			$stmt->execute();
			$affected_rows = $stmt->affected_rows;
			$stmt->close();
		}
		if($affected_rows <= 0 )
		{
			$this->setFeedBack(false, "", 'Não foi possível remover essa notícia');
		}
		else
			{
				echo 1;
			}
		$db->close();
	}
	
	

 function aprovar()
	{
		$sql = "UPDATE noticias SET aprovado = 1 WHERE id = ?";
		$db = new database;
		$affected_rows = 0;
		$stmt = $db->stmt_init();

		if($stmt->prepare($sql))
		{
			$stmt->bind_param('i', $this->id);
			$stmt->execute();
			$affected_rows = $stmt->affected_rows;
			$stmt->close();

		}
		
		$db->close();

		//Enviar Email
		if($affected_rows >= 0)
		{
			$sql = "SELECT email FROM usuarios WHERE receberNoticias = 1";
			
			$db = new database;
			$query = $db->query($sql);
			
			$emails = array();
			
			while($row = $query->fetch_object())
			{
				$emails[] = $row->email;
			}
			
			
			foreach($emails as $email)
			{
				$this->sendMail($email, "Vector Palace - Noticia aprovada", "<h3>".$this->titulo."</h3><br /><br />".$this->conteudo);
		}
		}
		
		if($affected_rows > 0 )
		{echo "A";
			$this->setFeedBack(true, "Notícia aprovada com sucesso", "Não foi possível aprovar essa notícia");
			
			return true;
		}
		elseif($affected_rows == 0)
			{
				$this->setFeedBack(true, "Essa notícia já foi aprovada", "Não foi possível aprovar essa notícia");
				return true;
			}
		else
			{
				$this->setFeedBack(false, "Notícia aprovada com sucesso", "Não foi possível aprovar essa notícia");
				return false;
			}
	}
	
	 function desaprovar()
	{
		$sql = "UPDATE noticias SET aprovado = 0 WHERE id = ?";
		$db = new database;
		$affected_rows = 0;
		$stmt = $db->stmt_init();
		
		if($stmt->prepare($sql))
		{
			$stmt->bind_param('i', $this->id);
			$stmt->execute();
			$affected_rows = $stmt->affected_rows;
			$stmt->close();
		}
		
		$db->close();
		
		if($affected_rows > 0 )
		{
			$this->setFeedBack(true, "Notícia desabilitada com sucesso", "Não foi possível desabilitar essa notícia");
			return true;
		}
		elseif($affected_rows == 0)
			{
				$this->setFeedBack(true, "Essa notícia já foi desabilitada", "Não foi possível desabilitar essa notícia");
				return true;
			}
		else
			{
				$this->setFeedBack(false, "Notícia desabilitada com sucesso", "Não foi possível desabilitar essa notícia");
				return false;
			}
	}
	
	public static function sendMail($para, $assunto, $mensagem) {
		$header = "MIME-Version: 1.0\n";
		$header .= "Content-type: text/html; charset=UTF-8\n";
		$header .= "From: administrador@localhost.com\n";

		$mensagem.="<div style='color:#666'><br /><br /><br />Vector Palace - <strong>2011</strong>
			<br />
			Rua Bento Branco de Andrade Filho, 2<br />
			São Paulo - SP
			<br />
			<a style='color:#333' href='www.vectorpalace.com.br'>www.vectorpalace.com.br</a>
			</div>";
		mail($para, $assunto, $mensagem, $header);

	}
	
	
}




?>


