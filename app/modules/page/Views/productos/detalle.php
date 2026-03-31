<div class="contenidos-producto">
	<div class="container">
		<section id="interna">
			<div class="row">

				<div class="col-12 col-md-2 mt-3">
					<a href="/page/?categoria=<?php echo $this->categoria->categorias_id; ?>#a" class="enlace-volver">
						<i class="fa-solid fa-circle-chevron-left"></i>
						<span>Regresar</span>

					</a>
				</div>
				<div class="col-12">
					<h2 class="contact mt-3">Detalle de producto</h2>
				</div>
				<!-- <div class="col-md-1 mt-5 mb-3"></div> -->
				<div class="col-md-9 mt-1 mb-3">
					<div class="caja-producto shadow-lg">
						<div class="row">
							<div class="row col-md-6 mt-3">
								<div class="col-10">
									<div class="titulo-procucto2">
										<h3>
											<?php echo $this->producto->productos_nombre; ?>
										</h3>
									</div>
								</div>
								<div class="col-2 my-2">
									<?php if ($this->producto->favorito) { ?>
										<i id="<?php echo $this->producto->productos_id; ?>" class="fa-solid fa-heart"
											onclick="toggleFavorito(<?php echo $this->producto->productos_id; ?>)"></i>
									<?php } else { ?>
										<i id="<?php echo $this->producto->productos_id; ?>" class="fa-regular fa-heart"
											onclick="toggleFavorito(<?php echo $this->producto->productos_id; ?>)"></i>
									<?php } ?>
								</div>
								<div class="col-12">
									<div>
										<div class="d-flex justify-content-start justify-content-xl-start   w-100 pb-3">
											<div
												class="rating-servicios my-rating<?php echo $this->producto->productos_id ?>">
											</div>
										</div>
										<script>
											$(".my-rating<?php echo $this->producto->productos_id ?>").starRating({
												initialRating: <?php echo $this->producto->total ? $this->producto->total : 0; ?>,
												strokeColor: '#894A00',
												strokeWidth: 10,
												starShape: 'rounded',
												starSize: 25,
												callback: function (currentRating, $el) {
													Swal.fire({
														title: '¡Genial!',
														text: 'Gracias por calificar',
														icon: "success",
														confirmButtonText: "Continuar",
														confirmButtonColor: "#FD8126",
													})
													$.post("/page/index/calificar/", {
														"calificacion": currentRating,
														"producto": <?php echo $this->producto->productos_id ?>,
													}, function (res) {
														console.log(res);
													})
													//console.log('DOM element ', $el);
												}
											});
										</script>
									</div>
								</div>


								<div class="caja-descripcion">
									<article class="text-center text-lg-left">
										<?php echo $this->producto->productos_descripcion; ?>
									</article>
									<?php if ($_SESSION['kt_cedula'] != "") { ?>
										<div class="precio">
											<i class="fas fa-tag"></i> <label>Precio</label> $
											<?php
											$iva = $this->informacion->info_pagina_iva;
											$valorivaproducto = ($this->producto->productos_precio * $iva) / 100;
											$precioproductoiva = $this->producto->productos_precio + $valorivaproducto;
											echo number_format($this->producto->productos_precio);
											?>
										</div>
										<input type="hidden" id="stock-detalle"
											value="<?php echo $this->producto->productos_cantidad; ?>">
										<div class="stock">
											<i class="fa-solid fa-boxes-packing"></i> <label>Unidades disponibles</label>
											<?php echo $this->producto->productos_cantidad; ?>

										</div>
										<div class="unidades my-4">
											<div class="input-group input-group-sm mb-3">
												<div class="input-group-prepend">
													<button class="btn btn-outline-secondary btn-menos" data-id=""
														type="button" id="btnMenos"><i class="fas fa-minus"></i></button>
												</div>
												<input type="text" class="form-control cantidad_item" id="cantidad_modal"
													value="1" min="1" max="" disabled>
												<div class="input-group-append">
													<button class="btn btn-outline-secondary btn-mas" data-id=""
														type="button" id="btnMas"><i class="fas fa-plus"></i></button>
												</div>

											</div>
										</div>
										<div class="div_botones">
											<div class="row">
												<div class="col-lg-6">
													<button class="btn-carrito btn-compra additemsolo btn-block"
														data-id="<?php echo $this->producto->productos_id; ?>">
														<i class="fas fa-cart-plus"></i> Añadir al Carrito
													</button>
												</div>
												<div class="col-lg-6">
													<button class="btn-carrito btn-compra btn-block" href="/page/index">
														<a href="/page/index" class="enlace_blanco"> <i
																class="fas fa-retweet"></i> Seguir Comprando</a>
													</button>
												</div>
											</div>
										</div>

									<?php } else { ?>
										<div class="precio">
											<label>Precio $
												<?php echo number_format($this->producto->productos_precio); ?>
											</label>
										</div>
									<?php } ?>

								</div>
							</div>
							<div class="col-md-6 mt-3">
								<div class="imagen1 text-center">
									<?php if ($this->producto->productos_imagen != "" and file_exists($_SERVER['DOCUMENT_ROOT'] . "/images/" . $this->producto->productos_imagen) === true) { ?>
										<img src="/images/<?php echo $this->producto->productos_imagen; ?>">
									<?php } else { ?>
										<img src="/corte/product.png">
									<?php } ?>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12 text-start migadepan d-block d-lg-none">
						<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
							<ol class="breadcrumb justify-content-start">
								<li class="breadcrumb-item"><a
										href="/page/?categoria=<?php echo $this->categoria->categorias_id; ?>#a">
										<?php echo $this->categoria->categorias_nombre; ?>
									</a></li>
								<li class="breadcrumb-item active" aria-current="page"><a
										href="/page/?categoria=<?php echo $this->categoria->categorias_id; ?>&subcategoria=<?php echo $this->subcategoria->categorias_id; ?>#a">
										<?php echo $this->subcategoria->categorias_nombre; ?>
									</a></li>
							</ol>
						</nav>
					</div>
				</div>
				<div class="col-md-3 mt-1 mb-3 contenedor-relacionados ">
					<h5 class="titulo_h5">Productos relacionados</h5>
					<style type="text/css">
						.contenidos-producto .div-imgoculto {
							top: 10px;
							left: 10px;
							height: 95%;
							width: 90%;

						}

						.productos .product {
							width: 100% !important;
							padding: 0 !important;
						}

						.contact {
							color: var(--gris);
							font-size: 25px;
						}

						.contenedor-relacionados {

							background-color: var(--grisclaro);
						}

						.relacionados {
							height: 482px;
							overflow-y: scroll;

						}

						#mydiv {
							width: 100% !important;
						}

						.containerpro {
							padding: 0 !important;

						}

						.productos .caja-productoshome .caja-img {
							min-height: 253px;
						}

						.titulo_h5 {
							background: #FFF;
							padding: 5px;
							text-align: center;
							margin-top: 9px;
							font-size: 19px;
						}

						@media (max-width: 755px) {
							.productos .caja-productoshome .caja-img img {
								width: auto !important;
								height: 220px;
							}

							.relacionados {
								height: 420px;
							}
						}
					</style>
					<div class="relacionados">

						<?php echo $this->productosrelacionados; ?>
					</div>
				</div>

				<div class="col-12 text-start migadepan d-none d-lg-block">
					<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
						<ol class="breadcrumb justify-content-start">
							<li class="breadcrumb-item"><a
									href="/page/?categoria=<?php echo $this->categoria->categorias_id; ?>#a">
									<?php echo $this->categoria->categorias_nombre; ?>
								</a></li>
							<li class="breadcrumb-item active" aria-current="page"><a
									href="/page/?categoria=<?php echo $this->categoria->categorias_id; ?>&subcategoria=<?php echo $this->subcategoria->categorias_id; ?>#a">
									<?php echo $this->subcategoria->categorias_nombre; ?>
								</a></li>
						</ol>
					</nav>
				</div>
			</div>
			<div class="row mt-5 mb-3">
				<div class="col-lg-12">

				</div>
			</div>
		</section>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function () {
		$("#carousel_container").carousel({
			pause: 5000,
			quantity: 4,
			auto: 'false',
			sizes: {
				'968': 2,
				'500': 1
			}
		});
	});
</script>