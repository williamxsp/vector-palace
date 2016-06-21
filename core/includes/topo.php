<?php session_start(); ?>
<?php require_once('core/classes/usuario.class.php')?>
<?php require_once('core/funcoes/menuAtivo.php')?>

<?php	
	$usuario = usuario::carregaInfo();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Vector Palace ::</title>
<link rel="stylesheet" type="text/css" href="css/geral.css"/>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="css/iehacks.css"/>
<![endif]-->

<?php
 if($usuario->tipo == 1)
{?>
	<link rel="stylesheet" type="text/css" href="css/admin.css"/>
	<?php
}
 ?>
<link rel="stylesheet" type="text/css" href="temas/<?php echo $usuario->tema; ?>/estilo.css"/>
<link rel="stylesheet" type="text/css" href="temas/<?php echo $usuario->tema; ?>/jquery-ui-1.8.16.custom.css"/>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/ui.utils.js"></script>
<script type="text/javascript" src="js/dd_roundies.js"></script>
<script type="text/javascript" src="js/menuOver.js"></script>

<script type="text/javascript">
	$(document).ready(
		function(){
			
			//DD_roundies.addRule(".ui-corner-all", "8px", true); //arredondar bordas IECA
			
			$("input[type='submit'], input[type='reset'], input[type='button']").button();
			//$("input[type='reset']").button();
			$("fieldset").attr("class", "ui-corner-all");
			
			$("input.login, textarea.login").focus(function(){

				texto = $(this).attr("title");
				if($(this).val() == texto)
				{
					$(this).val("");
				}
			});
			
			$("input.login, textarea.login").blur(function(){
				texto = $(this).attr("title");
				if($(this).val() == '')
				{
					$(this).val(texto);
				}
			});
			
			}
		);
</script>
</head>

<body>
<?php if($usuario->tipo == 1)
{?>
<div id="barraAdmin">
	<div id="conteudoBarraAdmin">
	<div id="nomeAdmin">
			Olá <?php echo $usuario->nome; ?>
	</div>
	<div id="menuAdmin">
		<a href="gerenciarNoticias.php">Gerenciar Notícias</a>
		<a href="#">Gerenciar Usuários</a>
		<a href="gerenciarCobrancas.php">Gerenciar Cobranças</a>
		<a href="#">Gerenciar Administradores</a>
	</div>
	</div>
</div>
<div id="sombra"></div>
<?php
}
?>
  <div id="geral">
  	<div id="topo">
    	<div id="logo">
			<h1><a href="home.php">Vector Palace</a></h1>
	
	<a href="home.php"><img src="img/logo.png" alt="Vector Palace" title="Clique para voltar para a página inicial" /></a>		
        </div><!-- Logo -->
    </div><!-- topo -->
    
    <div id="menu">
    	
    	<ul><?php
    	 menu('home.php', 'menu_inicial', 'menu_inicial.png', 'Início', 'Voltar para a página inicial');
		 menu('noticias.php', 'menu_noticias', 'menu_noticias.png', 'Notícias de Condomínio', 'Ver as notícias');
		 menu('meuCadastro.php', 'menu_cadastro', 'menu_cadastro.png', 'Meu Cadastro', 'Editar o seu perfil');
		 menu('faleConosco.php', 'menu_fale', 'menu_fale.png', 'Fale Conosco', 'Entre em contato');
		 menu('financeiro.php', 'menu_financeira', 'menu_financeira.png', 'Situação Financeira', 'Veja a sua situação financeira');
		 menu('agenda.php', 'menu_agenda', 'menu_agenda.png', 'Agenda', 'Veja os próximos eventos');
		 
		 
		 ?></ul></div><!-- menu -->
	<div id="conteudo_topo"></div>
    <div id="conteudo">
