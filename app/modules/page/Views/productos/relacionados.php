<?php if (is_countable($this->relacionados) && count($this->relacionados) > 0): ?>
	<script>
		document.getElementById("iframeContainer").classList.add("d-block");
	</script>
	<div class="col-md-3 mb-3 p-3 contenedor-relacionados ">
		<h5 class="titulo_h5">Productos relacionados</h5>
		<style type="text/css">
			.main-content {
				margin: 0;
			}

			/* header,
				footer {
					display: none
				}
		 */
			/* .contenidos-producto .div-imgoculto {
					top: 10px;
					left: 10px;
					height: 95%;
					width: 90%;

				} */

			.contenedor-relacionados .productos .product {
				width: 100% !important;
				padding: 0 !important;
			}

			.contact {
				color: var(--gris);
				font-size: 25px;
			}

			.contenedor-relacionados {

				width: 100%;
				background-color: #fdfdfd;
				border: 1px solid var(--grisclaro);
			}

			.relacionados {
				height: 482px;
				overflow-y: auto;

			}

			.contenedor-relacionados #mydiv {
				width: 100% !important;
			}

			.containerpro {
				padding: 0 !important;

			}

			/* .productos .div-imgoculto {
					left: 10px;
					width: 92%;
				} */

			.contenedor-relacionados .relacionados .caja-img {
				background-color: #FFF;
				height: 275px;
			}

			/* .productos .caja-productoshome .caja-img {
					min-height: 253px;
				} */

			.titulo_h5 {
				background: #FFF;
				padding: 5px;
				text-align: center;
				margin-top: 9px;
				font-size: 19px;
			}

			.cargar-relacion {
				border: 0;
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

			<?php if ($this->productosrelacionados) {
				echo $this->productosrelacionados;
			} else {
				echo "<p style='text-align:center; margin-top:20px;'>No hay productos relacionados</p>";
			}
			?>
		</div>

	</div>

	<script>
		function abrirModal(id) {



			$("#cantidad_modal").val(1);

			var nombre = $("#nombre" + id).val();
			var imagen1 = $("#imagen" + id).val();
			var imagen = "/images/" + imagen1;
			var descripcion = $("#descripcion" + id).val();
			var favorito = $("#favorito" + id).val();
			var precio1 = $("#precio" + id).val();
			var cantidadstock = $("#cantidad-stock" + id).val();
			cantidadStockP = cantidadstock;
			$("#iframeContainer").show();

			$.post(
				"/page/productos/relacionados", {
					producto: id,
				},
				function(res) {
					$("#iframeContainer").html(res);
					setInterval(() => {
						eliminarClase()
					}, 100);
				}
			);


			$.post(
				"/page/index/traerfotos/", {
					producto: id,
				},
				function(res) {

					var contenedorImagenes = document.getElementById("contenedor-imagenes");

					// Crea un elemento div con la clase "row"
					var rowDiv = document.createElement("div");
					rowDiv.classList.add("row");
					// rowDiv.classList.add('w-100');

					// Agrega el elemento div "row" al contenedor
					contenedorImagenes.appendChild(rowDiv);

					res.forEach(function(element) {
						// Crea un elemento div con la clase "col-4"
						var colDiv = document.createElement("div");
						colDiv.classList.add("col-4");

						// Crea un elemento img
						var imagenElement = document.createElement("img");

						// Configura el atributo src con la ruta de la imagen del array
						imagenElement.src = "/images/" + element.fotos_productos_imagen;

						// Agrega el elemento img al elemento div "col-4"
						colDiv.appendChild(imagenElement);

						// Agrega el elemento div "col-4" al elemento div "row"
						rowDiv.appendChild(colDiv);
					});
				}
			);

			var precio = "$" + precio1;
			var id = $("#id" + id).val();
			if (imagen1 == "") {
				imagen = "/corte/product.png";
			}


			document.getElementById("nombremodal").innerHTML = nombre;
			document.getElementById("nombremodal2").innerHTML = nombre;
			document.getElementById("imagenmodal").src = imagen;
			document.getElementById("descripcionmodal").innerHTML = descripcion;
			document.getElementById("btnModal").dataset.id = id;
			document.getElementById("preciomodal").innerHTML = precio;
			document.getElementById("favorito-modal").innerHTML = favorito ?
				`<i id='${id}' class="fa-solid fa-heart"
			onclick="toggleFavorito(${id})"></i>` :
				`<i id='${id}' class="fa-regular fa-heart"
			onclick="toggleFavorito(${id})"></i>`;

			document.getElementById("producto-stock").value = cantidadstock;

			const unidadesContainer = document.getElementById("contenedor-unidades");
			unidadesContainer.style.display = "block";
		}


		$("body").on("click", ".cargar-relacion2", function() {

			var id = $(this).attr("data-id");
			var nombre = $("#nombre" + id).val();
			var imagen1 = $("#imagen" + id).val();
			var imagen = "/images/" + imagen1;
			var descripcion = $("#descripcion" + id).val();
			var favorito = $("#favorito" + id).val();
			var precio1 = $("#precio" + id).val();
			var cantidadstock = $("#cantidad-stock" + id).val();
			cantidadStockP = cantidadstock;


			var filePath = imagen;

			$.post(
				"/page/index/traerfotos/", {
					producto: id,
				},
				function(res) {

					var contenedorImagenes = document.getElementById("contenedor-imagenes");

					// Crea un elemento div con la clase "row"
					var rowDiv = document.createElement("div");
					rowDiv.classList.add("row");
					// rowDiv.classList.add('w-100');

					// Agrega el elemento div "row" al contenedor
					contenedorImagenes.appendChild(rowDiv);

					res.forEach(function(element) {
						// Crea un elemento div con la clase "col-4"
						var colDiv = document.createElement("div");
						colDiv.classList.add("col-4");

						// Crea un elemento img
						var imagenElement = document.createElement("img");

						// Configura el atributo src con la ruta de la imagen del array
						imagenElement.src = "/images/" + element.fotos_productos_imagen;

						// Agrega el elemento img al elemento div "col-4"
						colDiv.appendChild(imagenElement);

						// Agrega el elemento div "col-4" al elemento div "row"
						rowDiv.appendChild(colDiv);
					});
				}
			);

			var precio = "$" + precio1;
			var id = $("#id" + id).val();
			if (imagen1 == "") {
				imagen = "/corte/product.png";
			}

			document.getElementById("nombremodal").innerHTML = nombre;
			document.getElementById("nombremodal2").innerHTML = nombre;
			document.getElementById("imagenmodal").src = imagen;
			document.getElementById("descripcionmodal").innerHTML = descripcion;
			document.getElementById("btnModal").dataset.id = id;
			document.getElementById("preciomodal").innerHTML = precio;
			document.getElementById("favorito-modal").innerHTML = favorito ?
				`<i id='${id}' class="fa-solid fa-heart"
			onclick="toggleFavorito(${id})"></i>` :
				`<i id='${id}' class="fa-regular fa-heart"
			onclick="toggleFavorito(${id})"></i>`;

			document.getElementById("producto-stock").value = cantidadstock;
			$.post(
				"/page/productos/relacionados", {
					producto: id,
				},
				function(res) {
					document.getElementById("iframeContainer").innerHTML = res;
				}
			);

		})

		function eliminarClase() {
			// Obtener todos los elementos con la clase "cargar-relacion"
			const elementos = document.querySelectorAll(".cargar-relacion");
			elementos.forEach((element) => {
				// element.classList.add("addnom_2");
				element.classList.remove("addnom");
				element.setAttribute("data-bs-toggle", "");
				element.setAttribute("data-bs-target", "");

			});


		}
	</script>
<?php endif; ?>