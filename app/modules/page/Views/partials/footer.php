<div class="r footer_home">
	<div class="container">
		<div class="row">


			<div class=" col-3 col-lg-4 order-lg-1 order-1 p-0 ">
				<div class="d-flex justify-content-center">
					<div class="redes-footer">

						<img class="logo-footer" src="/corte2/Logo_Nogal_En_Casa_Pagina.png">

						<span>Síganos en:</span>
						<div class="redes">

							<?php if ($this->infopage->info_pagina_whatsapp) { ?>
								<?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $this->infopage->info_pagina_whatsapp), 10); ?>
								<a href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp; ?>" target="_blank" class="">
									<i class="fab fa-whatsapp"></i>
									<span class="d-none">
										<?php echo $this->infopage->info_pagina_whatsapp ?>
									</span>
								</a>
							<?php } ?>
							<?php if ($this->infopage->info_pagina_facebook) { ?>
								<a href="<?php echo $this->infopage->info_pagina_facebook ?>" target="_blank" class="">
									<i class="fa-brands fa-facebook-f"></i>
								</a>
							<?php } ?>
							<?php if ($this->infopage->info_pagina_twitter) { ?>
								<a href="<?php echo $this->infopage->info_pagina_twitter ?>" target="_blank" class="">
									<i class="bi bi-twitter-x"></i> </a>
							<?php } ?>
							<?php if ($this->infopage->info_pagina_instagram) { ?>
								<a href="<?php echo $this->infopage->info_pagina_instagram ?>" target="_blank" class="">
									<i class="fa-brands fa-instagram"></i> </a>
							<?php } ?>
							<?php if ($this->infopage->info_pagina_pinterest) { ?>
								<a href="<?php echo $this->infopage->info_pagina_pinterest ?>" target="_blank" class="">
									<i class="fab fa-pinterest-p"></i>
								</a>
							<?php } ?>
							<?php if ($this->infopage->info_pagina_youtube) { ?>
								<a href="<?php echo $this->infopage->info_pagina_youtube ?>" target="_blank" class="">
									<i class="fab fa-youtube"></i>
								</a>
							<?php } ?>
							<?php if ($this->infopage->info_pagina_linkdn) { ?>
								<a href="<?php echo $this->infopage->info_pagina_linkdn ?>" target="_blank" class="">
									<i class="fab fa-linkedin-in"></i>
								</a>
							<?php } ?>
							<?php if ($this->infopage->info_pagina_google) { ?>
								<a href="<?php echo $this->infopage->info_pagina_google ?>" target="_blank" class="">
									<i class="fab fa-google-plus-g"></i>
								</a>
							<?php } ?>
							<?php if ($this->infopage->info_pagina_flickr) { ?>
								<a href="<?php echo $this->infopage->info_pagina_flickr ?>" target="_blank" class="">
									<i class="fab fa-flickr"></i>
								</a>
							<?php } ?>
						</div>
					</div>
				</div>

			</div>
			<div class="col-9 col-lg-4 order-lg-2 order-3 content-footer">
				<div class="margen_contenido_footer">
					<?php echo $this->contenidoFooter1->contenido_descripcion; ?>
				</div>
			</div>
			<div class="col-9 col-lg-4 order-lg-3 order-2 content-footer">
				<div class="">
					<?php echo $this->contenidoFooter2->contenido_descripcion ?>
				</div>
			</div>

		</div>
	</div>
</div>
<div class="footer-info">
	<div class="container">
		<div class="row py-lg-4">
			<div class="col-12 col-lg-2 footer-sub ">

				<div>
					<a href="https://www.clubelnogal.com" target="_blank">
						<img src="/corte/logonegro.png">
					</a>
				</div>


			</div>
			<div class="col-12 col-lg-10 footer-sub ">

				<ul class="lista_horizontal">
					<li class="li2 disabled"><a href="/" <?php echo $this->botonactivo == 1 ? 'class="active"' : '' ?>>Inicio</a>
					</li>
					<span class="sep">|</span>
					<li class="li2"><a href="#" data-bs-toggle="modal" data-bs-target="#comoComprar">¿Cómo comprar?</a>
					</li>
					<span class="sep">|</span>
					<li class="li2"><a href="https://es.surveymonkey.com/r/FFWSKW7" target="_blank">Califique nuestro servicio</a>
					</li>
					<span class="sep">|</span>

					<li class="li2 d-none"><a href="#" data-bs-toggle="modal" data-bs-target="#seguridadSanitaria">Seguridad
							sanitaria</a></li>

					<span class="sep">|</span>

					<li class="disabled"><a href="/page/formulario" <?php echo $this->botonactivo == 4 ? 'class="active"' : '' ?>>Contacto</a></li>
					<span class="sep">|</span>



					<li><a href="https://www.clubelnogal.com/terminos-y-condiciones-de-uso/" target="_blank">Términos y
							condiciones</a></li>
					<span class="sep">|</span>

					<li><a href="#" data-bs-toggle="modal" data-bs-target="#tratamientoDatos">Tratamiento de datos personales</a>
					</li>
					<span class="sep">|</span>

					<li class=""><a href="" data-bs-toggle="modal" data-bs-target="#terminosCondiciones">Preguntas frecuentes</a>
					</li>

				</ul>

			</div>

		</div>
	</div>

	<script>
		// Seleccionar el tercer elemento con la clase "mi-clase"
		const elementos = document.querySelectorAll('.sep');

		// Verificar si hay al menos tres elementos antes de intentar ocultar el tercero

		// Ocultar el tercer elemento (ndice 2 en el array)
		elementos[2].style.display = 'none';

	</script>
	<div class="text-center copyright align-items-center justify-content-center py-2 px-2">

		Trabajamos para ofrecer a nuestros socios una variada oferta gastronómica con la mejor calidad y precios
		competitivos.<br>
		Las tarifas son dinámicas y pueden modificarse de acuerdo al costo de las materias primas que se utilizan en las
		preparaciones.
		<hr>
		<span class="">Copyright ©
			<?php echo date('Y') ?>
		</span> Corporación Club El Nogal Todos los derechos reservados
	</div>




