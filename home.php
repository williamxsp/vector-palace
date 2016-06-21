<?php include('core/includes/topo.php'); ?>
<?php include('core/classes/noticia.class.php'); ?>
<?php include('core/classes/cobranca.class.php'); ?>
<?php include('core/classes/vocesabia.class.php'); ?>

<?php
$noticias = noticia::getAll(0, 5, 1);
$cobrancas = cobranca::getByUser($usuario->id, false, 5);
$vocesabia = vocesabia::getRandom();
?>
<div id="noticias">
			<h2 class="indent">Notícias Recentes</h2>	
            <a href="noticias.php"><img src="temas/<?php echo $usuario->tema; ?>/noticiasRecentes.jpg" alt="Notícias Recentes" title="Clique para ver todas as notícias" /></a>	
        	<?php
        	if(count($noticias) <1)
			{
				echo "<p>Não há nenhuma notícia cadastrada</p>";
			}
        	foreach ($noticias as $noticia ) {
				?>
					
				<div class="noticia" onclick="javascript:window.location.href='noticias.php?id=<?php echo $noticia->id; ?>'; ">
					<div class="informacoes">
	                	Em: <?php echo noticia::dataToUser($noticia->data); ?> Por: <?php echo $noticia->nomeUsuario; ?>
	                </div><!-- .informacoes -->
	                <div class="titulo">
	                	<?php echo $noticia->titulo; ?>
	                </div><!-- .titulo -->
				</div><!-- .noticia -->
					
				<?php
			}
        	?>
        	
		</div><!-- #noticias -->
        
        <div id="financeiro">
			<a href="financeiro.php"><img src="temas/<?php echo $usuario->tema; ?>/situacaoFinanceira.jpg" alt="Situação Financeira" title="Clique para ver o seu histórico Financeiro" /></a>	
          	<h2>Taxas Pendentes</h2>
            <?php
	if(count($cobrancas) > 0)
	{
		?>
		<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>Descrição</th>
					<th>Vencimento</th>
					<th>Valor</th>
					
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($cobrancas as $cobranca)
					{
						$class = '';
						
						if($cobranca->status > 3)
										{
											$class = 'emDia';
										}
										elseif($cobranca->status > 0)
										{
											$class = 'alerta';
										}
										else
											{
												$class = 'atrasado';
											}
						?>
							<tr onclick="javascript:document.location.href='financeiro.php';" class='<?php echo $class; ?>'>
								<td><?php echo $cobranca->descricao;?></td>
								<td><?php echo cobranca::dataToUser($cobranca->vencimento);?></td>
								<td><?php echo $cobranca->valor;?></td>
								
								
							</tr>
						<?php
					}
				?>
			</tbody>
		</table>
		<?php
	}
	else
		{
			?>
			<div class='ui-widget'>
									<div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0.7em;'> 
										<p><span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
										Não há nenhuma cobrança pendente.
										</p>
									</div>
								</div>
			<?php
		}
 ?>
            <a href="financeiro.php" class="linkFaturas">Faturas Anteriores</a>
        </div><!-- #fincaneiro -->
        <div id="tempo">
        	<h2>Tempo</h2>
            <div id="widget">
                <iframe src='http://selos.climatempo.com.br/selos/MostraSelo.php?CODCIDADE=558,107,84,321&SKIN=padrao' scrolling='no' frameborder='0' width='180' height='90' marginheight='0' marginwidth='0'></iframe>
            </div>
            <div id="voceSabia">
            	<h3>Você Sabia?</h3>
                <p>
					<?php echo utf8_encode($vocesabia->descricao);?>
                </p>
            </div>
        </div>
        
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/tablesorter.js"></script>
<script type="text/javascript">
$(document).ready(
	function(){
		
		$("#tabelaFinanceiro").tablesorter();
		
	});
</script>
<?php include('core/includes/footer.php'); ?>