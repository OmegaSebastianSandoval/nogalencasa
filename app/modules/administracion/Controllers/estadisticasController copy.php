<?php

/**
 *
 */
class Administracion_estadisticasController extends Administracion_mainController
{
	public function indexAction()
	{
		$this->getLayout()->setTitle("Estadisticas");

		$fecha1 = date("Y-01-01 00:00:00");
		$fecha2 = date("Y-m-d H:i:s");

		if ($this->_getSanitizedParam("fecha1") != "") {
			$fecha1 = $this->_getSanitizedParam("fecha1") . " 00:00:00";
		}
		if ($this->_getSanitizedParam("fecha2") != "") {
			$fecha2 = $this->_getSanitizedParam("fecha2") . " 23:59:59";
		}

		$filtro = " (pedido_estado='1' OR pedido_estado='10' OR pedido_estado='11') "; //pedidos aprobados, enviados o entregados

		$f1 = $filtro;

		$filtro .= " AND pedido_fecha>='$fecha1' AND pedido_fecha<='$fecha2' ";

		$pedidosModel = new Administracion_Model_DbTable_Pedidos();
		$pedidos = $pedidosModel->getList(" $filtro ", " pedido_fecha ASC ");

		foreach ($pedidos as $key => $value) {

			$fecha = $value->pedido_fecha;

			$date = new DateTime($fecha);
			$semana = $date->format("W");

			$semanas[] = $semana;
			$totales["facturacion_S" . $semana] = 0;
			$totales["facturacion_S" . $semana] += (int) $value->pedido_valorpagar;

			$totales["pedidos_S" . $semana]++;

			//clientes
			$es_nuevo = 1;
			$cedula = $value->pedido_documento;
			$existe_pedido = $pedidosModel->getList(" $f1 AND pedido_documento='$cedula' AND pedido_fecha<'$fecha' ", "");
			if (count($existe_pedido) > 0) {
				$es_nuevo = 0;
			}

			if ($es_nuevo == 1) {
				$totales["clientes_nuevos_S" . $semana]++;
			} else {
				$totales["clientes_recurrentes_S" . $semana]++;
			}


		}

		//carritos abandonados
		$filtro_carrito = " log_detalle='Agregar al carrito' ";
		$fecha1_corta = substr($fecha1, 0, 10);
		$fecha2_corta = substr($fecha1, 0, 10);

		$filtro_carrito .= " AND log_fecha>='$fecha1' AND log_fecha<='$fecha2' ";

		//echo $filtro_carrito;
// echo  "$filtro_carrito GROUP BY log_cedula, SUBSTRING(log_fecha,1,10);";
		$logcarritoModel = new Administracion_Model_DbTable_Logcarrito();
		$carritos = $logcarritoModel->getList(" $filtro_carrito GROUP BY log_cedula, SUBSTRING(log_fecha,1,10) ", " log_fecha ASC ");

		foreach ($carritos as $key2 => $carrito) {
			$fecha = substr($carrito->log_fecha, 0, 10);
			$cedula = $carrito->log_cedula;

			$abandonado = 0;
			$existe = $pedidosModel->getList(" pedido_documento='$cedula' AND (pedido_estado='1' OR pedido_estado='10' OR pedido_estado='11') AND pedido_fecha LIKE '$fecha%'  ", "");


			if (count($existe) == 0) {
				$abandonado = 1;
			}

			if ($abandonado == 1) {

				$date = new DateTime($fecha);
				$semana = $date->format("W");
				$totales["abandonados_S" . $semana]++;
				$semanas[] = $semana;

			}

		}



		$semanas = array_unique($semanas);
		sort($semanas);

		$this->_view->totales = $totales;
		$this->_view->semanas = $semanas;


	}

}