<script>
	// JavaScript (puedes incluir este script en tu HTML o en un archivo externo)
	document.addEventListener('DOMContentLoaded', function() {
		var etiquetaContents = document.querySelectorAll('.productos .etiqueta-content');

		etiquetaContents.forEach(function(element, index) {
			if (index % 3 === 0) {
				element.classList.add('color-naranja');
			} else if (index % 3 === 1) {
				element.classList.add('color-verde');
			} else {
				element.classList.add('color-azul');
			}
		});
	});
</script>
<div class="productos" align="center">
	<div class="container containerpro">
		<div class="row col-12 col-lg-11" id="mydiv">
			<?php foreach ($this->productosdestacados as $key => $producto) {
				// print_r($producto);
			?>
				<div class="<?php if (count($this->productosdestacados) == 1) {
											echo 'col-6 col-lg-4 mx-auto';
										} else {
											echo 'col-6 col-lg-4';
										} ?> mt-3 product">
					<div class="caja-productoshome">
						<div class="caja-img">
							<?php if ($this->cat) { ?>
								<div class="etiqueta">
									<div class="etiqueta-azul">
									</div>
									<div class="etiqueta-content">
										<span>NUEVO</span>
									</div>
								</div>
							<?php } ?>

							<?php if ($producto->productos_imagen != "" and file_exists($_SERVER['DOCUMENT_ROOT'] . "/images/" . $producto->productos_imagen) === true) { ?>
								<button onclick="abrirModal('<?php echo $producto->productos_id; ?>')"
									class="addnom cargar-relacion btn-product-slider" data-bs-toggle="modal"
									data-id="<?php echo $producto->productos_id; ?>" data-bs-target="#exampleModal"><img
										src="/images/<?php echo $producto->productos_imagen; ?>" /></button>
							<?php } else { ?>
								<button onclick="abrirModal('<?php echo $producto->productos_id; ?>')"
									class="addnom cargar-relacion btn-product-slider" data-bs-toggle="modal"
									data-id="<?php echo $producto->productos_id; ?>" data-bs-target="#exampleModal"><img
										src="/corte/product.png" /></button>
							<?php } ?>
							<div class="div-imgoculto">
								<div class="div-imgoculto2">
									<div class="div-imgoculto3">
										<button onclick="abrirModal('<?php echo $producto->productos_id; ?>')"
											class="btn btn-ver addnom cargar-relacion" data-bs-toggle="modal"
											data-id="<?php echo $producto->productos_id; ?>" data-bs-target="#exampleModal">
											Ver
											Más</button>
									</div>
								</div>
							</div>

						</div>
						<div class="descrip-producto">
							<div class="div_titulo">
								<div class="row">
									<div class="content-stars">
										<div class="d-flex justify-content-start justify-content-xl-start   w-100 pb-3">
											<div class="rating-servicios my-rating<?php echo $producto->productos_id ?>">
											</div>
										</div>
										<script>
											$(".my-rating<?php echo $producto->productos_id ?>").starRating({
												initialRating: <?php echo $producto->total ? $producto->total : 0; ?>,
												strokeColor: '#894A00',
												strokeWidth: 10,
												starShape: 'rounded',
												starSize: 25,
												callback: function(currentRating, $el) {
													Swal.fire({
														title: '¡Genial!',
														text: 'Gracias por calificar',
														icon: "success",
														confirmButtonText: "Continuar",
														confirmButtonColor: "#FD8126",
													})

													$.post("/page/index/calificar/", {
														"calificacion": currentRating,
														"producto": <?php echo $producto->productos_id ?>,
													}, function(res) {
														console.log(res);
													})
													//console.log('DOM element ', $el);
												}
											});
										</script>
									</div>
									<div class="col-10 col-md-9">

										<h4>
											<?php echo $producto->productos_nombre; ?>
										</h4>
									</div>
									<div class="col-2 col-md-3 text-start content-stars">
										<?php if ($producto->favorito) {
										?>
											<i id="productn<?php echo $producto->productos_id; ?>" class="fa-solid fa-heart heart-fav"
												data-fav="<?php echo $producto->productos_id; ?>"></i>
										<?php } else { ?>
											<i id="productn<?php echo $producto->productos_id; ?>" class="fa-regular fa-heart heart-fav"
												data-fav="<?php echo $producto->productos_id; ?>"></i>
										<?php } ?>
									</div>


								</div>

							</div>
							<div class="div_codigo">
								<h5>Ref:
									<?php echo $producto->productos_codigo; ?>
								</h5>
							</div>
							<div class="div_precio">
								<h4 class="<?= $producto->productos_precio ?>">$
									<?php echo $producto->productos_precio && $producto->productos_precio > 0 ? number_format($producto->productos_precio) : $producto->productos_precio; ?>
								</h4>
							</div>
							<input type="hidden" id="nombre<?php echo $producto->productos_id; ?>"
								value="<?php echo $producto->productos_nombre; ?>">
							<input type="hidden" id="imagen<?php echo $producto->productos_id; ?>"
								value="<?php echo $producto->productos_imagen; ?>">
							<input type="hidden" id="descripcion<?php echo $producto->productos_id; ?>"
								value='<?php echo $producto->productos_descripcion; ?>'>
							<input type="hidden" id="precio<?php echo $producto->productos_id; ?>"
								value="<?php echo $producto->productos_precio && $producto->productos_precio > 0 ? number_format($producto->productos_precio) : $producto->productos_precio; ?>">
							<input type="hidden" id="id<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_id;; ?>">
							<input type="hidden" id="favorito<?php echo $producto->productos_id; ?>" value="<?php print_r($producto->favorito);; ?>">
							<input type="hidden" id="cantidad-stock<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_cantidad;; ?>">
							<input type="hidden" id="cantidad-stock" value="<?php echo $producto->productos_cantidad;; ?>">

							<div class="div_boton d-none">
								<button type="button" class="precio btn-carrito addnom no_cel" data-toggle="modal"
									data-id="<?php echo $producto->productos_id; ?>" data-target="#exampleModal"><i
										class="fas fa-shopping-cart"></i> Comprar</button>

								<button class="precio btn-carrito btn-compra additemsolo solo_cel" data-dismiss="modal" aria-label="Close"
									data-id="<?php echo $producto->productos_id; ?>"><i class="fas fa-shopping-cart"></i> Agregar al
									Carrito</button>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="vendido d-none">
			<a href="/page/productos/destacados" class="btn-lomasvendido">Lo ms vendido >></a>
			<a href="#"><span class="afiliados">Afiliados.</span><span>Haga click aqu para registrar un
					afiliado</span></a>
		</div>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
			aria-hidden="true">
			<div class="modal-dialog modal-xl modal-productos modal-fullscreen-xl-down" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<span class="detalles-modal"><i class="fa-solid fa-circle-info"></i>Detalles del producto</span>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="container contenedor-modal">
							<h4 id="nombremodal" class="modal-title d-none"></h4>
							<div class="row justify-content-between">
								<div class="col-xl-4">

									<div class="caja-img">
										<img id="imagenmodal" src="">
									</div>
									<span class="d-block w-100 text-start fst-italic fw-lighter text-secondary">Imagen de referencia.</span>
									<div id="contenedor-imagenes" class="mt-3 contenedor-imagenes d-non">

									</div>

								</div>
								<!-- <div class="col-lg-1"></div> -->
								<div class="col-xl-5 content-descripr" style="">
									<div class="caja-productoshome caja-productoshome-modal">

										<div class="descrip-producto-modal">
											<div class="div_titulo">
												<h4 id="nombremodal2"></h4>
											</div>

										</div>

										<span class="descripcion-modal">Descripción</span>

										<div class="favorito-modal" id="favorito-modal">
										</div>
										<div class="div_descripcion">
											<p id="descripcionmodal">

											</p>
										</div>
										<div class="stock-modal">
											<input class="form-control" type="number" id="producto-stock" readonly>
											<span>Stock</span>
										</div>

										<div class="div_precio">
											<h4 id="preciomodal"></h4>
										</div>
										<div class=" alert alert-warning"><i class="fa-regular fa-clock"></i> Llega o
											recoge en aproximadamente 90 minutos</div>
										<div id="contenedor-unidades">
											<span class="unidades-span d-block text-start">Unidades</span>
											<div class="unidades d-block text-start">
												<div class="input-group input-group-sm mb-3" style="width: fit-content;">
													<div class="input-group-prepend">
														<button class="btn btn-outline-secondary btn-menos" data-id="" type="button" id="btnMenos"><i
																class="fas fa-minus"></i></button>
													</div>
													<input type="text" class="form-control cantidad_item" id="cantidad_modal" value="1" min="1"
														max="" disabled>
													<div class="input-group-append">
														<button class="btn btn-outline-secondary btn-mas" data-id="" type="button" id="btnMas"><i
																class="fas fa-plus"></i></button>
													</div>

												</div>
											</div>
										</div>

										<div class="d-flex gap-2">

											<div class="contenedor-acompanamientos" id="contenedor-acompanamientos">
											</div>
											<div class="contenedor-terminos" id="contenedor-terminos">
											</div>
										</div>
										<div class="botones-modal">
											<button type="button" class="boton_cafe" data-bs-dismiss="modal"><i class="fas fa-retweet"></i>
												Seguir comprando</button>
											<button id="btnModal" class="precio btn-carrito btn-compra additemsolo " data-dismiss="modal"
												aria-label="Close" data-id=""><i class="fas fa-shopping-cart"></i> Agregar al Carrito</button>


										</div>

									</div>
								</div>
								<div class="col-xl-3 content-rel" id="iframeContainer" style="display:none">
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<style>
	.productos .caja-productoshome {
		padding: 0px;
		margin: 0px 10px;
	}

	.productos .caja-productoshome .btn-product-slider {
		padding: 0px !important;
		height: inherit;
		border: 0;
	}

	.productos .caja-productoshome .caja-img img {
		width: 100% !important;
		/* height: auto !important; */
		object-fit: contain;
	}
</style>
<?php if ($this->cat) { ?>

	<script>
		$('#mydiv').slick({
			dots: true,
			infinite: false,
			speed: 300,
			arrows: true,
			slidesToShow: 4,
			autoplay: false,
			autoplaySpeed: 2000,

			slidesToScroll: 1,
			responsive: [{
					breakpoint: 1024,
					settings: {
						slidesToShow: 3,
						slidesToScroll: 3,
						infinite: true,
						arrows: false,

						dots: true
					}
				},
				{
					breakpoint: 600,
					settings: {
						slidesToShow: 2,
						arrows: false,

						slidesToScroll: 2
					}
				},
				{
					breakpoint: 480,
					settings: {
						slidesToShow: 2,
						arrows: false,

						slidesToScroll: 1
					}
				}
				// You can unslick at a given breakpoint now by adding:
				// settings: "unslick"
				// instead of a settings object
			]
		});
	</script>
<?php } ?>