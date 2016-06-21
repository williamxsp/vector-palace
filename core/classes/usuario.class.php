<?php
require ('database.class.php');
?>

<?php
class usuario extends database {
	/*id 	nome 	email 	senha 	cpf 	telefone 	celular 	endereco 	idCondominio
	 * receberNoticias 	numeroTentativasLogin 	tema 	tipo
	 */
	public $id;
	public $nome;
	public $email;
	public $senha;
	public $cpf;
	public $telefone;
	public $celular;
	public $idCondominio;
	public $descricaoCondominio;
	public $receberNoticias;
	public $numeroTentativasLogin;
	public $tema;
	public $tipo;
	public $idBanco = 1;
	public $bloqueado;

	public function insert() {
		$affected_rows = 0;
		$db = new database;
		$sql = "INSERT INTO usuarios 
			(nome, email, senha, cpf, telefone, celular, idCondominio, descricaoCondominio, receberNoticias, numeroTentativasLogin, tema, tipo, idBanco)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
		$stmt = $db -> stmt_init();

		/*VALIDA O CPF*/

		/*VALIDA EMAIl*/

		if($stmt -> prepare($sql)) {
			$stmt -> bind_param('ssssssisiisii', $this -> nome, $this -> email, $this -> senha, $this -> cpf, $this -> telefone, $this -> celular, $this -> idCondominio, $this -> descricaoCondominio, $this -> receberNoticias, $this -> numeroTentativasLogin, $this -> tema, $this -> tipo, $this -> idBanco);
			$stmt -> execute();
			$affected_rows = $stmt -> affected_rows;
			$stmt -> close();
		}
		$db -> close();

		return $affected_rows;
	}

	public static function getAll($administradores = true, $usuarios = true) {
		$result = array();
		$db = new database;
		$where = "1 = 1";
		if($administradores && !$usuarios)
		{
		$where = "tipo = 1";	
		}
		elseif(!$administradores && $usuarios)
		{
			$where = "tipo = 0";
		}
		
		$sql = "SELECT usuarios . * , condominios.id AS idCondominio, descricao AS descricaoCondominio
				FROM usuarios
				INNER JOIN condominios ON usuarios.idCondominio = condominios.id 
				WHERE $where";
		
		$query = $db -> query($sql);

		while($row = $query->fetch_object()) {
			$result[] = $row;
		}

		return $result;
	}

	public static function getById($idUsuario) {
		/*id 	nome 	email 	senha 	cpf 	telefone 	celular 	endereco 	idCondominio
		 * receberNoticias 	numeroTentativasLogin 	tema 	tipo
		 */
		$result = FALSE;
		$id = FALSE;
		$nome;
		$email;
		$senha;
		$cpf;
		$telefone;
		$celular;
		$idCondominio;
		$descricaoCondominio;
		$receberNoticias;
		$numeroTentativasLogin;
		$tema;
		$tipo;
		$idBanco;
		$sql = "SELECT id, nome, email, senha, cpf, telefone, celular, idCondominio, receberNoticias, numeroTentativasLogin, tema, tipo, idBanco 
			 		FROM usuarios
			 		WHERE id = ?";

		$db = new database;

		$stmt = $db -> stmt_init();
		if($stmt -> prepare($sql)) {
			$stmt -> bind_param('i', $idUsuario);
			$stmt -> execute();
			$stmt -> bind_result($id, $nome, $email, $senha, $cpf, $telefone, $celular, $idCondominio, $receberNoticias, $numeroTentativasLogin, $tema, $tipo, $idBanco);
			$stmt -> fetch();
			$stmt -> close();
		}

		if($id) {
			$result = new self;
			$result -> id = $id;
			$result -> nome = $nome;
			$result -> email = $email;
			$result -> senha = $senha;
			$result -> cpf = $cpf;
			$result -> telefone = $telefone;
			$result -> celular = $celular;
			$result -> idCondominio = $idCondominio;
			$result -> receberNoticias = $receberNoticias;
			$result -> numeroTentativasLogin = $numeroTentativasLogin;
			$result -> tema = $tema;
			$result -> tipo = $tipo;
			$result -> idBanco = $idBanco;
		}

		$db -> close();
		return $result;

	}


	public function update() {

		$affected_rows = 0;
		$sql = "UPDATE usuarios SET nome = ?, email = ?, senha = ?, cpf = ?, telefone = ?, celular = ?, idCondominio = ?, receberNoticias = ?, numeroTentativasLogin = ?, tema = ?, tipo = ?, idBanco = ? where id = ?";

		$db = new database;
		$stmt = $db -> stmt_init();

		if($stmt -> prepare($sql)) {
			$stmt -> bind_param('ssssssiiisiii', $this -> nome, $this -> email, $this -> senha, $this -> cpf, $this -> telefone, $this -> celular, $this -> idCondominio, $this -> receberNoticias, $this -> numeroTentativasLogin, $this -> tema, $this -> tipo, $this -> idBanco, $this -> id);
			$stmt -> execute();
			$affected_rows = $stmt -> affected_rows;
			$stmt -> close();
		}

		if($affected_rows > 0) {
			$this -> setFeedBack(true, 'Perfil atualizado com sucesso', '');
		} elseif($affected_rows == 0) {
			$this -> setFeedBack(true, 'Perfil atualizado com sucesso', '');
		} else {
			$this -> setFeedBack(false, '', 'Não foi possível atualizar o seu perfil');
		}
		$db -> close();
	}

