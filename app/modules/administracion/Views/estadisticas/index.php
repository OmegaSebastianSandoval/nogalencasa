<?php

function get_dates($sem)
{

	$week = $feini = $fefin = '';
	$fecha = (date('Y')) . '-01-01';   #declaro una fecha inicial 2018-01-04

	$week = date('W', strtotime($fecha));     #obtiene la primera semana del año

	while ($week != $sem) {  #mientras la semana obtenida sea diferente de la solicitada

		$fecha = date('Y-m-d', strtotime('+7 days', strtotime($fecha)));  #suma 7 das a la fecha anterior
		$week = date('W', strtotime($fecha)); #Obtiene la semana de la nueva fecha

	}    #cuando encuentra la semana solicitada, separa el año, mes y día

	$day = date('d', strtotime($fecha));
	$month = date('m', strtotime($fecha));
	$year = date('Y', strtotime($fecha));

	$nuevaFecha = mktime(0, 0, 0, $month, $day, $year);  #Ingresa la fecha separada a mktime
	$weekDay = date("w", $nuevaFecha);

	$nuevaFecha = $nuevaFecha - ($weekDay * 24 * 3600); //Restar los segundos totales de los dias transcurridos de la semana

	$feini = date("Y-m-d", strtotime('+1 days', $nuevaFecha));  #obtiene el da inicial de la semana solicitada
	$fefin = date("Y-m-d", strtotime('+7 days', ($nuevaFecha)));  #Obtiene el día final de la siguiente semana solicitada

	$fechas = array("feini" => $feini, "fefin" => $fefin);  #guardo ambas en un array

	//return $fechas; #Retorno el array
	return $sem . " (" . fecha_letras($feini) . " - " . fecha_letras($fefin) . ")";
}

function get_mes($sem)
{

	$week = $feini = $fefin = '';
	$fecha = (date('Y')) . '-01-01';   #declaro una fecha inicial 2018-01-04

	$week = date('W', strtotime($fecha));     #obtiene la primera semana del año

	while ($week != $sem) {  #mientras la semana obtenida sea diferente de la solicitada

		$fecha = date('Y-m-d', strtotime('+7 days', strtotime($fecha)));  #suma 7 días a la fecha anterior
		$week = date('W', strtotime($fecha)); #Obtiene la semana de la nueva fecha

	}    #cuando encuentra la semana solicitada, separa el año, mes y día

	$day = date('d', strtotime($fecha));
	$month = date('m', strtotime($fecha));
	$year = date('Y', strtotime($fecha));

	$nuevaFecha = mktime(0, 0, 0, $month, $day, $year);  #Ingresa la fecha separada a mktime
	$weekDay = date("w", $nuevaFecha);

	$nuevaFecha = $nuevaFecha - ($weekDay * 24 * 3600); //Restar los segundos totales de los dias transcurridos de la semana

	$feini = date("Y-m-d", strtotime('+1 days', $nuevaFecha));  #obtiene el día inicial de la semana solicitada
	$fefin = date("Y-m-d", strtotime('+7 days', ($nuevaFecha)));  #Obtiene el día final de la siguiente semana solicitada

	$fechas = array("feini" => $feini, "fefin" => $fefin);  #guardo ambas en un array

	$aux = explode("-", $feini);
	$mes = $aux[0] . "-" . $aux[1];

	//return $fechas; #Retorno el array
	return $mes;
}

