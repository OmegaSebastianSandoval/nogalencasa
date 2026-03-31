<div class="banner"><?php echo $this->bannerprincipal; ?></div>
<div class="container pestanas-cont">
    <div class="row pestanas">
        <div class="col-lg-6 align-self-center filtro">
            <div class="row">
                <div class="col-sm-6 filtrar">
                    <i class="fas fa-filter"></i> Filtrar por Categoría 
                </div>
                <div class="col-sm-6 text-right boton-filtro">
                    <div class="btn-group">
                        <button type="button" class="btn btn-productos dropdown-toggle" style="backgrund-color:#fe0c05;" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                            Todos los Productos
                        </button>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-left">
                        <?php foreach ($this->categorias as $key => $categoria ) { ?>
                            <div>
                                <a href="?categoria=<?php echo $categoria->categorias_id; ?>"><?php echo $categoria->categorias_nombre; ?></a>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
        <div class="col-lg-3 text-center ciudad">
            Ciudad de Envío: Bogotá
        </div>
        <div class="col-lg-2 buscar">
            <div class="row">
                <div class="col-sm-6 buscar-text">
                    <span>Buscar</span>
                </div>
                <div class="col-sm-6 text-right buscar-ico">
                    <i class="fas fa-search" align="right"></i>
                </div>
            </div> 
        </div>
	</div>
</div>
<div class="productos" align="center">
	<div class="containerpro">
		<div class="row justify-content-center">
			<?php foreach ($this->productos as $key => $producto){ ?>
					<div class="col-sm-3 mt-5 product">
						<div class="caja-productoshome">
							<div class="caja-img">
								<a href="/page/productos/detalle?id=<?php echo $producto->productos_id; ?>"><img src="/images/<?php echo $producto->productos_imagen;?>"></a>
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
									<h5><?php echo $producto->productos_codigo; ?></h5>
								</div>
								<div class ="div_precio">
									<h4>$<?php echo number_format($producto->productos_precio) ; ?></h4>
								</div>	
								<input type="hidden" id="nombre<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_nombre; ?>">
								<input type="hidden" id="imagen<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_imagen; ?>">
								<input type="hidden" id="descripcion<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_descripcion; ?>">
								<input type="hidden" id="precio<?php echo $producto->productos_id; ?>" value="<?php echo number_format($producto->productos_precio); ?>">
								<input type="hidden" id="id<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_id;; ?>">
								<div class="div_boton">
									<button type="button" class="precio btn-carrito addnom" data-toggle="modal" data-id="<?php echo $producto->productos_id; ?>" data-target="#exampleModal">Comprar</button>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
			<div align="center">
				<ul class="pagination justify-content-center">
					<?php
							$url = 'productos';
							if ($this->totalpages > 1) {
								if ($this->page != 1)
									echo '<li><a href="'.$url.'?page='.($this->page-1).'"> &laquo; Anterior </a></li>';
								for ($i=1;$i<=$this->totalpages;$i++) {
									if ($this->page == $i)
										echo '<li class="page-item active"><a class="paginaactual">'.$this->page.'</a></li>';
									else
										echo '<li><a href="'.$url.'?page='.$i.'">'.$i.'</a></li>  ';
								}
								if ($this->page != $this->totalpages)
									echo '<li><a href="'.$url.'?page='.($this->page+1).'">Siguiente &raquo;</a></li>';
							}
					?>
				</ul>
			</div>
			<div class="vendido">
				<a href="/page/productos/destacados" class="btn-lomasvendido">Lo más vendido >></a>
				<a href="#"><span class="afiliados">Afiliados.</span><span>Haga click aquí para registrar un afiliado</span></a>
			</div>
			<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h4 id="nombremodal" class="modal-title"></h4>
						<button type="button" data-dismiss="modal" aria-label="Close" class="close" >
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-7" >
								<div class="div_descripcion" >
									<p id="descripcionmodal">

									</p>
								</div>
								<button id="btnModal" class="precio btn-carrito btn-compra additemsolo " data-dismiss="modal" aria-label="Close" data-id="">Comprar</button>
							</div>
							<div class="col-sm-5" >
								<div class="caja-productoshome">
									<div class="caja-img">
										<img id="imagenmodal" src="">
									</div>
									<div class="descrip-producto" >
										<div class="div_titulo">
											<h4 id="nombremodal2"></h4>
										</div>
										<div class ="div_precio">
											<h4 id="preciomodal"></h4>
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