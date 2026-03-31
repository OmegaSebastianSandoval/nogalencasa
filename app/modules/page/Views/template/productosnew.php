<!-- <script>
	// JavaScript (puedes incluir este script en tu HTML o en un archivo externo)
	document.addEventListener('DOMContentLoaded', function () {
		var etiquetaContents = document.querySelectorAll('.productos .etiqueta-content');

		etiquetaContents.forEach(function (element, index) {
			if (index % 3 === 0) {
				element.classList.add('color-naranja');
			} else if (index % 3 === 1) {
				element.classList.add('color-verde');
			} else {
				element.classList.add('color-azul');
			}
		});
	});

</script> -->

<div class="productos" align="center">
	<div class="container containerpro ">
		<div class="row">

			<div class="col-3 col-lg-3 d-none d-lg-block new-cat pt-3">
				<h4>Categorías</h4>

				<form class="d-flex" method="post" action="/page/index/#a">
					<div class="input-group">
						<input class="form-control buscar" name="buscar" value="<?php echo $_POST['buscar']; ?>" type="search" placeholder="Buscar aquí" aria-label="Buscar" required>
						     <input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">
						<button class="btn btn-outline-dark" type="submit">
							<i class="fa-solid fa-magnifying-glass"></i><!-- Icono de lupa de Bootstrap Icons -->
						</button>
					</div>
				</form>

				<div class="col-lg-12 col-sm-12  boton-filtro">


					<div>
						<!-- Estructura HTML para la lista de categorías y subcategorías -->
						<ul id="categoryList">
							<?php foreach ($this->categorias2 as $key => $categoria) { ?>
								<li class="category  <?php echo ($this->categoriaActiva == $categoria->categorias_id) ? 'active' : '' ?>">
									<a href="?categoria=<?php echo $categoria->categorias_id; ?>&page=1#a" <?php echo ($this->categoriaActiva == $categoria->categorias_id) ? 'class="activo"' : '' ?>>
										<?php echo $categoria->categorias_nombre; ?>
									</a>
									<?php if (is_countable($categoria->hijos) && count($categoria->hijos) > 0) { ?>
										<span class="arrow <?php echo ($this->categoriaActiva == $categoria->categorias_id) ? 'expanded' : '' ?>" onclick="toggleSubcategories(this)"></span>
										<ul class="subcategory <?php echo ($this->categoriaActiva == $categoria->categorias_id) ? 'active' : '' ?>">
											<?php foreach ($categoria->hijos as $key2 => $subcategoria) : ?>
												<li><a href="?categoria=<?php echo $categoria->categorias_id; ?>&subcategoria=<?php echo $subcategoria->categorias_id; ?>&page=1#a" <?php echo ($this->subcategoriaActiva == $subcategoria->categorias_id) ? 'class="active"' : '' ?>>
														<?php echo $subcategoria->categorias_nombre; ?>
													</a></li>
											<?php endforeach ?>
										</ul>
									<?php } ?>
								</li>
							<?php } ?>
						</ul>

						<!-- Agrega más categorías y subcategorías segn tus datos -->

					</div>


				</div>




			</div>
			<div class=" d-block d-lg-none ">

				<!-- Button trigger modal -->
				<button type="button" class="ver-categorias" data-bs-toggle="modal" data-bs-target="#categorias-responsive">
					Ver categorias
				</button>

				<!-- Modal -->
				<div class="modal fade" id="categorias-responsive" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-fullscreen modal-categorias">
						<div class="modal-content">
							<div class="modal-header">
								<h1>Categorías</h1>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<div>

									<form class="d-flex" method="post" action="/page/index/#a">
										<div class="input-group">
											<input class="form-control buscar" name="buscar" value="<?php echo $_POST['buscar']; ?>" type="search" placeholder="¿Qué buscas?" aria-label="Buscar">
											     <input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">
											<button class="btn btn-outline-dark" type="submit">
												<i class="fa-solid fa-magnifying-glass"></i><!-- Icono de lupa de Bootstrap Icons -->
											</button>
										</div>
									</form>
									<!-- Estructura HTML para la lista de categorías y subcategorías -->
									<ul id="categoryList">
										<?php foreach ($this->categorias2 as $key => $categoria) { ?>

											<li class="category <?php echo ($this->categoriaActiva == $categoria->categorias_id) ? 'active' : '' ?>"><a href="?categoria=<?php echo $categoria->categorias_id; ?>&page=1#a">
													<?php echo $categoria->categorias_nombre; ?>
												</a>
												<?php if (is_countable($categoria->hijos) && count($categoria->hijos) > 0) { ?>
													<span class="arrow <?php echo ($this->categoriaActiva == $categoria->categorias_id) ? 'expanded' : '' ?>" onclick="toggleSubcategories(this)"></span>
													<ul class="subcategory <?php echo ($this->categoriaActiva == $categoria->categorias_id) ? 'active' : '' ?>">
														<?php foreach ($categoria->hijos as $key2 => $subcategoria) : ?>
															<li><a href="?categoria=<?php echo $categoria->categorias_id; ?>&subcategoria=<?php echo $subcategoria->categorias_id; ?>&page=1#a" <?php echo ($this->subcategoriaActiva == $subcategoria->categorias_id) ? 'class="active"' : '' ?>>
																	<?php echo $subcategoria->categorias_nombre; ?>
																</a></li>
														<?php endforeach ?>
													</ul>
												<?php } ?>
											</li>

										<?php } ?>
									</ul>

									<!-- Agrega más categorías y subcategorías segn tus datos -->

								</div>
							</div>
							<div class="modal-footer d-none">

							</div>
						</div>
					</div>
				</div>

			</div>

			<div class="row col-lg-9 containerpro-new m-0" id="mydiv">

				<div class="dropdown pt-3 mb-auto">
					<a class="btn btn-secondary dropdown-toggle float-end" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
						Ordenar por
					</a>

					<ul class="dropdown-menu">
						<li><a class="dropdown-item <?php if ($this->filter == 'OrderByPriceDesc') {
																					echo "filter-active";
																				} ?>" href="?filter=OrderByPriceDesc&page=1#a">Precio más bajo</a></li>

						<li><a class="dropdown-item  <?php if ($this->filter == 'OrderByPriceAsc') {
																						echo "filter-active";
																					} ?>" href="?filter=OrderByPriceAsc&page=1#a">Precio más alto</a></li>

						<li><a class="dropdown-item  <?php if ($this->filter == 'OrderByRecent') {
																						echo "filter-active";
																					} ?>" href="?filter=OrderByRecent&page=1#a">Más recientes</a></li>

						<li><a class="dropdown-item  <?php if ($this->filter == 'OrderByFav') {
																						echo "filter-active";
																					} ?>" href="?filter=OrderByFav&page=1#a">Relevancia</a></li>

					</ul>
				</div>
				<?php if (count($this->productosdestacados) <= 0) { ?>
					<div class="alert alert-warning mb-auto" role="alert">
						Sin productos destacados
					</div>
				<?php } ?>
				<?php foreach ($this->productosdestacados as $key => $producto) {

				?>

					<div class="<?php if (count($this->productosdestacados) == 1) {
												echo 'col-6 col-lg-4 mx-auto';
											} else {
												echo 'col-6 col-lg-4 col-xl-3';
											} ?> mt-3 product">
						<div class="caja-productoshome">
							<div class="caja-img caja-img-new">
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
									<button class="addnom" data-bs-toggle="modal" data-id="<?php echo $producto->productos_id; ?>" data-bs-target="#exampleModal"><img src="/images/<?php echo $producto->productos_imagen; ?>" /></button>
								<?php } else { ?>
									<button class="addnom" data-bs-toggle="modal" data-id="<?php echo $producto->productos_id; ?>" data-bs-target="#exampleModal"><img src="/corte/product.png" /></button>
								<?php } ?>
								<div class="div-imgoculto">
									<div class="div-imgoculto2">
										<div class="div-imgoculto3">
											<button class="btn btn-ver addnom" data-bs-toggle="modal" data-id="<?php echo $producto->productos_id; ?>" data-bs-target="#exampleModal">
												Ver M&aacute;s</button>
										</div>
									</div>
								</div>

							</div>
							<div class="descrip-producto descrip-producto-new">
								<div class="div_titulo">
									<div class="row g-0">
										<div>
											<div class="d-flex justify-content-center justify-content-xl-start   w-100 pb-2">
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
										<div class="col-10 col-md-9 col-lg-11">

											<h4>
												<?php echo $producto->productos_nombre; ?>
											</h4>
										</div>

										<div class="col-2 col-md-3 col-lg-1 text-end content-stars">
											<?php if ($producto->favorito) {
											?>
												<i id="productn<?php echo $producto->productos_id; ?>" class="fa-solid fa-heart heart-fav" data-fav="<?php echo $producto->productos_id; ?>"></i>
											<?php } else { ?>
												<i id="productn<?php echo $producto->productos_id; ?>" class="fa-regular fa-heart heart-fav" data-fav="<?php echo $producto->productos_id; ?>"></i>
											<?php } ?>
										</div>

										<!-- 	<div class="col-3">
										<?php if ($producto->favorito) { ?>
											<i id="<?php echo $producto->productos_id; ?>" class="fa-solid fa-heart"
												onclick="toggleFavorito(<?php echo $producto->productos_id; ?>)"></i>
										<?php } else { ?>
											<i id="<?php echo $producto->productos_id; ?>" class="fa-regular fa-heart"
												onclick="toggleFavorito(<?php echo $producto->productos_id; ?>)"></i>
										<?php } ?>
									</div> -->


									</div>

								</div>
								<div class="div_codigo">
									<h5>Ref:
										<?php echo $producto->productos_codigo; ?>
									</h5>
								</div>
								<div class="div_precio">
									<h4 class="mb-0 text-center <?= $producto->productos_precio ?>">$
										<?php if ($producto->productos_precio) {
											echo $producto->productos_precio && $producto->productos_precio > 0 ?  number_format($producto->productos_precio) : $producto->productos_precio;
										} ?>
									</h4>
								</div>
								<input type="hidden" id="nombre<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_nombre; ?>">
								<input type="hidden" id="imagen<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_imagen; ?>">
								<input type="hidden" id="descripcion<?php echo $producto->productos_id; ?>" value='<?php echo $producto->productos_descripcion; ?>'>
								<input type="hidden" id="precio<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_precio && $producto->productos_precio > 0 ?  number_format($producto->productos_precio) : $producto->productos_precio; ?>">
								<input type="hidden" id="id<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_id;; ?>">
								<input type="hidden" id="favorito<?php echo $producto->productos_id; ?>" value="<?php print_r($producto->favorito);; ?>">
								<input type="hidden" id="cantidad-stock<?php echo $producto->productos_id; ?>" value="<?php echo $producto->productos_cantidad;; ?>">
								<input type="hidden" id="cantidad-stock" value="<?php echo $producto->productos_cantidad;; ?>">

							</div>
						</div>
						<div class="div_boton">
							<button type="button" class="precio btn-carrito addnom " data-bs-toggle="modal" data-id="<?php echo $producto->productos_id; ?>" data-bs-target="#exampleModal">Ver producto <i class="fas fa-shopping-cart"></i> </button>

							<!-- <button class="precio btn-carrito btn-compra additemsolo solo_cel" data-bs-dismiss="modal"
									aria-label="Close" data-id="<?php echo $producto->productos_id; ?>"><i
										class="fas fa-shopping-cart"></i> Agregar al Carrito</button> -->
						</div>
					</div>

				<?php } ?>
				<?php if ($this->totalpages > 1) { ?>
					<div align="center" class="col-lg-12">
						<br>
						<ul class="pagination justify-content-center">
							<?php

							$url = $this->route;
							$max = $this->page + 6;
							$min = $this->page - 6;
							if ($this->page > 1) {
								$max = $this->page + 3;
								$min = $this->page - 3;
							}
							if ($this->page == 2) {
								$max = $this->page + 5;
							}
							if ($this->page == 3) {
								$max = $this->page + 4;
							}
							$extra_params = '';
							if (isset($_GET['categoria'])) {
								$extra_params .= '&categoria=' . urlencode($_GET['categoria']);
							}
							if (isset($_GET['subcategoria'])) {
								$extra_params .= '&subcategoria=' . urlencode($_GET['subcategoria']);
							}
							if ($this->totalpages > 1) {
								if ($this->page != 1) {
									echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page - 1) . $extra_params . '#a"> <i class="fa-solid fa-chevron-left"></i> </a></li>';
								}
								for ($i = 1; $i <= $this->totalpages; $i++) {
									if ($this->page == $i) {
										echo '<li class="active page-item"><a class="page-link">' . $this->page . '</a></li>';
									} else {
										if ($i >= $min and $i <= $max) {
											echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . $i . $extra_params . '#a">' . $i . '</a></li>  ';
										}
									}
								}
								if ($this->page != $this->totalpages) {
									echo '<li class="page-item"><a class="page-link" href="' . $url . '?page=' . ($this->page + 1) . $extra_params . '#a"><i class="fa-solid fa-chevron-right"></i></a></li>';
								}
							}
							?>
						</ul>
					</div>
				<?php } ?>

			</div>
		</div>

		<div class="vendido d-none">
			<a href="/page/productos/destacados" class="btn-lomasvendido">Lo ms vendido >></a>
			<a href="#"><span class="afiliados">Afiliados.</span><span>Haga click aqu para registrar un
					afiliado</span></a>
		</div>
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl modal-productos modal-fullscreen-xl-down" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<span class="detalles-modal"><i class="fa-solid fa-circle-info"></i> Detalles del producto</span>
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

										<span class="descripcion-modal">Descripci&oacute;n</span>

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
														<button class="btn btn-outline-secondary btn-menos" data-id="" type="button" id="btnMenos"><i class="fas fa-minus"></i></button>
													</div>
													<input type="text" class="form-control cantidad_item" id="cantidad_modal" value="1" min="1" max="" disabled>
													<div class="input-group-append">
														<button class="btn btn-outline-secondary btn-mas" data-id="" type="button" id="btnMas"><i class="fas fa-plus"></i></button>
													</div>

												</div>
											</div>
										</div>
										<div class="d-flex gap-2">

											<div
												class="contenedor-acompanamientos" id="contenedor-acompanamientos">
											</div>
											<div
												class="contenedor-terminos" id="contenedor-terminos">
											</div>
										</div>

										<div class="botones-modal">
											<button type="button" class="boton_cafe" data-bs-dismiss="modal"><i class="fas fa-retweet"></i> Seguir comprando</button>
											<button id="btnModal" class="precio btn-carrito btn-compra additemsolo " data-dismiss="modal" aria-label="Close" data-id=""><i class="fas fa-shopping-cart"></i> Agregar al Carrito</button>


										</div>

									</div>
								</div>
								<div class="col-xl-3 content-rel" id="iframeContainer">
								</div>

							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>


</div>
<script>
	// Función para expandir/contraer subcategoras al hacer clic en la flecha
	function toggleSubcategories(arrow) {
		var categoryLink = arrow.parentNode.querySelector('a');
		var subcategoryList = arrow.parentNode.querySelector('.subcategory');

		if (subcategoryList) {
			subcategoryList.classList.toggle('active');
			arrow.classList.toggle('expanded');
			categoryLink.classList.toggle('activo');
		}
	}

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
<style>
	.main-content {


		background-color: #f2f2f2;
	}
</style>