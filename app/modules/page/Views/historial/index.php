<div class="titulo-proyecto">
	<h2 class="titulo-principal contact">Mi historial de pedidos</h2>
</div>




<?php if(count($this->pedidos)>0){ ?>

<div class="container">
	<div align="center">
		<table width="100%" border="1" style="font-size: 14px;" cellpadding="2">
				<thead class="cabecera_tabla">
					<tr>
						<td>Número</td>
						<td>Documento</td>
						<td>Nombre</td>
						<td>Correo</td>
						<td>Metodo de pago</td>
						<td>Forma de envio</td>
						<td>Fecha</td>
						<td>Valor total</td>
						<td>Estado</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					<?php foreach($this->pedidos as $content){ ?>
					<?php $this->content = $content; ?>
					<?php $id =  $content->pedido_id; ?>
						<tr>
							<td><?=$id;?></td>
							<td><?=$content->pedido_documento;?></td>
							<td><?=$content->pedido_nombre;?></td>
							<td><?=$content->pedido_correo;?></td>
							<td><?= $this->list_pedido_medio[$content->pedido_medio];?>
							<td><?= $this->list_pedido_forma_envio[$content->pedido_forma_envio];?>
							<td><?=$content->pedido_fecha;?></td>
							<td><?=number_format($content->pedido_valorpagar);?></td>
							<td> <span><?= $this->list_pedido_estado[$content->pedido_estado];?></span>
							<td class="text-right">
								<!-- Button trigger modal -->
								<button type="button" class="btn btn-primary btn-sm boton_azul" data-toggle="modal" data-target="#exampleModal<?php echo $id ?>">
								  Detalle
								</button>

								<!-- Modal -->
								<div class="modal fade" id="exampleModal<?php echo $id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModal<?php echo $id ?>Label" aria-hidden="true">
								  <div class="modal-dialog" role="document">
								    <div class="modal-content">
								      <div class="modal-header">
								        <h5 class="modal-title" id="exampleModalLabel">Pedido #<?= $id ?></h5>
								        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								          <span aria-hidden="true">&times;</span>
								        </button>
								      </div>
								      <div class="modal-body">
							        	<table width="100%" cellpadding="5" border="1">
							        		<tr class="cabecera_tabla">
							        			<th>Producto</th>
							        			<th><div align="center">Cantidad</div></th>
							        			<th><div align="right">Valor unitario</div></th>
							        			<th><div align="right">Valor total</div></th>
							        		</tr>
							        		<?php foreach ($content->productos as $producto): ?>
								        		<tr>
								        			<td><?php echo $producto->nombre; ?></td>
								        			<td align="center"><?php echo $producto->cantidad; ?></td>
								        			<td align="right">$<?php echo number_format($producto->valor); ?></td>
								        			<td align="right">$<?php echo number_format($producto->valor*$producto->cantidad); ?></td>
								        		</tr>
							        		<?php endforeach ?>
												<tr>
													<td colspan="3"><b>Costo envío</b></td>
													<td align="right">$<?php echo number_format($this->content->pedido_envio*1); ?></td>
												</tr>
												<tr>
													<td colspan="3"><b>Propina</b></td>
													<td align="right">$<?php echo number_format($this->content->pedido_propina*1); ?></td>
												</tr>						
												<tr>
													<td colspan="3"><b>Total</b></td>
													<td align="right">$<?php echo number_format($this->content->pedido_valorpagar); ?></td>
												</tr>
							        	</table>
								      </div>
								      <div class="modal-footer">
								        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
								      </div>
								    </div>
								  </div>
								</div>
							</td>
						</tr>
					<?php } ?>
				</tbody>
		</table>
	</div>
</div>

<?php }else{ ?>
	<div align="center" class="mt-5">No tiene pedidos</div>
<?php } ?>
