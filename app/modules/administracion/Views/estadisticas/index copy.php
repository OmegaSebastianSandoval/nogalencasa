<?php

function get_dates( $sem ){

	$week = $feini = $fefin = '';
	$fecha = (date('Y')).'-01-01';   #declaro una fecha inicial 2018-01-04

	$week = date('W', strtotime( $fecha ));     #obtiene la primera semana del año

	while( $week != $sem ){  #mientras la semana obtenida sea diferente de la solicitada

	    $fecha = date('Y-m-d', strtotime('+7 days', strtotime( $fecha ) ));  #suma 7 das a la fecha anterior
	    $week = date('W', strtotime( $fecha )); #Obtiene la semana de la nueva fecha

	}    #cuando encuentra la semana solicitada, separa el año, mes y día

    $day = date('d', strtotime($fecha));
    $month = date('m', strtotime($fecha));
    $year = date('Y', strtotime($fecha));

    $nuevaFecha = mktime(0,0,0, $month ,$day, $year);  #Ingresa la fecha separada a mktime
    $weekDay = date("w", $nuevaFecha);

    $nuevaFecha = $nuevaFecha - ($weekDay*24*3600); //Restar los segundos totales de los dias transcurridos de la semana

    $feini = date ("Y-m-d", strtotime('+1 days', $nuevaFecha));  #obtiene el da inicial de la semana solicitada
    $fefin = date ("Y-m-d", strtotime('+7 days', ($nuevaFecha)));  #Obtiene el día final de la siguiente semana solicitada

    $fechas = array( "feini" => $feini, "fefin" => $fefin );  #guardo ambas en un array

	//return $fechas; #Retorno el array
	return $sem." (".fecha_letras($feini)." - ".fecha_letras($fefin).")";
}

function get_mes( $sem ){

	$week = $feini = $fefin = '';
	$fecha = (date('Y')).'-01-01';   #declaro una fecha inicial 2018-01-04

	$week = date('W', strtotime( $fecha ));     #obtiene la primera semana del año

	while( $week != $sem ){  #mientras la semana obtenida sea diferente de la solicitada

	    $fecha = date('Y-m-d', strtotime('+7 days', strtotime( $fecha ) ));  #suma 7 días a la fecha anterior
	    $week = date('W', strtotime( $fecha )); #Obtiene la semana de la nueva fecha

	}    #cuando encuentra la semana solicitada, separa el año, mes y día

    $day = date('d', strtotime($fecha));
    $month = date('m', strtotime($fecha));
    $year = date('Y', strtotime($fecha));

    $nuevaFecha = mktime(0,0,0, $month ,$day, $year);  #Ingresa la fecha separada a mktime
    $weekDay = date("w", $nuevaFecha);

    $nuevaFecha = $nuevaFecha - ($weekDay*24*3600); //Restar los segundos totales de los dias transcurridos de la semana

    $feini = date ("Y-m-d", strtotime('+1 days', $nuevaFecha));  #obtiene el día inicial de la semana solicitada
    $fefin = date ("Y-m-d", strtotime('+7 days', ($nuevaFecha)));  #Obtiene el día final de la siguiente semana solicitada

    $fechas = array( "feini" => $feini, "fefin" => $fefin );  #guardo ambas en un array

    $aux = explode("-",$feini);
   	$mes = $aux[0]."-".$aux[1];

	//return $fechas; #Retorno el array
	return $mes;
}

function fecha_letras($fecha){
	$aux = explode("-",$fecha);
	$meses = array("","Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
	$mes = $meses[$aux[1]*1];
	return $mes." ".$aux[2];
}

?>



<style>
	.tabla1{
		background-color: #FFFFFF;
		font-size: 14px;
		border:hidden;
	}

	.tabla1 tr, .tabla1 th, .tabla1 td{
		border: hidden;
	}

	.tabla1 tr{
		line-height: 30px;
	}

	.tabla1 tr:nth-child(even) {
		background-color: #F6F6F6;
	}
	.tabla1 tr:nth-child(odd) {
		background-color: #FFFFFF;
	}

	.fondo_blanco{
		background-color: #FFFFFF;
		border-radius: 10px;
		padding: 20px;
		margin-left: 10px;
		width: 98%;

		-webkit-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.75);
		-moz-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.75);
		box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.75);

	}	

	.tabla1 th{
		background-color: black;
		color: #FFFFFF;
		line-height: 30px;
	}

	.bold{
		font-weight: bold;
	}
