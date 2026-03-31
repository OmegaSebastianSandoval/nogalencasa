<?php
$Total = 0;
$Total2 = 0;
?>

<div id="todo13" class="container-fluid row g-0">
	<h2 >Clientes nuevos vs Clientes recurrentes</h2>
	<div id="tabla13" class="table-container col-12 col-lg-6">
		<table width="100%" border="1" cellpadding="5" cellspacing="0" class="tabla1">
			<tr>
				<th>Semana</th>
				<th>
					<div align="center">Clientes nuevos
				</th>
				<th>
					<div align="center">Clientes recurrentes
				</th>
			</tr>
			<?php foreach ($this->semanas as $fecha): ?>
				<?php
				$mes = get_mes($fecha);
				$total = (int) $this->totales["clientes_nuevos_S" . $fecha];
				$total2 = (int) $this->totales["clientes_recurrentes_S" . $fecha];

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
		<h2 class="mt-4 titulo1" style="display: none;">Clientes nuevos vs Clientes recurrentes</h2>
		<button class="btn btn-outline-primary btn-sm" style="position: absolute; top: 10px; right: 10px; z-index: 10;" onclick="openFullscreenChartClientes()">🔍 Ver gráfica</button>
		<canvas id="chart_clientes" style="width: 100%; height: 400px;"></canvas>
	</div>

	<script>
		const ctx_clientes = document.getElementById('chart_clientes').getContext('2d');

		<?php
		$labels = [];
		$nuevos = [];
		$recurrentes = [];
		$x = 1;
		foreach ($this->semanas as $key => $fecha) {
			$valor = (int) $this->totales["clientes_nuevos_S" . $fecha];
			$valor2 = (int) $this->totales["clientes_recurrentes_S" . $fecha];
			if ($valor >= 0) {
				$labels[] = $fecha;
				$nuevos[] = $valor;
				$recurrentes[] = $valor2;
				$x++;
			} else {
				$x++;
			}
		}
		?>

		const labels_clientes = <?php echo json_encode($labels); ?>;
		const nuevosData = <?php echo json_encode($nuevos); ?>;
		const recurrentesData = <?php echo json_encode($recurrentes); ?>;

		let chartType_clientes = 'line';
		<?php
		if ($this->tipo == "") {
			echo "chartType_clientes = 'line';";
		}
		if ($this->tipo == "2") {
			echo "chartType_clientes = 'scatter';";
		}
		if ($this->tipo == "3") {
			echo "chartType_clientes = 'bar';";
		}
		if ($this->tipo == "4") {
			echo "chartType_clientes = 'pie';";
		}
		?>

		let dataConfig_clientes = {
			labels: labels_clientes,
			datasets: [{
				label: 'Clientes nuevos',
				data: nuevosData,
				borderColor: 'rgb(75, 192, 192)',
				backgroundColor: 'rgba(75, 192, 192, 0.2)',
			}, {
				label: 'Clientes recurrentes',
				data: recurrentesData,
				borderColor: 'rgb(255, 99, 132)',
				backgroundColor: 'rgba(255, 99, 132, 0.2)',
			}]
		};

		if (chartType_clientes === 'scatter') {
			dataConfig_clientes.datasets[0].data = nuevosData.map((v, i) => ({
				x: i + 1,
				y: v
			}));
			dataConfig_clientes.datasets[1].data = recurrentesData.map((v, i) => ({
				x: i + 1,
				y: v
			}));
			dataConfig_clientes.labels = [];
		} else if (chartType_clientes === 'pie') {
			// For pie, maybe combine or something, but since two datasets, perhaps not ideal, but keep as line
			chartType_clientes = 'line'; // fallback
		}

		let options_clientes = {
			responsive: true,
			plugins: {
				title: {
					display: true,
					text: 'Clientes nuevos vs Clientes recurrentes'
				}
			}
		};

		if (chartType_clientes !== 'pie') {
			options_clientes.scales = {
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

		const config_clientes = {
			type: chartType_clientes,
			data: dataConfig_clientes,
			options: options_clientes
		};

		new Chart(ctx_clientes, config_clientes);
	</script>

	<!-- Modal for fullscreen chart -->
	<div class="modal fade" id="modal_clientes" tabindex="-1" aria-labelledby="modalClientesLabel" aria-hidden="true">
		<div class="modal-dialog modal-fullscreen">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalClientesLabel">Clientes nuevos vs Clientes recurrentes</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<canvas id="modal_chart_clientes"></canvas>
				</div>
			</div>
		</div>
	</div>

	<script>
		function openFullscreenChartClientes() {
			const modal = new bootstrap.Modal(document.getElementById('modal_clientes'));
			modal.show();
			const modalCtx = document.getElementById('modal_chart_clientes').getContext('2d');
			let modalDataConfig = {
				labels: labels_clientes,
				datasets: [{
					label: 'Clientes nuevos',
					data: nuevosData,
					borderColor: 'rgb(75, 192, 192)',
					backgroundColor: 'rgba(75, 192, 192, 0.2)',
				}, {
					label: 'Clientes recurrentes',
					data: recurrentesData,
					borderColor: 'rgb(255, 99, 132)',
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
				}]
			};
			if (chartType_clientes === 'scatter') {
				modalDataConfig.datasets[0].data = nuevosData.map((v, i) => ({
					x: i + 1,
					y: v
				}));
				modalDataConfig.datasets[1].data = recurrentesData.map((v, i) => ({
					x: i + 1,
					y: v
				}));
				modalDataConfig.labels = [];
			} else if (chartType_clientes === 'pie') {
				chartType_clientes = 'line'; // fallback
			}
			let modalOptions = {
				responsive: true,
				plugins: {
					title: {
						display: true,
						text: 'Clientes nuevos vs Clientes recurrentes'
					}
				}
			};
			if (chartType_clientes !== 'pie') {
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
				type: chartType_clientes,
				data: modalDataConfig,
				options: modalOptions
			});
		}
	</script>
</div>