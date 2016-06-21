<?php session_start(); ?>
<?php require_once('core/classes/usuario.class.php')?>
<?php 

	if(isset($_POST['btn']))
	{
		usuario::login($_POST['email'], $_POST['senha']);		
	}
	
	$email = '';
	$cod = '';
	
	if(isset($_GET['email']))
	{
		$email = $_GET['email'];
	}
	
	if(isset($_GET['email']))
	{
		$cod= $_GET['cod'];
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
	<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
	<script type="text/javascript" src="js/mask.js"></script>
	<script type="text/javascript" src="js/validate.js"></script>
	<script type="text/javascript" src="js/util.validate.js"></script>
	<script type="text/javascript">
	
    	$(document).ready(function(){
    		$("input[type='submit']").button();
    		jQuery(function($){
    			
				$("#cpf").mask("999.999.999-99");
	        });
    		
	        $('form').validate({
        // define regras para os campos
        	rules: {
                 "cpf" : {  
                        cpf: 'both' //utils.validate FTW!   
                    }
           },
	        messages: {
    	        cpf: "CPF inválido",
        	}
    	});
	        
	        
    		$("#frmDesbloquear").submit(function(){
    			var email = $("#email").val();
    			var cod = $("#cod").val();
    			var cpf = $("#cpf").val();
    			
    			$.ajax({
    				type:"post",
    				data:"email="+email+"&cod="+cod+"&cpf="+cpf,
    				url:"core/funcoes/desbloquearConta.php",
    				success:function(result)
    				{
    					var mensagem = $("<p title='Desbloquear conta'>"+result+"</p>");
    					mensagem.dialog({
    						close:function(){
    							window.location.reload();
    							}});
    				}
    				
    			});
    			return false; 
    		});
    		return false;
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
    </div>
    <div id="desbloquear" title="Recuperar Senha">
    	<form method="post" action="desbloquear.php" id="frmDesbloquear">
    		<fieldset>
    			<legend>Digite seu cpf no campo abaixo para desbloquear a sua conta:</legend>
	    		<input type="hidden" id="email" value="<?php echo $email; ?>" name="email" />
	    		<input type="hidden" id="cod" value="<?php echo $cod; ?>" name="cod" />
	    		<label for="cpf">CPF:</label>
				<input type="text" id="cpf" name="cpf" value="" onclick="javascript:$(this).val('');"/>
				<input type="submit" value="Desbloquear">
			</fieldset>
		</form>
    </div>
    
    </body>
    </html>