	public function delete() {
		$affected_rows = 0;
		$sql = "DELETE FROM usuarios WHERE id = ?";
		$db = new database;
		$stmt = $db -> stmt_init();

		if($stmt -> prepare($sql)) {
			$stmt -> bind_param('i', $this -> id);
			$stmt -> execute();
			$affected_rows = $stmt -> affected_rows;
			$stmt -> close();
		}
		return $affected_rows;
		$db -> close();
	}

	public static function checaLogin() {
		if(!isset($_SESSION['logado']) && !isset($_COOKIE['logado'])) {
			header("Location: login.php");
		}
	}

	public static function carregaInfo() {
		self::checaLogin();
		/*
		 $usuario = new self;

		 if(isset($_SESSION['tema']) && isset($_SESSION['nome']))
		 {
		 $usuario->id = $_SESSION['logado'];
		 $usuario->nome= $_SESSION['nome'];
		 $usuario->tema = $_SESSION['tema'];
		 $usuario->tema = $_SESSION['idBanco'];

		 }
		 else
		 {
		 $usuario = self::getById((int)$_SESSION['logado']);

		 }
		 */
		$usuario = new self;
		if(isset($_SESSION['logado']))
		{
			$usuario = self::getById((int)$_SESSION['logado']);
		}
		else
			{
				$usuario = self::getById((int)$_COOKIE['logado']);
			}
		
		return $usuario;

	}

