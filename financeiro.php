<?php include('core/includes/topo.php'); ?>
<?php include('core/classes/cobranca.class.php'); ?>
<?php include('core/classes/banco.class.php'); ?>
<?php
$cobrancas = cobranca::getByUser($usuario->id, 2);
$cobrancasPagas = cobranca::getByUser($usuario->id, 1);
$bancoAtual = banco::getById($usuario->idBanco);
$bancos = banco::getAll();
?>
<h2>Financeiro</h2>
<?php cobranca::getFeedBack(); ?>
<form method="post" action="financeiro.php">
	<fieldset>
		<label>Banco:</label>
		<select name="idBanco" id="idBanco">
			<option value="<?php echo $bancoAtual->id; ?>"><?php echo $bancoAtual->descricao; ?> </option>
			<?php
				foreach($bancos as $banco)
				{
					if($banco->id != $bancoAtual->id)
					{
					?>
						<option value="<?php echo $banco->id; ?>"><?php echo $banco->descricao; ?> </option>
					<?php
					}					
				}
			?>
		</select>
	</fieldset>
</form>

<div id="pgFinanceiro">
<?php
	if(count($cobrancas) > 0)
	{
		?>
		<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>Descrição</th>
					<th>Data de Emissão</th>
					<th>Vencimento</th>
					<th>Valor</th>
					<th>Status</th>
					<th>Pagar</th>
					
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($cobrancas as $cobranca)
					{
						$class = '';
						$status = '';
						
						if($cobranca->status > 3)
										{
											$class = 'emDia';
											$status = "<img src='img/icones/ok.png' title='Você está em dia' />";
										}
										elseif($cobranca->status > 0)
										{
											$class = 'alerta';
											$status = "<img src='img/icones/alerta.png' title='Você tem mais $cobranca->status dias para pagar' />";
										}
										else
											{
												$class = 'atrasado';
												$status = "<img src='img/icones/erro.png' title='Você está atrasado' />";
											}
						?>
							<tr class='<?php echo $class; ?>'>
								<td><?php echo $cobranca->descricao;?></td>
								<td><?php echo cobranca::dataToUser($cobranca->dataEmissao);?></td>
								<td><?php echo cobranca::dataToUser($cobranca->vencimento);?></td>
								<td><?php echo $cobranca->valor;?></td>
								<td>
									<?php 
										echo $status;
									?>
									</td>
								<td onclick="javascript:gerarBoleto(<?php echo $usuario->id; ?>,<?php echo $cobranca->id; ?>)">Pagar</td>
								
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
 <br /><br />
  <h3>Taxas Pagas</h3>
  <?php
 if(count($cobrancasPagas) > 0)
	{
		?>
		<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>Descrição</th>
					<th>Data de Emissão</th>
					<th>Vencimento</th>
					<th>Data de Pagamento</th>
					<th>Valor</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($cobrancasPagas as $cobranca)
					{
						?>
							<tr class='emDia'>
								<td><?php echo $cobranca->descricao;?></td>
								<td><?php echo cobranca::dataToUser($cobranca->dataEmissao);?></td>
								<td><?php echo cobranca::dataToUser($cobranca->vencimento);?></td>
								<td><?php echo cobranca::dataToUser($cobranca->dataPagamento);?></td>
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
</div><!-- financeiro-->

<script type="text/javascript">
	function gerarBoleto(idUsuario, idCobranca)
	{
		 var centerWidth = (window.screen.width - 700) / 2;
    	var centerHeight = (window.screen.height - 700) / 2;
		    window.open('boleto.php?id='+idUsuario+'&c='+idCobranca,
		    'Boleto',
		    'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=no,width700,height=700, left='
		    +centerWidth+', top='+centerHeight);  
	}
	
	$(document).ready(function(){
		$("#idBanco").change(function(){atualizaBanco($(this).val());});
	});
	
	function atualizaBanco(banco)
	{
		$.ajax({
			url:"core/funcoes/atualizaBanco.php",
			data:"idBanco="+banco,
			type:"post",
			success:function(result){
				window.location.reload();
				}
		});
	}
</script>
<?php include('core/includes/footer.php'); ?>