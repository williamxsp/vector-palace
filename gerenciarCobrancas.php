<?php
	include("core/includes/topo.php"); 
	include("core/funcoes/checaAdmin.php");
	include("core/classes/cobranca.class.php");
	
	$usuarios = usuario::getAll(true, true);
	
	$tipo = 0;
	
	if(isset($_GET['tipo']))
	{
		if((int)$_GET['tipo']  == 1)
		{
			$tipo = 1;
		}
	}
	
	$usuariosDevedores = cobranca::getUsuariosDevedores();
?>
<h2>Gerenciar Cobranças</h2>
<?php usuario::getFeedBack(); ?>
<div id="gerenciarCobrancas">
	<br />
	Ordernar por <a href="#">Usuário </a>| <a href="#">Cobrança</a>
	<input type="button" value="Adicionar Cobranca" id="btnAdicionarCobranca" style="float:right;"/>
	<div class="ajuste"></div>
	
	<!-- LISTA DE COBRANÇAS OU USUÁRIOS-->
	<table>
		<thead>
			<tr>
				<th>Nome</th>
				<th>Email</th>
				<th>Telefone</th>
				<th>Cobranças</th>
				<th>Editar</th>
				<th>Pagar</th>				
			</tr>
		</thead>
		<tbody>
			<?php
				foreach($usuariosDevedores as $usuarioDevedor)
				{
					$cobrancas = cobranca::getByUser($usuarioDevedor->id, 0);
					?>
						
						<tr>
							<td><?php echo $usuarioDevedor->nome; ?></td>
							<td><?php echo $usuarioDevedor->email; ?></td>
							<td><?php echo $usuarioDevedor->telefone; ?></td>
							<td>
							<?php
								foreach ($cobrancas as $key => $cobranca) {
									echo $cobranca->descricao."<br />";
								}
							?>
							</td>
							<td>Editar</td>
							<td>Apagar</td>
						</tr>
						
					<?php
				}
			?>
		</tbody>
	</table>
	
	
	
	
	
	
	
	<!-- FORMS PARA ADICIONAR COBRANÇA E ESCOLHER CONDOMINOS-->
	<div id="adicionarCobranca" title="Adicionar Cobranca">
<form method="post" action="gerenciarCobrancas.php" id="frmCadastrarCobranca">
	<fieldset>
		<legend>Adicionar Cobrança</legend>
		<p>
			<label for="descricao">Descrição:</label>
			<textarea id="descricao" name="descricao" class="ui-corner-all"></textarea>
		</p>
		<p>
			<label for="valor">Valor:</label>
			<input type="text" name="valor" class="ui-corner-all" id="valor"/>
		</p>
		<p>
			<label for="vencimento">Vencimento:</label>
			<input type="text" name="vencimento" id="vencimento" class="ui-corner-all"/>
		</p>
		<input type="button" value="Escolher Condôminos" id="adicionarCondominos" />
	</fieldset>
	
	<input type="submit" value="Cadastrar" class="btn"/>
	<input type="button" value="Cancelar" class="btn" id="btnCancelarPrincipal"/>
		
</form>
<div id="condominos" title="Escolher Condôminos">
	<?php
		foreach($usuarios as $usuario)
		{
			?>
				<div class="condomino selected" id="<?php echo $usuario->id; ?>">
					<div class="imgCondomino">
						<img src="img/condomino/<?php echo $usuario->id; ?>.jpg" alt="nome">
					</div>
					<div id="infoUsuario">
						<h3><?php echo $usuario->nome; ?></h3>
							<span class="condCondomino"><?php echo $usuario->descricaoCondominio; ?></span>
					</div>
					<div class="ajuste"></div>
				</div>
			<?php
		}
	?>
	<div id="options">
						<form method="post" action="gerenciarCobrancas.php" onsubmit="return false;">
							<input type="submit" value="Continuar" id="btnContinuar" class="btn"/>
							<input type="reset" value="Cancelar" id="btnCancelar" class="btn"/>
							
						</form>
					</div><!-- options-->
	<div class="ajuste"></div>
</div>
</div><!-- adicionarCobranca-->
</div><!-- gerenciarCobrancas -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/maskMoney.js"></script>
<script type="text/javascript">
	var escolheuCondominos = true;
	
	
	$(document).ready(function()
	{
		$.datepicker.setDefaults({dateFormat: 'dd/mm/yy',
	                          dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
	                          dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
	                          dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
	                          monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro', 'Outubro','Novembro','Dezembro'],
	                          monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set', 'Out','Nov','Dez'],
	                          nextText: 'Próximo',
	                          prevText: 'Anterior'
	                         });
		$("#condominos").dialog({autoOpen:false, width:670, modal:true});
		$("#adicionarCobranca").dialog({autoOpen:false, width:670, modal:true});
		$("#vencimento").datepicker({minDate:"1+DMY"});
		$("#valor").maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:".", simbolStay:true});
		$(".condomino").click(function(){		
			if($(this).hasClass("selected"))
			{
				$(this).removeClass("selected");
				
			}
			else
			{
				$(this).addClass("selected");
			}
		});
		
		$("#adicionarCondominos").click(function(){
			$("#condominos").dialog("open");
		});
		
		$("#btnAdicionarCobranca").click(function(){
			$("#adicionarCobranca").dialog("open");
		});
		
		$("#btnCancelar").click(function(){
			$("#condominos").dialog("close");
		});
		
		$("#btnCancelarPrincipal").click(function(){
			$("#adicionarCobranca").dialog("close");
		});
		
		$("#btnContinuar").click(function(){
			if($(".selected").length > 0 )
			{
				escolheuCondominos = true;
			}
			else
			{
				escolheuCondominos = false;
			}
			$("#condominos").dialog("close");
		});

		
		$("#frmCadastrarCobranca").submit(function()
		{
			if(escolheuCondominos)
			{
				var condominos = [];
				var descricao = $("#descricao").val();
				var valor = $("#valor").val();
				var vencimento = $("#vencimento").val();
				
				$(".selected").each(function()
				{
					condominos.push($(this).attr("id"));
				});
				console.log(condominos);
				
				$.ajax({
					type:"post",
					url:"core/funcoes/cobrancas/cadastrar.php",
					data:"c="+condominos+"&descricao="+descricao+"&valor="+valor+"&vencimento="+vencimento,
					success:function(result)
					{
						window.location.reload();
					}
				});
			}
			else
			{
				$("#condominos").dialog({title:"Selecione ao menos um condômino para continuar"});
				$("#condominos").dialog("open");
			}
			return false;
		});
		
	});
</script>
<?php include("core/includes/footer.php"); ?>