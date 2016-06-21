<?php include('core/includes/topo.php'); ?>
<?php include('core/classes/cidade.class.php'); ?>
<?php include('core/classes/estado.class.php'); ?>

<?php

/*BUSCA O USUARIO ATUAL*/
$usuario = usuario::getById($_SESSION['logado']);

$localDescricao = "temas/".$usuario->tema."/descricao.txt";

$descricao = 'Não há nenhuma descrição sobre esse tema';
if(file_exists($localDescricao))
{
	$fp = fopen($localDescricao, 'r');
	$descricao = utf8_encode(fread($fp, filesize($localDescricao)));
}

//ATUALIZA O TEMA
if(isset($_GET['tema']))
{
	$tema = $_GET['tema'];
	if(file_exists('temas/'.$tema))
	{
		$usuario->tema = $tema;
		$usuario->update();
		header("Location: meuCadastro.php");
	}
	else
		{
			echo 'tema invalido';
			echo $tema;
		}
}

/*ATUALIZA O PERFIL*/
if(isset($_POST['btn']))
{
	$usuario->nome = $_POST['nome'];
	$usuario->email = $_POST['email'];
	$usuario->telefone = $_POST['telefone'];
	$usuario->celular = $_POST['celular'];
	$usuario->cpf = $_POST['cpf'];
	$usuario->receberNoticias = $_POST['receberNoticias'];
	$usuario->update();
	
	if(isset($_POST['novaSenha']) && isset($_POST['repetirSenha']))
	{

		if($_POST['novaSenha'] == $_POST['repetirSenha'])
		{
			$usuario->senha = md5($_POST['novaSenha']);
			$usuario->update();
		}
		else{
			usuario::setFeedBack(false, "As senhas devem ser iguais", "As senhas devem ser iguais");
		}
	}

}

/*BUSCA TODAS OS ESTADOS*/
$estados = estado::getAll();

?>

<h2>Meu Cadastro</h2>
<div id="meuCadastro">
	<?php $usuario->getFeedBack(); ?>
	<form method="post" action="meuCadastro.php">
		<fieldset>
			<legend>Informações Cadastrais</legend>
			<p>
				<label for="nome">Nome:</label>
				<input type="text" name="nome" class="ui-corner-all" value="<?php echo $usuario->nome; ?>"/>
			</p>
			<p>
				<label for="email">Email:</label>
				<input type="text" name="email" class="ui-corner-all" value="<?php echo $usuario->email; ?>"/ ?>
			</p>
			<p>
				<label for="text">CPF:</label>
				<input type="text" name="cpf" id="cpf" class="ui-corner-all" value="<?php echo $usuario->cpf; ?>" />
			</p>
			<p>
				<label for="telefone">Telefone:</label>
				<input type="text" name="telefone" class="telefone ui-corner-all" value="<?php echo $usuario->telefone; ?>" />
			</p>
			<p>
				<label for="celular">Celular:</label>
				<input type="celular" name="celular" class="telefone ui-corner-all" value="<?php echo $usuario->celular; ?>" />
			</p>
			
			<p>
				<label id="labelReceberNoticias" for="receberNoticias">Deseja receber as notícias por email?</label>
				<div id="divReceberNoticias"></div>
				<input type="hidden" name="receberNoticias" value="1" id="receberNoticias"/>
				</p>
			
		</fieldset>
		
		<fieldset>
			<legend>Mudar minha senha</legend>
			<p>
				<label for="novaSenha">Nova Senha:</label>
				<input type="password" name="novaSenha" id="novaSenha" />
			</p>
			
			<p>
				<label for="repetirSenha">Repetir nova senha:</label>
				<input type="password" name="repetirSenha" id="repetirSenha" />
			</p>
		</fieldset>

			<div class="btnForm">
				<input type="reset" class="btnReset" value="Cancelar" />
				<input type="submit" class="btn" name="btn" value="Salvar" />
			</div>
	</form>
	
	
</div><!-- Meu Cadastro-->
<div id="temas">
<div id="temasDisponiveis">
	<h2>Outros Temas</h2>
	<?php
		$pastaTemas = 'temas/';
		$temas = scandir($pastaTemas);
		foreach($temas as $tema)
		{
			if($tema != '..' && $tema != '.' && $tema != $usuario->tema )
			{
				?>
					<div class="tema">
						<a href="meuCadastro.php?tema=<?php echo $tema; ?>"><img src="temas/<?php echo $tema; ?>/thumbnail_pb.jpg" alt="<?php echo $tema; ?>" title="<?php echo $tema; ?>" class="pb"/></a>
						<img src="temas/<?php echo $tema; ?>/thumbnail.jpg" alt="<?php echo $tema; ?>" title="<?php echo $tema; ?>" class="colorida" />
						<p></p>
					</div>
				<?php
			}
		}
	?>
</div>
</div>

<script type="text/javascript" src="js/mask.js"></script>
<script type="text/javascript" src="js/validate.js"></script>
<script type="text/javascript" src="js/util.validate.js"></script>
<script type="text/javascript">
	jQuery(function($){
				$("#cpf").mask("999.999.999-99");
				$(".telefone").mask("(99) 9999-9999");
	        });
	$(document).ready(function(){
    	 $('form').validate({
        // define regras para os campos
        	rules: {
            	nome: {
                	required: true,
            	},
            	email: {
                	required: true,
                	email: true
            	},
            	
                 "cpf" : {  
                        cpf: 'both' //utils.validate FTW!   
                    }, 

            	telefone: {
                	required: true
            	},
            	idEstado: {
                	required: true
            	},
            	idCidade: {
                	required: true
            	},
            	endereco: {
                	required: true
            	},
            	receberNoticias: {
                	required: true
            	}
	        },
	        messages: {
    	        nome: "Digite o seu nome",
    	        email: "Digite o seu email",
    	        telefone: "Digite um telefone",
    	        idEstado: "Escolha o Estado de Sua Residência",
    	        idCidade: "Escolha uma cidade",
    	        endereco: "Digite o seu endereço",
    	        receberNoticias: "Escolha se deseja ou não receber notícias",
        	}
    	});
	});

	$(".pb").hover(function(){
		$(this).animate({opacity:0}, 250);
	}
	,
	function(){
		$(this).animate({opacity:1}, 250);
	}
	);

	$("#idEstado").change(
		function(){
			idEstado = $(this).val();
			$.ajax({
			  method:'post',
			  url: 'core/funcoes/buscaCidades.php',
			  data: 'idEstado='+idEstado,
			  success: function(data){
			  	$("#idCidade").html(data);
			  }

});
		}
	);

$('#divReceberNoticias').iphoneSwitch("<?php echo ($usuario->receberNoticias) ? "on": "off";?>", 
     function() {
       $("#receberNoticias").val(1);
      },
      function() {
       $("#receberNoticias").val(0);
      },
      {
        switch_on_container_path: 'iphone_switch_container_off.png'
      });

</script>
<?php include('core/includes/footer.php'); ?>