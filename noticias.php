<?php include('core/includes/topo.php'); ?>
<?php include('core/classes/noticia.class.php'); ?>

<?php
$pagina = 0;
$quantidade = 10;
$inicio = 0;

$noticias = noticia::getAll($inicio, $quantidade, 1); //somente aprovados
$totalNoticias = noticia::getTotal();
$totalPaginas = ceil($totalNoticias/$quantidade);
?>

<h2>Notícias</h2>


<?php noticia::getFeedBack(); ?>
<div id="pgNoticias">
	<div id="todasNoticias">
		<?php
		foreach ($noticias as $noticia ) {
				?>
					
				<div class="noticia"">
					<div class="informacoes">
	                	Em: <?php echo noticia::dataToUser($noticia->data); ?> Por: <?php echo $noticia->nomeUsuario; ?>
	                </div><!-- .informacoes -->
	                <div class="titulo">
	                	<a href="noticias.php?id=<?php echo $noticia->id; ?>"><?php echo $noticia->titulo; ?></a>
	                </div><!-- .titulo -->
	                <div class="conteudo">
	                	<?php echo $noticia->conteudo; ?>
	                </div>
				</div><!-- .noticia -->
					
				<?php
			}
        	?>
        	</div>
	<div id="painelNoticias">
		<input type="button" value="Adicionar Nova Notícia" class="btnSidebar" id="adicionarNoticia"/>
	</div><!-- painelNoticias-->
</div><!-- pgNoticias-->
<div style="visibility:hidden;">
<div id="frmAdicionarNoticia" title="Adicionar Notícia">
	<input type="text" name="titulo" class="ui-corner-all login" id="txtTitulo" value="Titulo" title="Titulo">
	<input type="hidden" value="0" id="idNoticia" />
	<textarea id="txtConteudo" rows="10" cols="500" title="Digite o texto da Notícia aqui" class="login"></textarea>
	<div id="status"></div>
	<input type="button" value="Cadastrar Notícia" id="btnAdicionarNoticia"/>
</div><!-- frmAdicionarNoticia-->
</div>
<script type="text/javascript" src="js/nicEdit.js"></script>
<script type="text/javascript">

	var nc;
	$(document).ready(function(){
		$("input[type='button']").button();
		nc = new nicEditor({fullPanel:true, uploadURI:"core/funcoes/uploadImagem.php", iconsPath:"js/nicEditorIcons.gif"}).panelInstance("txtConteudo");
	});
	

	$(document).ready(function(){
		$("#frmAdicionarNoticia").dialog({
				autoOpen: false,
				modal:true, 
				width:870, 
				height:600, 
				show:"slow", 
				hide:"slow",
				close:function()
					{
						window.location.reload();
					}
				});
		
		$("#adicionarNoticia").click(function()
		{
			$("#frmAdicionarNoticia").dialog('open');
		});
		
		$("#btnAdicionarNoticia").click(function()
		{
			conteudo = nicEditors.findEditor('txtConteudo').getContent();
			titulo = $("#txtTitulo").val();
			id = $("#idNoticia").val();
			
			var status = ''; //armazena o status que a página salvarNoticia.php retorna
			
			
						
			$.ajax({
				type:"post",
				url:"core/funcoes/salvarNoticia.php",
				data:"id="+id+"&titulo="+titulo+"&conteudo="+conteudo,
				beforeSend:function()
				{
					$("#status").html("<img src='img/icones/carregando.png' />Salvando...");
				},
				error:function()
				{
					$("#status").html("<img src='img/icones/erro.png' />Não foi possível salvar a sua notícia!");
				},
				success:function(result)
				{
					result = Number($.trim(result));
					if(result > 0)
					{
						$("#idNoticia").val(result);
						$("#status").html("<img src='img/icones/ok.png' />Salvo!");
						$("#btnAdicionarNoticia").val("Atualizar");
					}
					else
					{
						alert("Erro id:"+result);
						$("#status").html("<img src='img/icones/erro.png' />Não foi possível salvar a notícia");
					}
				}
			});
			
			
		});
		
	});
	
</script>
<?php include('core/includes/footer.php'); ?>