<style type="text/css">
	/* header .header-content nav ul li a {
		margin-top: 31px;
	} */

	/* header .header-content nav ul li:hover {
		background: none;
	}

	.enlace_externo span {
		font-size: 16px !important;
	}

	.enlace_externo {
		position: relative !important;
		top: -10px;
	}

	.enlace_externo a {
		margin-top: 0px !important;
	} */
</style>

<div class="header-redes">
	<div class="container">


	</div>
</div>
<?php
$hora = date("H:i:s");
$dia_semana = date("w");
$festivos = new festivos();
$es_festivo = 0;
if ($festivos->esFestivo(date("d"), date("m")) === true) {
	$es_festivo = 1;
}
if ($_GET['simular_hora'] != "") {
	$hora = $_GET['simular_hora'];
}

//horario express
$online2 = 0;
if ($es_festivo == 1 and $hora > $this->horario_festivo2->horario_hora1 and $hora <= $this->horario_festivo2->horario_hora2) {
	$online2 = 1;
}
foreach ($this->horarios2 as $key => $value) {
	if ($value->horario_fecha == "") {
		if ($dia_semana == $value->horario_dia and $es_festivo == 0 and $hora > $value->horario_hora1 and $hora <= $value->horario_hora2) {
			$online2 = 1;
		}
		if ($dia_semana == $value->horario_dia and $es_festivo == 1 and $hora > $value->horario_hora1 and $hora <= $value->horario_hora2) {
			$online2 = 1;
		}
	} else {
		if ($fecha == $value->horario_fecha) {
			$online2 = 0;
		}
		if ($fecha == $value->horario_fecha and $hora > $value->horario_hora1 and $hora <= $value->horario_hora2) {
			$online2 = 1;
		}
	}
}
?>
<div class="w-100 d-none d-lg-flex" style="height: 20px; ">
	<div class="w-50 " style="background:#333;">

	</div>
	<div class="w-50 " style="background:#2b5486;">

	</div>

