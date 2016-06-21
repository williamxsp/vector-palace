<?php 
header("Content-type:text/html; charset=iso-8859-1");
require_once('core/classes/usuario.class.php');
require_once('core/classes/cobranca.class.php');
require_once('core/classes/banco.class.php');
$banco = 'boleto_bradesco.php';

if(isset($_GET['id'])&& isset($_GET['c']) )
{
	if((int)$_GET['id']> 0  && (int)$_GET['c'] > 0 )
	{
		$cobranca = cobranca::getById($_GET['c']);
		$cliente = usuario::getById($_GET['id']);
		$banco = banco::getById($cliente->idBanco);
		
		$dias_de_prazo_para_pagamento = 5;
		$taxa_boleto = 2.95;
		$data_venc = usuario::dataToUser($cobranca->vencimento);  // Prazo de X dias OU informe data: "13/04/2006"; 
		$valor_cobrado = $cobranca->valor; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
		$valor_cobrado = str_replace(",", ".",$valor_cobrado);
		$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');
		
		$dadosboleto["inicio_nosso_numero"] = "99";  // Inicio do Nosso numero -> 99 - Cobran�a Direta(Carteira 5) ou 0 - Cobran�a Simples(Carteira 1)
		$dadosboleto["nosso_numero"] = "0000020";  // Nosso numero sem o DV - REGRA: M�ximo de 7 caracteres!
		$dadosboleto["numero_documento"] = $cobranca->id;	// Num do pedido ou do documento
		$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
		$dadosboleto["data_documento"] = $cobranca->dataEmissao; // Data de emiss�o do Boleto
		$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
		$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula
		
		// DADOS DO SEU CLIENTE
		$dadosboleto["sacado"] = $cliente->nome;
		$dadosboleto["endereco1"] = "Rua Bento Branco de Andrade - 398";
		$dadosboleto["endereco2"] = "São Paulo - São Paulo -  CEP: 05623-562";
		
		// INFORMACOES PARA O CLIENTE
		$dadosboleto["demonstrativo1"] = "Pagamento de taxa de condominio";
		$dadosboleto["demonstrativo2"] = "Mensalidade referente a $cobranca->descricao <br>Taxa bancária - R$ ".number_format($taxa_boleto, 2, ',', '');
		$dadosboleto["demonstrativo3"] = "Vector Palace - www.vectorpalace.com.br";
		$dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2% apos o vencimento";
		$dadosboleto["instrucoes2"] = "- Receber ate 10 dias apos o vencimento";
		$dadosboleto["instrucoes3"] = "- Em caso de dvidas entre em contato conosco: administrador@vectorpalace.com.br";
		$dadosboleto["instrucoes4"] = "&nbsp; Emitido pelo sistema LDIT";
		$dadosboleto["quantidade"] = "001";
		
		$dadosboleto["valor_unitario"] = $valor_boleto;
		$dadosboleto["aceite"] = "";		
		$dadosboleto["especie"] = "R$";
		$dadosboleto["especie_doc"] = "DS";
		
		// SEUS DADOS
		$dadosboleto["identificacao"] = "Vector Palace - Condominio de Luxo";
		$dadosboleto["cpf_cnpj"] = "15287618000151";
		$dadosboleto["endereco"] = "Rua Bento Branco de Andrade Filho, 350";
		$dadosboleto["cidade_uf"] = "São Paulo / SP";
		$dadosboleto["cedente"] = "Vector Palace";
		
		$dadosboleto["especie_doc"] = "DS";
		
		include("core/funcoes/boleto/".$banco->nomeArquivo);
	}
	else
		{
			die("Boleto INválido");
		}
}
else
	{
		die("Boleto INválido");
	}
 
 ?>