
        <div class="ajuste"></div><!--Descer o fundo, float sucks -->
    </div><!-- #conteudo -->

	<div id="conteudo_base"></div>         
    <div id="footer">
        	<div id="info">
            	Vector Palace - <strong><?php echo date("Y"); ?></strong> Desenvolvido por: Lets Do <strong>IT</strong>
            </div>
            <div id="creditos">
            	<a href="logout.php" title="Clique para sair">Sair</a>
            </div>
        </div><!--footer -->
  </div><!-- geral -->
<script type="text/javascript">
	$(document).ready(function(){
			$(".ui-state-highlight").delay(6000).animate({
				"height":"0",
				"opacity":"hide"
			}
			,1000
			);
	});

</script>
</body>
</html>