</div>

<!-- <div class="derechos">
	<span>© 2020</span> Todos los Derechos Reservados Corporacin Club El Nogal | Desarrollado por <a href="http://www.omegasolucionesweb.com" target="_blank" class="enlacered1">Omega Soluciones Web</a>
</div> -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<iframe id="iframe_login" src="/page/login/" width="100%" scrolling="auto" frameborder="0"
					height="500"></iframe>
			</div>
		</div>
	</div>
</div>


</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" id="boton_modal2" data-toggle="modal"
	data-target="#exampleModal_express">
	Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal_express" tabindex="-1" role="dialog"
	aria-labelledby="exampleModal_expressLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModal_expressLabel">Restaurante Express Cocina Nogal</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php if ($hora >= "18:00:00") { ?>
					Apreciado socio, lo invitamos a realizar su pedido el día de mañana en el horario de 10 a.m. a 6 p.m. y
					disfrutar de nuestra carta.
				<?php } else { ?>
					Apreciado socio, lo invitamos a realizar su pedido en el horario de 10 a.m. a 6 p.m. y disfrutar de
					nuestra carta.
				<?php } ?>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>




<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" id="boton_modal3" data-toggle="modal"
	data-target="#exampleModal_cafeparis">
	Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal_cafeparis" tabindex="-1" role="dialog"
	aria-labelledby="exampleModal_expressLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModal_expressLabel">Café París Express</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<?php if ($hora >= "16:00:00") { ?>
					Apreciado socio, lo invitamos a realizar su pedido el día de mañana en el horario de 8 a.m. a 4 p.m. y
					disfrutar de nuestra carta.
				<?php } else { ?>
					Apreciado socio, lo invitamos a realizar su pedido en el horario de 8 a.m. a 4 p.m. y disfrutar de
					nuestra carta.
				<?php } ?>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>

<div class="modal fade modal-negro" id="seguridadSanitaria" tabindex="-1" aria-labelledby="seguridadSanitariaLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-fullscreen modal-comprar">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <h1 class="modal-title fs-5" id="seguridadSanitariaLabel">Modal title</h1> -->
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<div class="container">

					<?php echo $this->seguridadSanitaria;

					?>


					<div class="row">
						<div class="col">
							<div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
								<?php foreach ($this->seguridadSanitaria as $paso) { ?>
									<!-- <?php print_r($paso) ?> -->
									<div class="timeline-step">
										<div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title=""
											data-content="And here's some amazing content. It's very engaging. Right?"
											data-original-title="2003">
											<img src="/images/<?php echo $paso->contenido_imagen ?>" alt="">
											<?php echo $paso->contenido_descripcion ?>

										</div>
									</div>
								<?php } ?>


							</div>
						</div>

					</div>
				</div>
			</div>
			<div class="modal-footer d-none">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade modal-negro" id="terminosCondiciones" tabindex="-1" aria-labelledby="terminosCondicionesLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-xl modal-comprar">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="titulo-principal contact text-left">Preguntas frecuentes</h2>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<div class="container">

					<?php echo $this->preguntasFrecuentes; ?>

				</div>
			</div>
			<div class="modal-footer d-none">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>



<div class="modal fade modal-negro" id="tratamientoDatos" tabindex="-1" aria-labelledby="tratamientoDatosLabel"
	aria-hidden="true">
	<div class="modal-dialog modal-xl modal-fondo">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="titulo-principal contact text-left">Política de tratamiento de datos personales de la Corporación
					Club El Nogal
				</h2>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<div class="container">

					<?php echo $this->tratamientoDatos; ?>



				</div>
			</div>
			<div class="modal-footer d-none">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>