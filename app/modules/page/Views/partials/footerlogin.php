<style>
	/* 	footer .puntos {
		height: 6rem;
	}






	.divisor {
		background: #947d6c;
		margin: 0 auto;
		width: 65%;
		border: 0;
	}

	.footer-sub {
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.footer-princ {
		display: flex;
		align-items: center;
		justify-content: center;
	}


	.lista_horizontal {
		list-style: none;
		display: flex;
		align-items: center;
		height: 100%;
		margin: 0;
		padding: 0;
		gap: 10px;
	}

	@media (max-width: 415px) {
		.lista_horizontal {
			display: block;
		}
	}

	@media (max-width: 772px) {
		.footer-sub {
			text-align: center;
		}

		.footer-princ {
			justify-content: center;
			text-align: center;

		}
	}

	.lista_horizontal li {
		text-align: center;
	}

	.lista_horizontal li a {
		color: #FFF;
		text-decoration: none;
	}

	.footer_home {

		line-height: 20px;
		padding: 30px;
		background: #262626;
	

	} */
</style>
<!-- <div class="footer-redes">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 text-left">
				<div class="text-footer" style="color: #FFFFFF;">
					<br>
					<span style="font-size: 20px;">Contacto para pedidos:</span><br><br>

					La Taberna Express<br>
					Teléfono: 601 3267700 Ext. 71029<br><br>

					Nogal Delivery
					Teléfono: 601 3267700 Ext. 3985<br><br>

					Club El Nogal
					Cra 5 # 78-75

				</div>
			</div>
			<div class="col-lg-5 text-left d-none">
				<div class="red1 titulosfooter">
					Información de contacto
				</div>
				<div class="text-footer">
					<span class="red"> <?php echo $this->infopage->info_pagina_informacion_contacto_footer; ?></span>
				</div>
			</div>
			<div class="col-lg-2 text-center puntos d-none">
				<div class="row text-center">
					<div align="center" class="col-12">
						<img src="/corte/logo.jpg" style="height: 3.5rem;">
					</div>
				</div>
			</div>
		</div>
	</div>
 -->
<!-- Nogal Delivery - La Taberna Express

Carrera 5 No. 78-75

Sugerencias o inquietudes del servicio:

Nogal Delivery. Tel.601 3267700 Ext. 3985 o al correo nogaldelivery@clubelnogal.com

La Taberna Express.Tel.601 3267700 Ext.71029 o al correo latabernaexpress@clubelnogal.com

¿Dudas para descargar la aplicación o ingresar al sitio web? Comuníquese al teléfono 601 3267700 Ext.1167 o al correo helpdesk@clubelnogal.com

Horario de soporte telefónico: lunes a viernes de 8 a.m. a 6 p.m. 

-->

<div class=" y footer_home">
	<div class="container">
		<div class="row">


			<div class=" col-12 col-lg-4 order-lg-1 order-1 p-0 ">
				<div class="d-flex justify-content-center">
					<div class="redes-footer">
						<img class="logo-footer" src="/corte/blan.png">

						<span>Síganos en:</span>
						<div class="redes">

							<?php if ($this->infopage->info_pagina_whatsapp) { ?>
								<?php $whatsapp = intval(preg_replace('/[^0-9]+/', '', $this->infopage->info_pagina_whatsapp), 10); ?>
								<a href="https://api.whatsapp.com/send?phone=<?php echo $whatsapp; ?>" target="_blank"
									class="">
									<i class="fab fa-whatsapp"></i>
									<span>
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
									<i class="fa-brands fa-twitter"></i> </a>
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
			<div class="col-12 col-lg-4 order-lg-2 order-3">
				<div class="margen_contenido_footer">
					<?php echo $this->contenidoFooter1->contenido_descripcion; ?>
				</div>
			</div>
			<div class="col-12 col-lg-4 order-lg-3 order-2">
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

				<div><img src="/corte2/logo-nogal.png"></div>

			</div>
			<div class="col-12 col-lg-10 footer-sub ">

				<ul class="lista_horizontal">
					<li class="li2"><a href="/" <?php echo $this->botonactivo == 1 ? 'class="active"' : '' ?>>Inicio</a>
					</li>
					<span class="sep">|</span>
					<li class="li2"><a href="#" data-bs-toggle="modal" data-bs-target="#comoComprar">¿Cómo comprar?</a>
					</li>
					<span class="sep">|</span>

					<li class="li2"><a href="#" data-bs-toggle="modal" data-bs-target="#seguridadSanitaria">Seguridad
							sanitaria</a></li>
					<span class="sep">|</span>

					<li><a href="/page/formulario" <?php echo $this->botonactivo == 4 ? 'class="active"' : '' ?>>Contacto</a></li>
					<span class="sep">|</span>

					<li><a href="#" data-bs-toggle="modal" data-bs-target="#terminosCondiciones">Términos y
							condiciones</a></li>
					<span class="sep">|</span>

					<li><a href="#" data-bs-toggle="modal" data-bs-target="#tratamientoDatos">Tratamiento de datos
							personales</a></li>

				</ul>

			</div>

		</div>
	</div>
	<script>
		// Seleccionar el tercer elemento con la clase "mi-clase"
		const elementos = document.querySelectorAll('.sep');
		console.log(elementos);
		// Verificar si hay al menos tres elementos antes de intentar ocultar el tercero

		// Ocultar el tercer elemento (índice 2 en el array)
		elementos[2].style.display = 'none';

	</script>

	<div class="text-center copyright align-items-center justify-content-center py-2 px-2">
		<span class="">Copyright ©
			<?php echo date('Y') ?>
		</span> Corporación Club El Nogal Todos los derechos reservados
	</div>




</div>


<!-- <div class="derechos">
	<span>© 2020</span> Todos los Derechos Reservados Corporación Club El Nogal | Desarrollado por <a href="http://www.omegasolucionesweb.com" target="_blank" class="enlacered1">Omega Soluciones Web</a>
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