</div>
<div class="header-content">

	<div class="container py-lg-2">
		<div class="row caja-info  d-none d-lg-flex ">
			<div class="col-md-2  caja-logo caja-borde">
				<a href="/page/index" class="redirect">
					<img src="/corte2/Logo_Nogal_En_Casa_Pagina.png" alt="logo nogal en casa" class="logo">
				</a>
				<div class="vr" style="margin-left: 38px;"></div>

			</div>
			<?php if ($_SESSION['kt_nombre']) { ?>
				<div class=" col-md-6   caja-borde">
					<nav class="nav-header">
						<ul class="">
							<li><a href="/" <?php echo $this->botonactivo == 1 ? 'class="active"' : '' ?>>Inicio</a></li>
							|
							<li><a href="#" data-bs-toggle="modal" data-bs-target="#comoComprar">¿Cómo comprar?</a></li>
							|
							<li><a href="/page/index/?favoritos=1" <?php echo $this->botonactivo == 3 ? 'class="active"' : '' ?>>Mis
									productos favoritos</a></li>
							|
							<li class="d-none"><a href="/page/comprar">Mis pedidos</a></li>
							<li class="d-none"><a href="/page/login/invitacion">Mis referidos</a></li>

							<li class="d-none"><a class="ver-carrito2">Carrito de Compras</a></li>

							<li class="d-none"><a href="/page/seguridadsanitaria">Seguridad sanitaria</a></li>

							<li class="d-none"><a href="/page/formulario">Contacto</a></li>

							<li class="nav-item">
								<form class="d-flex" method="post" action="/page/index/#a">
									<div class="input-group">
										<input class="form-control" type="search" name="buscar" value="<?php echo $_POST['buscar']; ?>"
											placeholder="Buscar" aria-label="Buscar">
										<input type="hidden" name="_csrf" value="<?php echo md5("OMEGA" . date('Ymd')); ?>">
										<button class="btn btn-outline-dark" type="submit">
											<i class="fa-solid fa-magnifying-glass"></i><!-- Icono de lupa de Bootstrap Icons -->
										</button>
									</div>
								</form>
							</li>
						</ul>
						<div class="vr"></div>

					</nav>


				</div>

				<div class="col-md-3 row ">

					<div class="col-12 d-lg-flex">
						<div class="col-6 d-flex align-items-end justify-content-center">

							<a href="/page/login/invitacion" class="referidos"> <img src="/corte/intercambiar.png" alt="">
								Mis referidos
							</a>
						</div>

						<div class="col-6 d-flex align-items-end">


							<div class="col-12  header-usuario">
								<span class=""> <i class="fas fa-user"></i>
									<?php if ($this->socio->socio_nombre != "") {
										echo $this->socio->socio_nombre;
									} else {
										echo $_SESSION['kt_nombre'];
									} ?>
								</span>
							</div>
						</div>

					</div>
					<div class="col-12 d-lg-flex ">
						<div class="col-6">
							<div class="col-12  header-sesion px-4 pt-1">
								<a href="/page/perfil/" class="btn btn-cerrar "><i class="fa-solid fa-user"></i>Perfil</a>
							</div>
						</div>
						<div class="col-6">
							<div class="col-12  header-sesion px-4 pt-1">
								<a href="/page/login/logout" class="btn btn-cerrar "><i class="fas fa-sign-out-alt"></i>Cerrar
									sesión</a>
							</div>
						</div>


					</div>






				</div>

			<?php } ?>
			<div class="col-md-1 d-flex justify-content-end">



				<div class="carrito">
					<a href="/page/compra" class="enlace-carrito">
						<div class="ver-carrito lateral absolute"></div>
					</a>
					<div class="carrito-cantidad absolute text-bold caja-info circle f-13 text-center cantidad"
						id="cantidad-total-items2"></div>



				</div>
			</div>




			<!-- 
			<div class="col-4 mt-5 d-block d-md-none">
				<div class="carrito ">
					<div class="ver-carrito lateral absolute mt-4"></div>
					<div class="carrito-cantidad absolute text-bold circle f-13 text-center cantidad" id="cantidad-total-items" style="margin-top: 1rem;"></div>
				</div>
			</div> -->

		</div>
	</div>


	<div class="row d-flex align-items-center ps-1  d-block d-lg-none ">
		<?php if (!$_SESSION['kt_nombre']) { ?>
			<div class="col-4 d-flex justify-content-center contenedor-logo ps-3">

				<img class="inline-block" src="/corte2/Logo_Nogal_En_Casa_Pagina.png" height="90" width="200">
			</div>
		<?php } ?>

		<?php if ($_SESSION['kt_nombre']) { ?>

			<div class="col-5 d-flex justify-content-center contenedor-logo ps-3">
				<a class="btn-menu text-left d-block d-lg-none navbar-toggle collapsed" data-toggle="collapse" data-target="#menu"
					aria-expanded="false">
					<i class="fas fa-bars fa-2x"></i>
				</a>
				<span>|</span>
				<a href="/page/index"><img class="inline-block" src="/corte2/Logo_Nogal_En_Casa_Pagina.png" height="90"
						width="200"></a>
			</div>

		<?php } ?>

		<?php if ($_SESSION['kt_nombre']) { ?>



			<div class="col-4 p-0 d-block d-lg-none ">

				<a href="/page/login/invitacion" class="referidos activo">
					<img src="/corte/intercambiar.png" alt="">
					Mis referidos
				</a>

			</div>




			<div class="col-2 d-flex justify-content-end p-0">



				<div class="carrito mt-2">
					<a href="/page/compra" class="enlace-carrito">
						<div class="ver-carrito lateral absolute"></div>
					</a>
					<div class="carrito-cantidad absolute text-bold circle f-13 text-center cantidad" id="cantidad-total-items">
					</div>



				</div>
			</div>

		<?php } ?>

		<!--RESPONSIVE-->
		<div class="botonera-resposive navbar-collapse col-md-8 col-xs-12 collapse in" id="menu" aria-expanded="true">
			<div class="container d-flex flex-column gap-4 p-4">



				<div class="d-flex align-items-center justify-content-between header-usuario">
					<span class="p-0">Bienvenido,
						<?php if ($this->socio->socio_nombre != "") {
							echo $this->socio->socio_nombre;
						} else {
							echo $_SESSION['kt_nombre'];
						} ?>
					</span>

					<a href="/page/perfil/" class="btn btn-cerrar "><i class="fa-solid fa-user"></i>Perfil</a>
				</div>

				<!-- <div class=" col-2 ">
						<a class="btn-menu navbar-toggle collapsed" data-toggle="collapse" data-target="#menu"
							aria-expanded="false"><i class="fa-regular fa-circle-xmark"></i></a>
					</div> -->

				<ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex flex-column gap-4 p-0">
					<li class="nav-item">

						<form class="w-100 d-flex align-items-center" method="post" action="/page/index/#a">
							<input class="form-control buscar" name="buscar" value="<?php echo $_POST['buscar']; ?>" type="search"
								placeholder="Buscar aquí" aria-label="Buscar">
							<input type="hidden" name="_csrf" value="<?php echo md5("OMAEGA" . date("Ymd")); ?>">
							<button class="btn btn-outline-dark " type="submit">
								<i class="fa-solid fa-magnifying-glass"></i><!-- Icono de lupa de Bootstrap Icons -->
							</button>
						</form>
					</li>





					<li class="nav-item">
						<a class="nav-link <?php echo $this->botonactivo == 1 ? 'active' : '' ?>" aria-current="page"
							href="/">Inicio</a>
					</li>
					<li class="nav-item">
						<a class="nav-link " href="#" data-bs-toggle="modal" data-bs-target="#comoComprar">¿Cómo
							comprar?</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?php echo $this->botonactivo == 3 ? 'active' : '' ?>"
							href="/page/index/?favoritos=1">Mis productos favoritos</a>
					</li>


					<div class="col-12  mt-1 d-flex align-items-start justify-content-start  header-sesion">
						<a href="/page/login/logout" class="btn btn-cerrar "><i class="fas fa-sign-out-alt"></i>Cerrar
							sesión</a>
					</div>

				</ul>
			</div>

			<table class="table table-striped d-none">
				<tbody>
					<tr>
						<td>
							<li class="item"><a href="/" rel="noopener noreferrer"><i class="fas fa-home"></i>
									Inicio</a></li>
						</td>
					</tr>
					<tr>
						<td>
							<li class="item"><a href="#" data-bs-toggle="modal" data-bs-target="#comoComprar"><i
										class="fas fa-shopping-bag"></i> ¿Cómo comprar?</a></li>
						</td>
					</tr>
					<tr>
						<td>
							<li class="item"><a href="/page/login/invitacion" rel="noopener noreferrer"><i class="fas fa-user"></i>
									Mis referidos</a></li>
						</td>
					</tr>
					<tr>
						<td>
							<li class="item"><a href="#" data-bs-toggle="modal" data-bs-target="#seguridadSanitaria"><i
										class="fas fa-lock"></i> Seguridad sanitaria</a></li>
						</td>
					</tr>

					<!-- <?php if ($online2 == 1) { ?>
						<tr>
							<td>
								<li class="item"><a href="https://express.clubelnogal.com/page/index/"
										rel="noopener noreferrer" style="color:#CDC82E"><i class="fas fa-door-open"></i> Ir
										a Restaurante Express</a></li>
							</td>
						</tr>
					<?php } else { ?>
						<tr>
							<td>
								<li class="item"><a href="https://express.clubelnogal.com/page/index/"
										rel="noopener noreferrer" style="color:#CDC82E"><i class="fas fa-door-open"></i> Ir
										a Restaurante Express</a></li>
							</td>
						</tr>
					<?php } ?> -->


					<!-- <?php if (1 == 1) { ?>
						<?php if ($hora < "16:00:00" and $hora >= "08:00:00" and $_GET['cerrado'] == "" or $_GET['abierto'] == "1" or 1 == 1) { ?>
							<tr>
								<td>
									<li class="item"><a href="https://cafeparis.clubelnogal.com/page/index/"
											rel="noopener noreferrer" style="color:#0094A3"><i class="fas fa-door-open"></i> Ir
											a Caf París Express</a></li>
								</td>
							</tr>
						<?php } else { ?>
							<tr>
								<td>
									<li class="item"><a href="https://cafeparis.clubelnogal.com/page/index/"
											rel="noopener noreferrer" style="color:#0094A3"><i class="fas fa-door-open"></i> Ir
											a Café París Express</a></li>
								</td>
							</tr>
						<?php } ?>
					<?php } ?> -->

					<tr>
						<td>
							<li class="item"><a href="/page/formulario" rel="noopener noreferrer"><i class="fas fa-headset"></i>
									Contacto</a></li>
						</td>
					</tr>
					<?php if ($_SESSION['kt_nombre']) { ?>
						<tr>
							<td>
								<div class="col-12 mx-0 px-0 header-usuario">
									<span> <i class="fas fa-user"></i>
										<?php if ($this->socio->socio_nombre != "") {
											echo $this->socio->socio_nombre;
										} else {
											echo $_SESSION['kt_nombre'];
										} ?>
									</span>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="col-12 w-50  mx-0 px-0 header-sesion">
									<a href="/page/login/logout" class="btn btn-cerrar " style="width: 117px;"><i
											class="fas fa-sign-out-alt"></i>Cerrar sesión</a>
								</div>
							</td>
						</tr>
					<?php } ?>

				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="comoComprar" tabindex="-1" aria-labelledby="comoComprarLabel" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-comprar">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="titulo-principal contact text-left">C&oacute;mo comprar</h2>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">

				<div class="container">

					<div class="row">
						<div class="col">
							<div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
								<?php foreach ($this->comoComprar as $paso) { ?>
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

					<?php echo $this->comprar; ?>
				</div>
			</div>
			<div class="modal-footer d-none">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>



<div class="loader-bx">
	<span class="loader"></span>
</div>
<style>
	.img-popup {
		max-height: 85dvh;
		object-fit: contain;
	}

	.loader-bx {
		display: none;
		position: fixed;
		width: 100vw;
		height: 100vh;
		background: rgba(0, 0, 0, .5);
		z-index: 99999;
		top: 0;
		left: 0;
		justify-content: center;
		align-items: center;
	}

	.loader-bx.show {
		display: flex;
	}

	.loader {
		width: 48px;
		height: 48px;
		display: block;
		margin: 15px auto;
		position: relative;
		color: #FFF;
		box-sizing: border-box;
		animation: rotation 1s linear infinite;
	}

	.loader::after,
	.loader::before {
		content: '';
		box-sizing: border-box;
		position: absolute;
		width: 24px;
		height: 24px;
		top: 50%;
		left: 50%;
		transform: scale(0.5) translate(0, 0);
		background-color: #FFF;
		border-radius: 50%;
		animation: animloader 1s infinite ease-in-out;
	}

	.loader::before {
		background-color: var(--verde);
		transform: scale(0.5) translate(-48px, -48px);
	}

	@keyframes rotation {
		0% {
			transform: rotate(0deg);
		}

		100% {
			transform: rotate(360deg);
		}
	}

	@keyframes animloader {
		50% {
			transform: scale(1) translate(-50%, -50%);
		}
	}
</style>