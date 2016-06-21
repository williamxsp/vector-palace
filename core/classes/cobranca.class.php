<?php
require ('database.class.php');
?>

<?php

class cobranca extends database {
	public $id;
	public $idUsuario;
	public $descricao;
	public $valor;
	public $dataEmissao;
	public $vencimento;
	public $dataPagamento;
	public $status;

	public function insert() {
		$sql = "INSERT INTO cobrancas (idUsuario, descricao, valor, dataEmissao, vencimento, dataPagamento) VALUES (?, ?, ?, NOW(), ?,'0000-00-00')";
		$db = new database;
		$stmt = $db -> stmt_init();
		$affected_rows = 0;
		if($stmt -> prepare($sql)) {
			echo $this -> valor;
			$stmt -> bind_param('isds', $this -> idUsuario, $this -> descricao, $this -> valor, $this -> vencimento);
			$stmt -> execute();
			$affected_rows = $stmt -> affected_rows;
			$stmt -> close();
		}
		if($affected_rows > 0) {
			$this -> setFeedBack(true, "Cobranca cadastrada com sucesso", "Não foi possível cadastrar essa cobranca");
			return true;
		} else {
			$this -> setFeedBack(false, "Cobranca cadastrada com sucesso", "Não foi possível cadastrar essa cobranca");
			return false;
		}
	}

	public static function getAll() {
		
		
	}

	public static function getByUser($idUsuario, $pagos = 1, $quantidade = 100) {
		
		if($pagos == 1) {
			$pagos = "AND dataPagamento != '0000-00-00'";
		} elseif($pagos == 2) {
			$pagos = "AND dataPagamento = '0000-00-00'";
		}
		else
		{
			$pagos = "AND 1=1";
		}

		$quantidade = (int)$quantidade;

		$sql = "SELECT id, descricao, valor, dataEmissao, vencimento, dataPagamento, datediff(vencimento, NOW()) as status FROM cobrancas WHERE idUsuario = ? $pagos ORDER BY id DESC LIMIT 0, $quantidade";
		$db = new database;
		$result = array();
		$stmt = $db -> stmt_init();

		$id = 0;
		$descricao;
		$valor;
		$dataEmissao;
		$vencimento;
		$dataPagamento;
		$status;

		if($stmt -> prepare($sql)) {
			$stmt -> bind_param('i', $idUsuario);
			$stmt -> execute();
			$stmt -> bind_result($id, $descricao, $valor, $dataEmissao, $vencimento, $dataPagamento, $status);
			while($row = $stmt -> fetch()) {
				$result[] = new self;
				end($result) -> id = $id;
				end($result) -> idUsuario = $idUsuario;
				end($result) -> descricao = $descricao;
				end($result) -> valor = $valor;
				end($result) -> dataEmissao = $dataEmissao;
				end($result) -> vencimento = $vencimento;
				end($result) -> dataPagamento = $dataPagamento;
				end($result) -> status = (int)$status;
			}
		}
		$stmt -> close();
		$db -> close();
		return $result;

	}

	public static function getById($idCobranca) {
		$sql = "SELECT id, idUsuario, descricao, valor, dataEmissao, vencimento, dataPagamento FROM cobrancas WHERE id = ?";
		$db = new database;
		$stmt = $db -> stmt_init();
		$result = false;

		$id = 0;
		$idUsuario;
		$descricao;
		$valor;
		$dataEmissao;
		$vencimento;
		$dataPagamento;

		if($stmt -> prepare($sql)) {
			$stmt -> bind_param('i', $idCobranca);
			$stmt -> execute();
			$stmt -> bind_result($id, $idUsuario, $descricao, $valor, $dataEmissao, $vencimento, $dataPagamento);
			$stmt -> fetch();
			$stmt -> close();
		}

		$db -> close();

		if($id > 0) {
			$result = new self;
			$result -> id = $id;
			$result -> idUsuario = $idUsuario;
			$result -> descricao = $descricao;
			$result -> valor = $valor;
			$result -> dataEmissao = $dataEmissao;
			$result -> vencimento = $vencimento;
			$result -> dataPagamento = $dataPagamento;
			return $result;
		} else {
			return false;
		}

	}

	public function pagar() {
		$sql = "UPDATE cobrancas SET dataPagamento = NOW() WHERE id = ?";
		$db = new database;
		$stmt = $db -> stmt_init();
		$affected_rows = 0;

		if($stmt -> prepare($sql)) {
			$stmt -> bind_param('i', $this -> id);
			$stmt -> execute();
			$affected_rows = $stmt -> affected_rows;
			$stmt -> close();
		}

		if($affected_rows > 0) {
			$this -> setFeedBack(true, "Cobrança paga com sucesso", "Não foi possível pagar a cobrança");
			return true;
		} else {
			$this -> setFeedBack(false, "Cobrança paga com sucesso", "Não foi possível pagar a cobrança");
			return false;
		}
		$db -> close();
	}

	public function update() {

		$sql = "UPDATE cobrancas SET idUsuario = ?, descricao = ?, valor = ?, dataEmissao = ?, vencimento = ?, dataPagamento = ? WHERE id = ?";
		$affected_rows = 0;
		$db = new database;
		$stmt = $db -> stmt_init();

		if($stmt -> prepare($sql)) {
			$stmt -> bind_param('isdsssi', $this -> idUsuario, $this -> descricao, $this -> valor, $this -> dataEmissao, $this -> vencimento, $this -> dataPagamento, $this -> id);
			$stmt -> execute();
			$affected_rows = $stmt -> affected_rows;
			$stmt -> close();
		}

		if($affected_rows > 0) {
			$this -> setFeedBack(true, "Cobrança atualizada com sucesso", "Não foi possível atualizar essa cobrança");
			return true;
		} else {
			$this -> setFeedBack(false, "Cobrança atualizada com sucesso", "Não foi possível atualizar essa cobrança");
			return false;
		}
		$db -> close();
	}

	public function delete() {
		$sql = "DELETE FROM cobrancas WHERE id = ?";
		$affected_rows = 0;
		$db = new database;
		$stmt = $db -> stmt_init();
		if($stmt -> prepare($sql)) {
			$stmt -> bind_param('i', $this -> id);
			$stmt -> execute();
			$affected_rows = $stmt -> affected_rows;
			$stmt -> close();
		}

		if($affected_rows > 0) {
			$this -> setFeedBack(true, "Mensagem deletada com sucesso", "Não foi possível deletar essa mensagem");
			return true;
		} else {
			$this -> setFeedBack(false, "Mensagem deletada com sucesso", "Não foi possível deletar essa mensagem");
			return false;
		}
		$db -> close();
	}

	public static function getUsuariosDevedores()
	{
		$sql = "SELECT usuarios.id, nome, email, telefone FROM usuarios INNER JOIN cobrancas ON cobrancas.idUsuario = usuarios.id GROUP BY idUsuario";
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