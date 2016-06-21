<?php session_start(); ?>
<?php require_once('core/classes/usuario.class.php')?>
<?php 
	if(isset($_POST['btn']))
	{
		$lembrarSenha = 0;
		if(isset($_POST['lembrarSenha']))
		{
			$lembrarSenha = 1;
		}
		
		usuario::login($_POST['email'], $_POST['senha'], $lembrarSenha);		
	} 
?>

<?php if(isset($_SESSION['logado'])){header("Location: home.php");}  ?>
	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>:: Vector Palace ::</title>
	<link rel="stylesheet" type="text/css" href="css/geral.css"/>
	<link rel="stylesheet" type="text/css" href="css/login.css"/><br/>
	<link rel="stylesheet" type="text/css" href="temas/padrao/jquery-ui-1.8.16.custom.css"/>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/mask.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript">
	jQuery(function($){
				$("#cpf").mask("999.999.999-99");
	        });
	
    	function esqueciMinhaSenha()
    	{
    		$("#esqueciMinhaSenha").dialog('open');
    		
    	}
    	
		$(document).ready(function(){
			//$("#inputUsuario").focus();
			$("#esqueciMinhaSenha").dialog({ autoOpen: false,modal:true, width:500}); //abre a caixa de diálogo
			
			$("#esqueciMinhaSenha input[type='submit']").button();//transforma o botão de submit
			
			$("#esqueciMinhaSenha input[type='submit']").click(function(){ //faz o post para a página recuperarSenha.php
				var cpf = $("#esqueciMinhaSenha #cpf").val();
				
				$.ajax({
					data:"cpf="+cpf,
					url:"core/funcoes/recuperarSenha.php",
					type:"post",
					success:function(result)
					{
						$("#esqueciMinhaSenha").dialog('close');
						var feedBack = $("<p title='RecuperarSenha'>"+result+"</p>");
						$("#esqueciMinhaSenha form").children("input[type='submit']").removeAttr("disabled");
						feedBack.dialog({height:150, modal:true, resizable:false}); //exibe Mensagem de feedback que vem da página recuperarSenha
					}
				});
			});
			
			$("#esqueciMinhaSenha form").submit(function(){
				$(this).children("input[type='submit']").attr("disabled", "disabled");  //desabilita o botão para não enviar várias vezes
				
				return false;
			});
			
			$("#inputSenha").focus(function(){
				if($(this).attr("rel") == 'label')
				{
					$(this). attr("rel", "input");
					var inputSenha = $("<input type='password' name='senha' id='inputSenha' title='Digite a sua senha' />");
					$("#senha").html('');
					$("#senha").append(inputSenha);
					$("#inputSenha").focus();
				}
				
			});

			$("#inputEmail").focus(function(){
				if($(this).val() == 'email@dominio.com')
				{
					$(this).val('');
				}
			}
			);
			
			$("#inputEmail").blur(function(){
				if($(this).val() == '')
				{
					$(this).val('email@dominio.com');
				}
			}
			);
		});
		
				
		
	</script>
</head>

<body>


  <div id="geral">
  	<div id="topo">
    	<div id="logo">
			<h1><a href="home.php">Vector Palace</a></h1>
	<a href="home.php"><img src="img/logo_login.png" alt="Vector Palace" title="Clique para voltar para a página inicial" /></a>		
        </div><!-- Logo -->
    </div><!-- topo -->
    <div id="login">
    	<?php usuario::getFeedBack(); ?>
    	<form method="post" action="login.php">
    		<fieldset>
    			<label for="email">Usuário: </label>
    				<input type="text" name="email" id="inputEmail" value="email@dominio.com" rel="label" class="inputLabel" />
    				<label for="senha">Senha:</label>
    				<div id="senha">
    				<input type="text" name="senha" value="Senha" id="inputSenha" rel="label" class="inputLabel" />
    				</div>
    				<a href="javascript:esqueciMinhaSenha();">Esqueci minha senha</a>
    				<div id="lembrarSenha"><input type="checkbox" value="lembrarSenha" name="lembrarSenha"/ >Lembrar senha</div>
    			<input type="submit" name="btn" class="botao" value="Login" />
    		</fieldset>
    	</form>
    </div>
    
    </div>
    <div id="esqueciMinhaSenha" title="Recuperar Senha">
    	<form method="post" action="login.php">
    		<label for="cpf">CPF:</label>
			<input type="text" id="cpf" name="cpf" value="" onclick="javascript:$(this).val('');"/>
			<input type="submit" value="Recuperar">
		</form>
    </div>
    
    </body>
    </html>