	public static function login($emailUsuario, $senha, $lembrarSenha = 0) {

		if($emailUsuario == '' || $senha == '') {

			self::setFeedBack(FALSE, '', "Usuário ou senha não pode ser em branco");
		}
		
		$senha = md5($senha);
		$sql = "SELECT id, email, senha, nome, tema, numeroTentativasLogin, bloqueado FROM usuarios WHERE email = ? AND senha = ?";

		$db = new database;
		$stmt = $db -> stmt_init();

		$result = FALSE;
		$id = 0;
		$email;
		$nome;
		$tema;
		$numeroTentativasLogin;
		$bloqueado;

		if($stmt -> prepare($sql)) {
			$stmt -> bind_param('ss', $emailUsuario, $senha);
			$stmt -> execute();
			$stmt -> bind_result($id, $email, $senha, $nome, $tema, $numeroTentativasLogin, $bloqueado);

			if(!$stmt -> fetch()) {

				self::setFeedBack(FALSE, '', "Usuário ou senha inválido");

				$stmt -> close();

				// CHECA numeroTentativasLogin

				$sql = "SELECT id, numeroTentativasLogin FROM usuarios WHERE email = ?";

				$stmt = $db -> stmt_init();
				if($stmt -> prepare($sql)) {

					$stmt -> bind_param('s', $emailUsuario);
					$stmt -> execute();
					$stmt -> bind_result($id, $numeroTentativasLogin);
					if($stmt -> fetch()) {
						$stmt -> close();
						if($numeroTentativasLogin > 4) {
							//BLOQUEIA A CONTA
							$stmt = $db -> stmt_init();
							$sql = "UPDATE usuarios SET bloqueado = 1 WHERE email = ?";
							if($stmt -> prepare($sql)) {
								$stmt -> bind_param('s', $emailUsuario);
								$stmt -> execute();
								if($stmt -> affected_rows > 0) {
									$stmt -> close();
									//CRIA E CADASTRA O CODIGO DE VERIFICACAO DE DESBLOQUEIO
									$caracteres = '0123456789abcdefghijklmnopqrstuvwxyz';
									$randomPass = '';

									for($p = 0; $p < 10; $p++) {
										$randomPass .= $caracteres[mt_rand(0, 35)];
									}

									$sql = "INSERT INTO contasbloqueadas (idUsuario, codVerificacao) VALUES ($id, '$randomPass')";
									$db -> query($sql);

									self::setFeedBack(false, "", "A sua conta foi bloqueada. Uma mensagem foi enviada para o seu email");
									self::sendMail($emailUsuario, "Vector Palace - Conta Bloqueada", "A sua conta foi bloqueada porque houveram 5 tentativas de login sem sucesso.<br /> 
																Para desbloquear a sua conta <a href='http://localhost/tcc/desbloquear.php?email=$emailUsuario&cod=$randomPass'>clique aqui</a> e
																entre com seu CPF.
									");

								}
							}

						} else {
							$stmt = $db -> stmt_init();
							$sql = "UPDATE usuarios SET numeroTentativasLogin = numeroTentativasLogin+1 WHERE email = ?";

							if($stmt -> prepare($sql)) {
								$stmt -> bind_param('s', $emailUsuario);
								$stmt -> execute();
								$stmt -> close();
							}
							$restante = 5 - $numeroTentativasLogin;
							self::setFeedBack(false, "", "Senha inválida. Número de tentativas restantes: $restante");
						}

					}
				}

			} else {

				if($bloqueado == '1') {
					self::setFeedBack(false, "", "A sua conta está bloqueada. Aguarde ela ser liberada.");
					return false;
				}
				$_SESSION['logado'] = $id;
				$_SESSION['email'] = $email;
				$_SESSION['tema'] = $tema;
				if($lembrarSenha == 1)
				{
					setcookie("logado", $id, time()+60*60*24*10);
				}
				$sql = "UPDATE usuarios SET numeroTentativasLogin = 0 WHERE email = $email";
				$db -> query($sql);
				header("Location: home.php");
			}
		}

	}

	public static function getEmails() {
		$sql = "SELECT email FROM usuarios WHERE receberNoticias = 1";
		$db = new database;
		$query = $db -> query($sql);
		$result = array();

		while($row = $query -> fetch_object()) {
			$result[] = $row;
		}

		return $result;
	}

	public static function recuperarSenha($cpf) {
		if($cpf == '') {
			echo "$cpf inválido";
		}

		$db = new database;
		$email = '';
		
		$caracteres = '0123456789abcdefghijklmnopqrstuvwxyz';
		$randomPass = '';
		$novaSenha = '';

		for($p = 0; $p < 5; $p++) {
			$randomPass .= $caracteres[mt_rand(0, 35)];
		}
									
		$novaSenha = md5($randomPass);

		//checar se o cpf já existe;

		$sql = "SELECT cpf, email FROM usuarios WHERE cpf = ?";
		$stmt = $db -> stmt_init();

		if($stmt -> prepare($sql)) {
			$stmt -> bind_param('s', $cpf);
			$stmt -> execute();
			$stmt -> bind_result($cpf, $email);
			if($stmt -> fetch()) {
				$stmt -> close();

				//Altera a senha
				$sql = "UPDATE usuarios SET senha = ? WHERE cpf = ?";
				$stmt = $db -> stmt_init();
				$affected_rows = 0;
				if($stmt -> prepare($sql)) {
					$stmt -> bind_param('ss', $novaSenha, $cpf);
					$stmt -> execute();
					$affected_rows = $stmt -> affected_rows;
					if($affected_rows > 0) {
						self::sendMail($email, "Vector Palace - Recuperar Senha", "
								Caro Usuário,<br /><br />
								Se você não fez nenhum pedido para recuperar sua senha, apenas ignore esse email.<br /><br />
								Para acessar o website da Vector Palace, utilize os seguintes dados:<br />
								<strong>Email:</strong> ".$email."<br />
								<strong>Senha: </strong>".$randomPass."<br /><br />
								Caso queira mudar sua senha, acesse a página meu cadastro.
								");
						return "Senha alterada com sucesso. Cheque seu email.";
					} elseif($affected_rows == 0) {
						return "Sua senha já foi alterada. Verifique no seu email.";
					}
				} else {
					return "Não foi possível alterar a sua senha 2";
				}
			} else {
				return "CPF Inválido";
			}
		} else {
			return "Não foi possível alterar a sua senha. Tente mais tarde.";
		}
	}

	public static function desbloquear($email, $cod, $cpf)
	{
		//CHECAR SE o usuário existe
		$sql = "SELECT id FROM usuarios WHERE email = ? AND cpf = ?";
		$db = new database;
		$stmt = $db->stmt_init();
		$id = 0;
		
		if($stmt->prepare($sql))
		{
			$stmt->bind_param('ss', $email, $cpf);
			$stmt->execute();
			$stmt->bind_result($id);
			$stmt->fetch();
			$stmt->close();
		}
		
		if($id > 0)
		{
			$sql = "DELETE FROM contasbloqueadas WHERE idUsuario = ? and codVerificacao = ?";
			$stmt =$db->stmt_init();
			$rows = 0;
			
			if($stmt->prepare($sql))
			{
				$stmt->bind_param('is', $id, $cod);
				$stmt->execute();
				$rows = $stmt->affected_rows;
				$stmt->close();
			}
			
			if($rows > 0)
			{
				$sql = "UPDATE usuarios set bloqueado = 0, numeroTentativasLogin = 0 WHERE id = ?";
				$stmt = $db->stmt_init();
				if($stmt->prepare($sql))
				{
					$stmt->bind_param('i', $id);
					$stmt->execute();
					$stmt->close();
				}
				return "Sua conta foi desloqueada. Clique <a href='login.php'>aqui</a> para ir à página de login.";
			}
			else
				{
					return "Conta liberada ou código de verificação inválido";
				}
		}
		else
			{
				return "Usuário não existe";
			}
			
	}



	public static function sendMail($para, $assunto, $mensagem) {
		$header = "MIME-Version: 1.0\n";
		$header .= "Content-type: text/html; charset=UTF-8\n";
		$header .= "From: administrador@localhost.com\n";

		$mensagem .= "<div style='color:#666'><br /><br /><br />Vector Palace - <strong>2011</strong>
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