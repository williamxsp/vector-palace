<?php 
	include("core/includes/topo.php"); 
	include("core/funcoes/checaAdmin.php");
	include("core/classes/noticia.class.php");
?>

<?php
$noticias = array();
$tipo = 2;
if(isset($_GET['tipo']))
{
	if((int)$_GET['tipo'] == 1)
	{
		$tipo = 1;
		$noticias = noticia::getAll(0,500,1);
	}
	elseif((int)$_GET['tipo'] == 0)
	{
		$tipo = 0;
		$noticias = noticia::getAll(0,500,0);
	}
	else
		{
			$noticias = noticia::getAll(0,500);
		}
	
}
else
	{
		$noticias = noticia::getAll(0,500);
	}
	


$todos = noticia::getTotal();
$aprovados = noticia::getTotalAprovados();
$aguardandoAprovacao = noticia::getAguardandoAprovacao();

function echoTipoNoticia($id, $texto, $tipo)
{
	if($id == $tipo)
	return "<strong>".$texto."</strong>";
	return 	$texto;
}

?>
<h2>Gerenciar Notícias</h2>
	<div id="filtro">
		<a href="gerenciarNoticias.php"> <?php echo echoTipoNoticia(2, "Todos ($todos)", $tipo); ?></a>
		<a href="gerenciarNoticias.php?tipo=1"><?php echo echoTipoNoticia(1, "Publicados ($aprovados)", $tipo); ?></a>
		<a href="gerenciarNoticias.php?tipo=0"><?php echo echoTipoNoticia(0, "Aguardando Aprovação($aguardandoAprovacao)", $tipo); ?></a>
	</div>
<?php noticia::getFeedBack(); ?>
<?php
	
	$total = count($noticias);
	if($total > 0)
	{
		?>
					
			<table>
				<thead>
					<tr>
						<th>Título</th>
						<th>Autor</th>
						<th>Data</th>
						<th>Editar</th>
						<th>Remover</th>
						<th>Mudar Status</th>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach($noticias as $noticia)
				{
					?>
						<tr>
							<td><?php echo $noticia->titulo?></td>
							<td><?php echo $noticia->nomeUsuario?></td>
							<td><?php echo noticia::dataToUser($noticia->data); ?></td>
							<td onclick="javascript:editar('<?php echo $noticia->titulo?>', <?php echo $noticia->id?>);"><img src="img/icones/editar.png" title="Editar <?php echo $noticia->titulo; ?>" /> Editar</td>
							<td id="excluir<?php echo $noticia->id?>" onclick="javascript:excluir('<?php echo $noticia->titulo?>', <?php echo $noticia->id?>);"><img src="img/icones/deletar.png" title="Excluir <?php echo $noticia->titulo; ?>" /> Deletar</td>
							<?php
							if($noticia->aprovado == 1)
							{
								?>
									<td id="desaprovar<?php echo $noticia->id?>"onclick="javascript:desaprovar('<?php echo $noticia->titulo?>', <?php echo $noticia->id?>);"><img src="img/icones/desaprovar.png" title="Desaprovar <?php echo $noticia->titulo; ?>" /> Desaprovar</td>
								<?php
							} 
							else
								{
									?>
										<td id="aprovar<?php echo $noticia->id?>"onclick="javascript:aprovar('<?php echo $noticia->titulo?>', <?php echo $noticia->id?>);"><img src="img/icones/aprovar.png" title="Aprovar <?php echo $noticia->titulo; ?>" /> Aprovar</td>
									<?php
								}
							 ?>
							
						</tr>
					<?php
				}
				?>
				</tbody>
			</table>
			<div id="pager" class="pager">
	<form>
		<img src="img/icones/first.png" class="first"/>
		<img src="img/icones/prev.png" class="prev"/>
		<input type="text" class="pagedisplay"/>
		<img src="img/icones/next.png" class="next"/>
		<img src="img/icones/last.png" class="last"/>
		<div id="exibir" style="display:none;">
		 Exibir: 
		<select class="pagesize">
			<option selected="selected"  value="10">10</option>
			<option value="20">20</option>
			<option value="30">30</option>
			<option  value="40">40</option>
		</select>
		
		</div>
	</form>
</div><!-- pager-->
<div id="frmAdicionarNoticia" title="Adicionar Notícia">
	<input type="text" name="titulo" class="ui-corner-all login" id="txtTitulo" value="" title="">
	<input type="hidden" value="0" id="idNoticia" />
	<textarea id="txtConteudo" rows="10" cols="500" title="" class="login"></textarea>
	<div id="status"></div>
	<input type="button" value="Atualizar Notícia" id="btnAdicionarNoticia"/>
</div><!-- frmAdicionarNoticia-->
		<?php
	}
	else
		{
			?>
				<p>Nenhuma notícia</p>
			<?php
		}
?>
<script type="text/javascript" src="js/pager.js"></script>
<script type="text/javascript" src="js/tablesorter.js"></script>
<script type="text/javascript" src="js/nicEdit.js"></script>

<script type="text/javascript">
	var nc;
	$(document).ready(function(){
		$("input[type='button']").button();
		
		nc = new nicEditor({fullPanel:true, uploadURI:"core/funcoes/uploadImagem.php", iconsPath:"js/nicEditorIcons.gif"}).panelInstance("txtConteudo");
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
		$("table").tablesorter({widgets:['zebra']}).tablesorterPager({container: $("#pager")});;
	});
	
	function excluir(titulo, id)
	{
		
		var p = $("<div title='Excluir'>Tem certeza que deseja excluir "+titulo+"</div>");

		p.dialog({
			modal:true,
			resizable:false,
			buttons:{
						"Sim":function()
						{
							$.ajax({
								type:"post",
								url:"core/funcoes/noticias/deletar.php",
								data:"id="+id,
								success:function(result)
								{
									p.dialog("close");
									$("#excluir"+id).parent().animate({"opacity":"hide"}, 1000, function(){
											document.location.reload();
									});
								}
							});
						}
						,
						"Não":function(){$(this).dialog("close");}
					}
			});
		/*
		if(confirm("Tem certeza que deseja excluir "+titulo+"?"))
		{
			$.ajax({
				type:"post",
				url:"core/funcoes/noticias/deletar.php",
				data:"id="+id,
				success:function()
				{
					window.location.reload();
				}
			});
		}
		
*/
	}
	
	function aprovar(titulo, id)
	{
		$.ajax({
				type:"post",
				url:"core/funcoes/noticias/aprovar.php",
				data:"id="+id,
				success:function()
				{
					window.location.reload();
				}
			})
	}
	
	function desaprovar(titulo, id)
	{
		$.ajax({
				type:"post",
				url:"core/funcoes/noticias/desaprovar.php",
				data:"id="+id,
				success:function()
				{
					window.location.reload();
				}
			})
	}
	
	function editar(titulo, id)
	{
		$("#txtTitulo").val(titulo);
		$("#idNoticia").val(id);
		$.ajax({
			type:"post",
			url:"core/funcoes/noticias/getContent.php",
			data:"id="+id,
			success:function(result)
			{
				nicEditors.findEditor("txtConteudo").setContent(result);
				$("#frmAdicionarNoticia").dialog("open");
			}
		})
		
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
	}
</script>
<?php include("core/includes/footer.php"); ?>