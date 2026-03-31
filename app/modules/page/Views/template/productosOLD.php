<div class="productos" align="center">
	<div class="container containerpro">
		<div class="row" id="mydiv">
			<?php foreach ($this->productosdestacados as $key => $producto){ ?>
					<div class="<?php if(count($this->productosdestacados)==1){ echo 'col-lg-12'; } else{ echo 'col-lg-3'; } ?> mt-3 product">
						<div class="caja-productoshome">
							<div class="caja-img">

								<?php if($producto->productos_imagen!="" and file_exists($_SERVER['DOCUMENT_ROOT']."/images/".$producto->productos_imagen)===true ){ ?>
									<a href="/page/productos/detalle?id=<?php echo $producto->productos_id; ?>"><img src="/images/<?php echo $producto->productos_imagen;?>"></a>
								<?php }else{ ?>
									<a href="/page/productos/detalle?id=<?php echo $producto->productos_id; ?>"><img src="/corte/product.png"></a>
								<?php } ?>
								<div class="div-imgoculto">
									<div class="div-imgoculto2">
										<div class="div-imgoculto3">
											<a class="btn btn-ver" href="/page/productos/detalle?id=<?php echo $producto->productos_id; ?>"> Ver Más</a>
										</div>
									</div>
								</div>
							</div>
							<div class="descrip-producto" >
								<div class="div_titulo">
									<h4><?php echo $producto->productos_nombre; ?></h4>
								</div>
								<div class="div_codigo">
									<h5>Ref: <?php echo $producto->productos_codigo; ?></h5>
								</div>
								<div class ="div_precio">
									<h4><i class="fas fa-tag"></i> $<?php echo number_format($producto->productos_precio) ; ?></h4>
								</div>
								<input type="hidden" id="nombre<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_nombre; ?>">
								<input type="hidden" id="imagen<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_imagen; ?>">
								<input type="hidden" id="descripcion<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_descripcion; ?>">
								<input type="hidden" id="precio<?php echo $producto->productos_id; ?>" value="<?php echo number_format($producto->productos_precio); ?>">
								<input type="hidden" id="id<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_id;; ?>">
								<div class="div_boton">
									<button type="button" class="precio btn-carrito addnom no_cel" data-toggle="modal" data-id="<?php echo $producto->productos_id; ?>" data-target="#exampleModal"><i class="fas fa-shopping-cart"></i> Comprar</button>

									<button class="precio btn-carrito btn-compra additemsolo solo_cel" data-dismiss="modal" aria-label="Close" data-id="<?php echo $producto->productos_id; ?>"><i class="fas fa-shopping-cart"></i> Agregar al Carrito</button>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="vendido d-none">
				<a href="/page/productos/destacados" class="btn-lomasvendido">Lo más vendido >></a>
				<a href="#"><span class="afiliados">Afiliados.</span><span>Haga click aquí para registrar un afiliado</span></a>
			</div>
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h4 id="nombremodal" class="modal-title"></h4>
						<button type="button" data-dismiss="modal" aria-label="Close" class="close" ><i class="far fa-times-circle"></i>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-lg-6" >
								<div class="div_descripcion" >
									<p id="descripcionmodal">

									</p>
								</div>
								<div class ="div_precio">
									<h4 id="preciomodal"></h4>
								</div>
								<button id="btnModal" class="precio btn-carrito btn-compra additemsolo " data-dismiss="modal" aria-label="Close" data-id=""><i class="fas fa-shopping-cart"></i> Agregar al Carrito</button>

								<button type="button" class="boton_cafe" data-dismiss="modal"><i class="fas fa-retweet"></i> Seguir comprando</button>
							</div>
							<div class="col-lg-6" >
								<div class="caja-productoshome">
									<div class="caja-img">
										<img id="imagenmodal" src="">
									</div>
									<div class="descrip-producto" >
										<div class="div_titulo">
											<h4 id="nombremodal2"></h4>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