function fecha_letras($fecha)
{
	$aux = explode("-", $fecha);
	$meses = array("", "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
	$mes = $meses[$aux[1] * 1];
	return $mes . " " . $aux[2];
}

?>



<style>
	.tabla1 {
		background-color: #FFFFFF;
		font-size: 14px;
		border: hidden;
	}

	.tabla1 tr,
	.tabla1 th,
	.tabla1 td {
		border: hidden;
	}

	.tabla1 tr {
		line-height: 30px;
	}

	.tabla1 tr:nth-child(even) {
		background-color: #F6F6F6;
	}

	.tabla1 tr:nth-child(odd) {
		background-color: #FFFFFF;
	}

	.fondo_blanco {
		background-color: #FFFFFF;
		border-radius: 10px;
		padding: 10px;
		/* margin-left: 10px; */
		width: 100%;
		box-shadow: var(--bs-box-shadow-sm) !important;
	}

	.tabla1 th {
		background-color: black;
		color: #FFFFFF;
		line-height: 30px;
	}

	.bold {
		font-weight: bold;
	}

	.table-container {
		max-height: 500px;
		overflow-y: auto;
	}

	.tabla1 tr:first-child th {
		position: sticky;
		top: 0;
		background-color: black;
		z-index: 1;
	}

	h2 {
		font-size: 20px;
		font-weight: 600;
		color: #646464;
	}
</style>

<div class="container-fluid d-flex flex-column align-items-center gap-3 mb-3">
	<div class="fondo_blanco">
		<form method="get" action="">
			<div class="row mt-3 align-items-end">
				<div class="col-lg-3">
					<label for="fecha1" class="form-label fw-bold">Fecha inicial</label>
					<input type="date" id="fecha1" name="fecha1" value="<?php echo $_GET['fecha1']; ?>"
						placeholder="Fecha inicial" class="form-control">
				</div>
				<div class="col-lg-3">
					<label for="fecha2" class="form-label fw-bold">Fecha final</label>
					<input type="date" id="fecha2" name="fecha2" value="<?php echo $_GET['fecha2']; ?>" placeholder="Fecha final"
						class="form-control">
				</div>
				<div class="col-lg-3">
					<button type="submit" class="btn btn-primary w-100">
						<i class="fas fa-filter"></i> Filtrar
					</button>
				</div>
			</div>
		</form>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<div id="todo13" class="container-fluid fondo_blanco row g-0">
		<h2>Facturación semanal</h2>
		<div id="tabla13" class="col-12 col-lg-6 table-container">
			<table width="100%" border="1" cellpadding="5" cellspacing="0" class="tabla1">
				<tr>
					<th>Semana</th>
					<th>
						<div align="center">Facturación
					</th>
					<th>
						<div align="center">Acciones
					</th>
				</tr>
				<?php foreach ($this->semanas as $fecha): ?>
					<?php
					$mes = get_mes($fecha);
					$total = (int) $this->totales["facturacion_S" . $fecha];
					$Total += $total;

					if ($total > 0) {
					?>
						<tr>
							<td><?php echo get_dates($fecha); ?></td>
							<td>
								<div align="center">$<?php echo number_format($total); ?></div>
							</td>
							<td>
								<div align="center"><button class="btn btn-info btn-sm" onclick="showModal(<?php echo $fecha; ?>)">Ver
										Pedidos</button></div>
							</td>
						</tr>
					<?php } ?>
				<?php endforeach ?>
				<tr>
					<td class="bold">Total</td>
					<td class="bold">
						<div align="center">$<?php echo number_format($Total); ?></div>
					</td>
					<td class="bold">
						<div align="center">-</div>
					</td>
				</tr>
			</table>
		</div>

		<div id="chart12" class="mb-2 col-12 col-lg-6 " style="position: relative;">
			<h2 class="mt-4 titulo1" style="display: none;">Facturación semanal</h2>
			<button class="btn btn-outline-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;" onclick="openFullscreenChart('eficiencia')">🔍 Ver gráfica</button>
			<canvas id="chart_eficiencia" style="width: 100%; height: 400px;"></canvas>
		</div>

		<script>
			const ctx = document.getElementById('chart_eficiencia').getContext('2d');

			<?php
			$labels = [];
			$dataFacturacion = [];
			foreach ($this->semanas as $key => $fecha) {
				$fact = (int) $this->totales["facturacion_S" . $fecha];
				if ($fact > 0) {
					$labels[] = $fecha;
					$dataFacturacion[] = round($fact / 1000000, 2);
				}
			}
			?>

			const labels = <?php echo json_encode($labels); ?>;
			const dataFacturacion = <?php echo json_encode($dataFacturacion); ?>;

			let chartType = 'line';
			<?php
			if ($_GET['tipo'] == "") {
				echo "chartType = 'line';";
			}
			if ($_GET['tipo'] == "2") {
				echo "chartType = 'scatter';";
			}
			if ($_GET['tipo'] == "3") {
				echo "chartType = 'bar';";
			}
			if ($_GET['tipo'] == "4") {
				echo "chartType = 'pie';";
			}
			?>

			let dataConfig = {
				labels: labels,
				datasets: [{
					label: 'Facturación (millones)',
					data: dataFacturacion,
					borderColor: 'rgb(75, 192, 192)',
					backgroundColor: 'rgba(75, 192, 192, 0.2)',
				}]
			};

			if (chartType === 'scatter') {
				dataConfig.datasets[0].data = dataFacturacion.map((v, i) => ({
					x: i + 1,
					y: v
				}));
				dataConfig.labels = [];
			} else if (chartType === 'pie') {
				dataConfig.datasets[0].backgroundColor = [
					'rgba(255, 99, 132, 0.2)',
					'rgba(54, 162, 235, 0.2)',
					'rgba(255, 205, 86, 0.2)',
					'rgba(75, 192, 192, 0.2)',
					'rgba(153, 102, 255, 0.2)',
					'rgba(255, 159, 64, 0.2)'
				];
				dataConfig.datasets[0].borderColor = [
					'rgba(255, 99, 132, 1)',
					'rgba(54, 162, 235, 1)',
					'rgba(255, 205, 86, 1)',
					'rgba(75, 192, 192, 1)',
					'rgba(153, 102, 255, 1)',
					'rgba(255, 159, 64, 1)'
				];
			}

			let options = {
				responsive: true,
				plugins: {
					title: {
						display: true,
						text: 'Facturación semanal'
					}
				}
			};

			if (chartType !== 'pie') {
				options.scales = {
					y: {
						beginAtZero: true,
						title: {
							display: true,
							text: 'Facturación (millones)'
						}
					},
					x: {
						title: {
							display: true,
							text: 'Semana'
						}
					}
				};
			}

			const config = {
				type: chartType,
				data: dataConfig,
				options: options
			};

			new Chart(ctx, config);
		</script>

		<!-- Modal -->
		<div class="modal fade" id="pedidosModal" tabindex="-1" aria-labelledby="pedidosModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="pedidosModalLabel">Pedidos de la Semana</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body" id="modalBody">
						<!-- Contenido dinámico -->
					</div>
				</div>
			</div>
		</div>

		<script>
			function showModal(semana) {
				let pedidos = <?php echo json_encode($this->pedidos_por_semana); ?>;
				let html = '<table class="table table-striped"><thead><tr><th>ID Pedido</th><th>Fecha</th><th>Valor</th><th>Documento</th></tr></thead><tbody>';
				if (pedidos[semana]) {
					pedidos[semana].forEach(pedido => {
						html += `<tr><td>${pedido.pedido_id}</td><td>${pedido.pedido_fecha}</td><td>$${number_format(pedido.pedido_valorpagar)}</td><td>${pedido.pedido_documento}</td></tr>`;
					});
				} else {
					html += '<tr><td colspan="4">No hay pedidos para esta semana.</td></tr>';
				}
				html += '</tbody></table>';
				document.getElementById('modalBody').innerHTML = html;
				new bootstrap.Modal(document.getElementById('pedidosModal')).show();
			}

			function number_format(number) {
				return new Intl.NumberFormat().format(number);
			}
		</script>
	</div>


	<div class="container-fluid mt-4 fondo_blanco">
		<?php echo $this->getRoutPHP('modules/administracion/Views/estadisticas/abandonados.php'); ?>
	</div>

	<div class="container-fluid mt-4 fondo_blanco">
		<?php echo $this->getRoutPHP('modules/administracion/Views/estadisticas/clientes.php'); ?>
	</div>


	<!-- Gráfica de facturación por día -->
	<div class="container-fluid mt-4 fondo_blanco row g-0">
		<h2>Facturación por día</h2>
		<div id="tabla_dias" class="col-12 col-lg-6 table-container">
			<table width="100%" border="1" cellpadding="5" cellspacing="0" class="tabla1">
				<tr>
					<th>Día</th>
					<th>
						<div align="center">Facturación</div>
					</th>
					<th>
						<div align="center">Cantidad de pedidos</div>
					</th>
				</tr>
				<?php
				foreach ($this->facturacion_por_dia as $dia => $valor):
				?>
					<tr<?php if ($dia == $this->dia_mayor_venta) echo ' style="background-color:#ffeeba;font-weight:bold;"'; ?>>
						<td><?php echo $dia; ?><?php if ($dia == $this->dia_mayor_venta) echo ' <span style="color:#d9534f;">★</span>'; ?></td>
						<td>
							<div align="center">$<?php echo number_format($valor); ?></div>
						</td>
						<td>
							<div align="center"><?php echo isset($this->pedidos_por_dia[$dia]) ? $this->pedidos_por_dia[$dia] : 0; ?></div>
						</td>
						</tr>
					<?php endforeach; ?>
			</table>
		</div>
		<div id="chart_dias" class="mb-2 col-12 col-lg-6" style="position: relative;">
			<h2 class="mt-4 titulo1" style="display: none;">Facturación por día</h2>
			<button class="btn btn-outline-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;" onclick="openFullscreenChart('dias')">🔍 Ver gráfica</button>
			<canvas id="chart_dias_canvas" style="width: 100%; height: 400px;"></canvas>
		</div>
		<script>
			const ctx_dias = document.getElementById('chart_dias_canvas').getContext('2d');
			<?php
			$labels_dias = array_keys($this->facturacion_por_dia);
			$data_dias = array_values($this->facturacion_por_dia);
			$data_pedidos = array();
			foreach ($labels_dias as $dia) {
				$data_pedidos[] = isset($this->pedidos_por_dia[$dia]) ? $this->pedidos_por_dia[$dia] : 0;
			}
			?>
			const labels_dias = <?php echo json_encode($labels_dias); ?>;
			const data_dias = <?php echo json_encode($data_dias); ?>;
			const data_pedidos = <?php echo json_encode($data_pedidos); ?>;
			const dia_mayor_venta = <?php echo json_encode($this->dia_mayor_venta); ?>;
			const valor_mayor_venta = <?php echo json_encode($this->valor_mayor_venta); ?>;

			let dataConfig_dias = {
				labels: labels_dias,
				datasets: [{
						label: 'Facturación por día',
						data: data_dias,
						backgroundColor: labels_dias.map(d => d === dia_mayor_venta ? 'rgba(255, 193, 7, 0.6)' : 'rgba(54, 162, 235, 0.2)'),
						borderColor: labels_dias.map(d => d === dia_mayor_venta ? 'rgba(255, 193, 7, 1)' : 'rgba(54, 162, 235, 1)'),
						borderWidth: 2,
						yAxisID: 'y',
					},
					{
						label: 'Cantidad de pedidos',
						data: data_pedidos,
						backgroundColor: 'rgba(40, 167, 69, 0.2)',
						borderColor: 'rgba(40, 167, 69, 1)',
						borderWidth: 2,
						type: 'line',
						yAxisID: 'y1',
					}
				]
			};

			let options_dias = {
				responsive: true,
				plugins: {
					title: {
						display: true,
						text: 'Facturación y cantidad de pedidos por día'
					},
				},
				scales: {
					x: {
						title: {
							display: true,
							text: 'Día'
						}
					},
					y: {
						beginAtZero: true,
						title: {
							display: true,
							text: 'Facturación ($)'
						}
					},
					y1: {
						beginAtZero: true,
						position: 'right',
						title: {
							display: true,
							text: 'Cantidad de pedidos'
						}
					},
				}
			};

			const config_dias = {
				type: 'bar',
				data: dataConfig_dias,
				options: options_dias
			};

			new Chart(ctx_dias, config_dias);
		</script>
	</div>
	<div class="container-fluid mt-4 fondo_blanco row g-0">
		<h2>Productos más vendidos</h2>
		<div id="tabla_productos" class="col-12 col-lg-6 table-container">
			<table width="100%" border="1" cellpadding="5" cellspacing="0" class="tabla1">
				<tr>
					<th>Producto</th>
					<th>
						<div align="center">Cantidad vendida
					</th>
				</tr>
				<?php
				// echo '<pre>';
				// print_r($this->productos_vendidos);
				// echo '</pre>';
				foreach ($this->productos_vendidos as $prod):
					$nombre = $prod['nombre'];
					$cantidad = $prod['cantidad'];
				?>
					<tr>
						<td><?php echo $nombre; ?></td>
						<td>
							<div align="center"><?php echo number_format($cantidad); ?></div>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>

		<div id="chart_productos" class="mb-2 col-12 col-lg-6" style="position: relative;">
			<h2 class="mt-4 titulo1" style="display: none;">Productos más vendidos</h2>
			<button class="btn btn-outline-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;" onclick="openFullscreenChart('productos')">🔍 Ver gráfica</button>
			<canvas id="chart_productos_canvas" style="width: 100%; height: 400px;"></canvas>
		</div>

		<script>
			const ctx_productos = document.getElementById('chart_productos_canvas').getContext('2d');

			<?php
			$labels_productos = [];
			$data_productos = [];
			foreach ($this->productos_vendidos as $prod) {
				$labels_productos[] = $prod['nombre'];
				$data_productos[] = $prod['cantidad'];
			}
			?>

			const labels_productos = <?php echo json_encode($labels_productos); ?>;
			const data_productos = <?php echo json_encode($data_productos); ?>;

			let chartType_productos = 'bar';

			let dataConfig_productos = {
				labels: labels_productos,
				datasets: [{
					label: 'Cantidad vendida',
					data: data_productos,
					borderColor: 'rgb(153, 102, 255)',
					backgroundColor: 'rgb(153, 102, 255)',
				}]
			};

			let options_productos = {
				indexAxis: 'y',
				responsive: true,
				plugins: {
					title: {
						display: true,
						text: 'Productos más vendidos'
					}
				},
				scales: {
					x: {
						beginAtZero: true,
						title: {
							display: true,
							text: 'Cantidad'
						}
					},
					y: {
						position: 'right',
						title: {
							display: true,
							text: 'Producto'
						}
					}
				}
			};

			const config_productos = {
				type: chartType_productos,
				data: dataConfig_productos,
				options: options_productos
			};

			new Chart(ctx_productos, config_productos);
		</script>
	</div>

	<div class="container-fluid mt-4 fondo_blanco row g-0">
		<h2>Personas que más compran</h2>
		<div id="tabla_compradores" class="col-12 col-lg-6 table-container">
			<table width="100%" border="1" cellpadding="5" cellspacing="0" class="tabla1">
				<tr>
					<th>Documento</th>
					<th>Nombre</th>
					<th>
						<div align="center">Total comprado
					</th>
				</tr>
				<?php
				foreach ($this->compradores_vendidos as $comp):
					$documento = $comp['documento'];
					$total = $comp['total'];
					$nombre_completo = trim($comp['nombre'] . ' ' . $comp['apellido']);
				?>
					<tr>
						<td><?php echo $documento; ?></td>
						<td><?php echo !empty($nombre_completo) ? $nombre_completo : 'N/A'; ?></td>
						<td>
							<div align="center">$<?php echo number_format($total); ?></div>
						</td>
					</tr>
				<?php endforeach; ?>
			</table>
		</div>

		<div id="chart_compradores" class="mb-2 col-12 col-lg-6" style="position: relative;">
			<h2 class="mt-4 titulo1" style="display: none;">Personas que más compran</h2>
			<button class="btn btn-outline-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;" onclick="openFullscreenChart('compradores')">🔍 Ver gráfica</button>
			<canvas id="chart_compradores_canvas" style="width: 100%; height: 400px;"></canvas>
		</div>

		<script>
			const ctx_compradores = document.getElementById('chart_compradores_canvas').getContext('2d');

			<?php
			$labels_compradores = [];
			$data_compradores = [];
			foreach ($this->compradores_vendidos as $comp) {
				$nombre_completo = trim($comp['nombre'] . ' ' . $comp['apellido']);
				$label = !empty($nombre_completo) ? $nombre_completo : $comp['documento'];
				$labels_compradores[] = $label;
				$data_compradores[] = $comp['total'];
			}
			?>
			const labels_compradores = <?php echo json_encode($labels_compradores); ?>;
			const data_compradores = <?php echo json_encode($data_compradores); ?>;

			let chartType_compradores = 'bar';

			let dataConfig_compradores = {
				labels: labels_compradores,
				datasets: [{
					label: 'Total comprado',
					data: data_compradores,
					borderColor: 'rgb(255, 159, 64)',
					backgroundColor: 'rgb(255, 159, 64)',
				}]
			};

			let options_compradores = {
				indexAxis: 'y',
				responsive: true,
				plugins: {
					title: {
						display: true,
						text: 'Personas que más compran'
					}
				},
				scales: {
					x: {
						beginAtZero: true,
						title: {
							display: true,
							text: 'Total ($)'
						}
					},
					y: {
						position: 'right',
						title: {
							display: true,
							text: 'Documento'
						}
					}
				}
			};

			const config_compradores = {
				type: chartType_compradores,
				data: dataConfig_compradores,
				options: options_compradores
			};

			new Chart(ctx_compradores, config_compradores);
		</script>

		<!-- Modals for fullscreen charts -->
		<div class="modal fade" id="modal_eficiencia" tabindex="-1" aria-labelledby="modalEficienciaLabel" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalEficienciaLabel">Facturación semanal</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<canvas id="modal_chart_eficiencia"></canvas>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal_dias" tabindex="-1" aria-labelledby="modalDiasLabel" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalDiasLabel">Facturación y cantidad de pedidos por día</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<canvas id="modal_chart_dias"></canvas>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal_productos" tabindex="-1" aria-labelledby="modalProductosLabel" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalProductosLabel">Productos más vendidos</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<canvas id="modal_chart_productos"></canvas>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal_compradores" tabindex="-1" aria-labelledby="modalCompradoresLabel" aria-hidden="true">
			<div class="modal-dialog modal-fullscreen">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalCompradoresLabel">Personas que más compran</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<canvas id="modal_chart_compradores"></canvas>
					</div>
				</div>
			</div>
		</div>

		<script>
			function openFullscreenChart(type) {
				if (type === 'eficiencia') {
					const modal = new bootstrap.Modal(document.getElementById('modal_eficiencia'));
					modal.show();
					// Recrear la gráfica
					const modalCtx = document.getElementById('modal_chart_eficiencia').getContext('2d');
					let modalDataConfig = {
						labels: labels,
						datasets: [{
							label: 'Facturación (millones)',
							data: dataFacturacion,
							borderColor: 'rgb(75, 192, 192)',
							backgroundColor: 'rgba(75, 192, 192, 0.2)',
						}]
					};
					if (chartType === 'scatter') {
						modalDataConfig.datasets[0].data = dataFacturacion.map((v, i) => ({
							x: i + 1,
							y: v
						}));
						modalDataConfig.labels = [];
					} else if (chartType === 'pie') {
						modalDataConfig.datasets[0].backgroundColor = [
							'rgba(255, 99, 132, 0.2)',
							'rgba(54, 162, 235, 0.2)',
							'rgba(255, 205, 86, 0.2)',
							'rgba(75, 192, 192, 0.2)',
							'rgba(153, 102, 255, 0.2)',
							'rgba(255, 159, 64, 0.2)'
						];
						modalDataConfig.datasets[0].borderColor = [
							'rgba(255, 99, 132, 1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 205, 86, 1)',
							'rgba(75, 192, 192, 1)',
							'rgba(153, 102, 255, 1)',
							'rgba(255, 159, 64, 1)'
						];
					}
					let modalOptions = {
						responsive: true,
						plugins: {
							title: {
								display: true,
								text: 'Facturación semanal'
							}
						}
					};
					if (chartType !== 'pie') {
						modalOptions.scales = {
							y: {
								beginAtZero: true,
								title: {
									display: true,
									text: 'Facturación (millones)'
								}
							},
							x: {
								title: {
									display: true,
									text: 'Semana'
								}
							}
						};
					}
					new Chart(modalCtx, {
						type: chartType,
						data: modalDataConfig,
						options: modalOptions
					});
				} else if (type === 'dias') {
					const modal = new bootstrap.Modal(document.getElementById('modal_dias'));
					modal.show();
					const modalCtx = document.getElementById('modal_chart_dias').getContext('2d');
					let modalDataConfig = {
						labels: labels_dias,
						datasets: [{
								label: 'Facturación por día',
								data: data_dias,
								backgroundColor: labels_dias.map(d => d === dia_mayor_venta ? 'rgba(255, 193, 7, 0.6)' : 'rgba(54, 162, 235, 0.2)'),
								borderColor: labels_dias.map(d => d === dia_mayor_venta ? 'rgba(255, 193, 7, 1)' : 'rgba(54, 162, 235, 1)'),
								borderWidth: 2,
								yAxisID: 'y',
							},
							{
								label: 'Cantidad de pedidos',
								data: data_pedidos,
								backgroundColor: 'rgba(40, 167, 69, 0.2)',
								borderColor: 'rgba(40, 167, 69, 1)',
								borderWidth: 2,
								type: 'line',
								yAxisID: 'y1',
							}
						]
					};
					let modalOptions = {
						responsive: true,
						plugins: {
							title: {
								display: true,
								text: 'Facturación y cantidad de pedidos por día'
							},
						},
						scales: {
							x: {
								title: {
									display: true,
									text: 'Día'
								}
							},
							y: {
								beginAtZero: true,
								title: {
									display: true,
									text: 'Facturación ($)'
								}
							},
							y1: {
								beginAtZero: true,
								position: 'right',
								title: {
									display: true,
									text: 'Cantidad de pedidos'
								}
							},
						}
					};
					new Chart(modalCtx, {
						type: 'bar',
						data: modalDataConfig,
						options: modalOptions
					});
				} else if (type === 'productos') {
					const modal = new bootstrap.Modal(document.getElementById('modal_productos'));
					modal.show();
					const modalCtx = document.getElementById('modal_chart_productos').getContext('2d');
					let modalDataConfig = {
						labels: labels_productos,
						datasets: [{
							label: 'Cantidad vendida',
							data: data_productos,
							borderColor: 'rgb(153, 102, 255)',
							backgroundColor: 'rgba(153, 102, 255)',
						}]
					};
					let modalOptions = {
						indexAxis: 'y',
						responsive: true,
						plugins: {
							title: {
								display: true,
								text: 'Productos más vendidos'
							}
						},
						scales: {
							x: {
								beginAtZero: true,
								title: {
									display: true,
									text: 'Cantidad'
								}
							},
							y: {
								position: 'right',
								title: {
									display: true,
									text: 'Producto'
								}
							}
						}
					};
					new Chart(modalCtx, {
						type: 'bar',
						data: modalDataConfig,
						options: modalOptions
					});
				} else if (type === 'compradores') {
					const modal = new bootstrap.Modal(document.getElementById('modal_compradores'));
					modal.show();
					const modalCtx = document.getElementById('modal_chart_compradores').getContext('2d');
					let modalDataConfig = {
						labels: labels_compradores,
						datasets: [{
							label: 'Total comprado',
							data: data_compradores,
							borderColor: 'rgb(255, 159, 64)',
							backgroundColor: 'rgba(255, 159, 64)',
						}]
					};
					let modalOptions = {
						indexAxis: 'y',
						responsive: true,
						plugins: {
							title: {
								display: true,
								text: 'Personas que más compran'
							}
						},
						scales: {
							x: {
								beginAtZero: true,
								title: {
									display: true,
									text: 'Total ($)'
								}
							},
							y: {
								position: 'right',
								title: {
									display: true,
									text: 'Documento'
								}
							}
						}
					};
					new Chart(modalCtx, {
						type: 'bar',
						data: modalDataConfig,
						options: modalOptions
					});
				}
			}
		</script>
	</div>
</div>