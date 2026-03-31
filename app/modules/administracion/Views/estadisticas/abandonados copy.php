<?php
$Total=0;
$Total2=0;
?>

<div id="todo13" class="container">	
	<div id="tabla13" class="">
		<h2 class="my-3">Pedidos vs Carritos abandonados</h2>
		<table width="100%" border="1" cellpadding="5" cellspacing="0" class="tabla1">
			<tr>
				<th>Semana</th>
				<th><div align="center">Pedidos</th>
				<th><div align="center">Carritos abandonados</th>	
			</tr>
			<?php foreach ($this->semanas as $fecha): ?>
				<?php
					$mes = get_mes($fecha);
					$total = (int)$this->totales["pedidos_S".$fecha]; 
					$total2 = (int)$this->totales["abandonados_S".$fecha]; 
					
					$Total+=$total;
					$Total2+=$total2;
				?>
				<tr>
					<td><?php echo get_dates($fecha); ?></td>
					<td><div align="center"><?php echo number_format($total); ?></div></td>
					<td><div align="center"><?php echo number_format($total2); ?></div></td>
				</tr>
			<?php endforeach ?>
			<tr>
				<td class="bold">Total</td>
				<td class="bold"><div align="center"><?php echo number_format($Total); ?></div></td>
				<td class="bold"><div align="center"><?php echo number_format($Total2); ?></div></td>
			</tr>
		</table>
	</div>

	<script type="text/javascript">
		google.charts.load('current', {packages: ['corechart', 'line']});
		google.charts.setOnLoadCallback(drawLogScales);

		function drawLogScales() {
	      var data = new google.visualization.DataTable();
	      <?php if($_GET['tipo']!="4"){ ?>
	      	data.addColumn('number', 'X');
	  	  <?php } ?>
	      data.addColumn({type:'string', role:'annotation'});
	      data.addColumn('number', 'Pedidos');
	      data.addColumn('number', 'Carritos abandonados');

	      <?php $x=1; ?>

	      data.addRows([
	      	<?php foreach ($this->semanas as $key => $fecha): ?>
	      		<?php
	      			$mes = get_mes($fecha);
	      			$valor = (int)$this->totales["pedidos_S".$fecha];
	      			$valor2 = (int)$this->totales["abandonados_S".$fecha];


	      		if($valor>=0){
	      		?>
		        	[<?php
		        		if($_GET['tipo']!="4"){ echo $x; ?>,<?php } ?>'<?=($fecha);?>',
				      
			      		<?php echo $valor;?>,<?php echo $valor2;?>
		        	]

		        	<?php if($x < count($this->semanas)){ echo ','; $x++; } ?>

	        	<?php }else{ $x++; } ?>
	        <?php endforeach ?>
	      ]);


	      var options = {
	        hAxis: {
	          title: 'Semana',
	          logScale: false,
	          textPosition: 'none'
	        },
	        vAxis: {
	          title: 'Totales',
	          logScale: false,
              minValue: 4,
              viewWindow:{min:0},
              format: '0',
	        },
    			backgroundColor: 'none',
    			is3D: true,
    			title: 'Pedidos vs Carritos abandonados'
	      };



	      var chart = new google.visualization.LineChart(document.getElementById('chart_abandonados')); 

	    google.visualization.events.addListener(chart, 'ready', titleCenter);
	    chart.draw(data, options);

		function titleCenter() {
		    var $container = $('#chart_abandonados');
		    var svgWidth = $container.find('svg').width();
		    var $titleElem = $container.find("text:contains(" + options.title + ")");
		    var titleWidth = $titleElem.html().length * ($titleElem.attr('font-size')/2);
		    var xAxisAlign = (svgWidth - titleWidth)/2;
		    $titleElem.attr('x', xAxisAlign);
		}	    
	  }




  </script>

  	<div id="chart12" class="mb-2">
   		<h2 class="mt-4 titulo1" style="display: none;">Pedidos vs Carritos abandonados</h2>
		<div id="chart_abandonados" style="width: 100%; height: 400px;"></div>
	</div>
</div>