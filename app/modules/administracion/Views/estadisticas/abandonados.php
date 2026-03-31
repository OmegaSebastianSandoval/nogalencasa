<?php
$Total = 0;
$Total2 = 0;
?>

<div id="todo13" class="container-fluid row  g-0">
	<h2 >Pedidos vs Carritos abandonados</h2>
	<div id="tabla13" class="col-12 col-lg-6 table-container">
		<table width="100%" border="1" cellpadding="5" cellspacing="0" class="tabla1">
			<tr>
				<th>Semana</th>
				<th>
					<div align="center">Pedidos
				</th>
				<th>
					<div align="center">Carritos abandonados
				</th>
			</tr>
			<?php foreach ($this->semanas as $fecha): ?>
				<?php
				$mes = get_mes($fecha);
				$total = (int) $this->totales["pedidos_S" . $fecha];
				$total2 = (int) $this->totales["abandonados_S" . $fecha];

				$Total += $total;
				$Total2 += $total2;
				?>
				<tr>
					<td><?php echo get_dates($fecha); ?></td>
					<td>
						<div align="center"><?php echo number_format($total); ?></div>
					</td>
					<td>
						<div align="center"><?php echo number_format($total2); ?></div>
					</td>
				</tr>
			<?php endforeach ?>
			<tr>
				<td class="bold">Total</td>
				<td class="bold">
					<div align="center"><?php echo number_format($Total); ?></div>
				</td>
				<td class="bold">
					<div align="center"><?php echo number_format($Total2); ?></div>
				</td>
			</tr>
		</table>
	</div>

	<div id="chart12" class="mb-2 col-12 col-lg-6" style="position: relative;">
		<h2 class="mt-4 titulo1" style="display: none;">Pedidos vs Carritos abandonados</h2>
		<button class="btn btn-outline-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;" onclick="openFullscreenChartAbandonados()">🔍 Ver gráfica</button>
		<canvas id="chart_abandonados" style="width: 100%; height: 400px;"></canvas>
	</div>

	<script>
		const ctx_abandonados = document.getElementById('chart_abandonados').getContext('2d');

		<?php
		$labels = [];
		$pedidos = [];
		$abandonados = [];
		$x = 1;
		foreach ($this->semanas as $key => $fecha) {
			$valor = (int) $this->totales["pedidos_S" . $fecha];
			$valor2 = (int) $this->totales["abandonados_S" . $fecha];
			if ($valor >= 0) {
				$labels[] = $fecha;
				$pedidos[] = $valor;
				$abandonados[] = $valor2;
				$x++;
			} else {
				$x++;
			}
		}
		?>

		const labels_abandonados = <?php echo json_encode($labels); ?>;
		const pedidosData = <?php echo json_encode($pedidos); ?>;
		const abandonadosData = <?php echo json_encode($abandonados); ?>;

		let chartType_abandonados = 'line';
		<?php
		if ($_GET['tipo'] == "") {
			echo "chartType_abandonados = 'line';";
		}
		if ($_GET['tipo'] == "2") {
			echo "chartType_abandonados = 'scatter';";
		}
		if ($_GET['tipo'] == "3") {
			echo "chartType_abandonados = 'bar';";
		}
		if ($_GET['tipo'] == "4") {
			echo "chartType_abandonados = 'pie';";
		}
		?>

		let dataConfig_abandonados = {
			labels: labels_abandonados,
			datasets: [{
				label: 'Pedidos',
				data: pedidosData,
				borderColor: 'rgb(75, 192, 192)',
				backgroundColor: 'rgba(75, 192, 192, 0.2)',
			}, {
				label: 'Carritos abandonados',
				data: abandonadosData,
				borderColor: 'rgb(255, 99, 132)',
				backgroundColor: 'rgba(255, 99, 132, 0.2)',
			}]
		};

		if (chartType_abandonados === 'scatter') {
			dataConfig_abandonados.datasets[0].data = pedidosData.map((v, i) => ({
				x: i + 1,
				y: v
			}));
			dataConfig_abandonados.datasets[1].data = abandonadosData.map((v, i) => ({
				x: i + 1,
				y: v
			}));
			dataConfig_abandonados.labels = [];
		} else if (chartType_abandonados === 'pie') {
			// For pie, maybe combine or something, but since two datasets, perhaps not ideal, but keep as line
			chartType_abandonados = 'line'; // fallback
		}

		let options_abandonados = {
			responsive: true,
			plugins: {
				title: {
					display: true,
					text: 'Pedidos vs Carritos abandonados'
				}
			}
		};

		if (chartType_abandonados !== 'pie') {
			options_abandonados.scales = {
				y: {
					beginAtZero: true,
					title: {
						display: true,
						text: 'Totales'
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

		const config_abandonados = {
			type: chartType_abandonados,
			data: dataConfig_abandonados,
			options: options_abandonados
		};

		new Chart(ctx_abandonados, config_abandonados);
	</script>

	<!-- Modal for fullscreen chart -->
	<div class="modal fade" id="modal_abandonados" tabindex="-1" aria-labelledby="modalAbandonadosLabel" aria-hidden="true">
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalAbandonadosLabel">Pedidos vs Carritos abandonados</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<canvas id="modal_chart_abandonados"></canvas>
				</div>
			</div>
		</div>
	</div>

	<script>
		function openFullscreenChartAbandonados() {
			const modal = new bootstrap.Modal(document.getElementById('modal_abandonados'));
			modal.show();
			const modalCtx = document.getElementById('modal_chart_abandonados').getContext('2d');
			let modalDataConfig = {
				labels: labels_abandonados,
				datasets: [{
					label: 'Pedidos',
					data: pedidosData,
					borderColor: 'rgb(75, 192, 192)',
					backgroundColor: 'rgba(75, 192, 192, 0.2)',
				}, {
					label: 'Carritos abandonados',
					data: abandonadosData,
					borderColor: 'rgb(255, 99, 132)',
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
				}]
			};
			if (chartType_abandonados === 'scatter') {
				modalDataConfig.datasets[0].data = pedidosData.map((v, i) => ({
					x: i + 1,
					y: v
				}));
				modalDataConfig.datasets[1].data = abandonadosData.map((v, i) => ({
					x: i + 1,
					y: v
				}));
				modalDataConfig.labels = [];
			} else if (chartType_abandonados === 'pie') {
				chartType_abandonados = 'line'; // fallback
			}
			let modalOptions = {
				responsive: true,
				plugins: {
					title: {
						display: true,
						text: 'Pedidos vs Carritos abandonados'
					}
				}
			};
			if (chartType_abandonados !== 'pie') {
				modalOptions.scales = {
					y: {
						beginAtZero: true,
						title: {
							display: true,
							text: 'Totales'
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
				type: chartType_abandonados,
				data: modalDataConfig,
				options: modalOptions
			});
		}
	</script>
</div>