</style>

<div class="container mb-3">
	<form method="get" action="">
		<div class="row mt-3">
			<div class="col-lg-2">
				<label>Fecha inicial</label>
				<input type="date" name="fecha1" value="<?php echo $_GET['fecha1']; ?>" placeholder="Fecha inicial" class="form-control">
			</div>
			<div class="col-lg-2">
				<label>Fecha final</label>
				<input type="date" name="fecha2" value="<?php echo $_GET['fecha2']; ?>" placeholder="Fecha final" class="form-control">
			</div>

			<div class="col-lg-2">
				<button class="btn btn-primary" style="margin-top: 29px;">Filtrar</button>
			</div>
		</div>
	</form>

</div>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>



<div id="todo13" class="container fondo_blanco">	
	<div id="tabla13" class="">
		<h2 class="my-3">Facturación semanal</h2>
		<table width="100%" border="1" cellpadding="5" cellspacing="0" class="tabla1">
			<tr>
				<th>Semana</th>
				<th><div align="center">Facturación</th>
			</tr>
			<?php foreach ($this->semanas as $fecha): ?>
				<?php
					$mes = get_mes($fecha);
					$total = (int)$this->totales["facturacion_S".$fecha]; 
					$Total+=$total;

					if($total>0){
				?>
				<tr>
					<td><?php echo get_dates($fecha); ?></td>
					<td><div align="center">$<?php echo number_format($total); ?></div></td>
				</tr>
				<?php } ?>
			<?php endforeach ?>
			<tr>
				<td class="bold">Total</td>
				<td class="bold"><div align="center">$<?php echo number_format($Total); ?></div></td>
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
	      data.addColumn('number', 'Total');

	      <?php $x=1; ?>

	      data.addRows([
	      	<?php foreach ($this->semanas as $key => $fecha): ?>
	      		<?php
	      			$mes = get_mes($fecha);
	      			$valor = (int)$this->totales["facturacion_S".$fecha];
	      			$valor = round($valor/1000,0); 
	      		if($valor>0){
	      		?>
		        	[<?php
		        		if($_GET['tipo']!="4"){ echo $x; ?>,<?php } ?>'<?=($fecha);?>',
				      
			      		<?php
			      			echo $valor;
			      		?>
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
	          title: 'Total en miles',
	          logScale: false,
              minValue: 4,
              viewWindow:{min:0},
              format: '0',
	        },
    			backgroundColor: 'none',
    			is3D: true,
    			title: 'Facturación semanal'
	      };


	    <?php
	    if($_GET['tipo']==""){ ?>
	      var chart = new google.visualization.LineChart(document.getElementById('chart_eficiencia')); <?php
	    }
	  	if($_GET['tipo']=="2"){ ?>
	      var chart = new google.visualization.ScatterChart(document.getElementById('chart_eficiencia')); <?php
	    }
	  	if($_GET['tipo']=="3"){ ?>
	      var chart = new google.visualization.ColumnChart(document.getElementById('chart_eficiencia')); <?php
	    }
	    if($_GET['tipo']=="4"){ ?>
	      var chart = new google.visualization.PieChart(document.getElementById('chart_eficiencia')); <?php
	    } ?>

	    google.visualization.events.addListener(chart, 'ready', titleCenter);
	    chart.draw(data, options);

		function titleCenter() {
		    var $container = $('#chart_eficiencia');
		    var svgWidth = $container.find('svg').width();
		    var $titleElem = $container.find("text:contains(" + options.title + ")");
		    var titleWidth = $titleElem.html().length * ($titleElem.attr('font-size')/2);
		    var xAxisAlign = (svgWidth - titleWidth)/2;
		    $titleElem.attr('x', xAxisAlign);
		}	    
	  }




  </script>

  	<div id="chart12" class="mb-2">
   		<h2 class="mt-4 titulo1" style="display: none;">Facturación semanal</h2>
		<div id="chart_eficiencia" style="width: 100%; height: 400px;"></div>
	</div>
</div>


<div class="container-fluid mt-4 fondo_blanco">
    <?php echo $this->getRoutPHP('modules/administracion/Views/estadisticas/abandonados.php'); ?>
</div>

<div class="container-fluid mt-4 fondo_blanco">
    <?php echo $this->getRoutPHP('modules/administracion/Views/estadisticas/clientes.php'); ?>
</div>