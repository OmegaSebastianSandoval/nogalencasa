<?php

/**
 *
 */
class Administracion_estadisticasController extends Administracion_mainController
{
	public function indexAction()
	{
		$this->getLayout()->setTitle("Estadisticas");
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

		// Cantidad de pedidos por día
		$pedidos_por_dia = array();
		foreach ($pedidos as $pedido) {
			$fecha_dia = substr($pedido->pedido_fecha, 0, 10);
			if (!isset($pedidos_por_dia[$fecha_dia])) {
				$pedidos_por_dia[$fecha_dia] = 0;
			}
			$pedidos_por_dia[$fecha_dia]++;
		}
		$this->_view->pedidos_por_dia = $pedidos_por_dia;

		$pedidos_por_semana = array();
		$totales = array();

		foreach ($pedidos as $key => $value) {

			$fecha = $value->pedido_fecha;

			$date = new DateTime($fecha);
			$semana = $date->format("W");

			$semanas[] = $semana;

			if (!isset($totales["facturacion_S" . $semana])) {
				$totales["facturacion_S" . $semana] = 0;
				$totales["pedidos_S" . $semana] = 0;
				$totales["clientes_nuevos_S" . $semana] = 0;
				$totales["clientes_recurrentes_S" . $semana] = 0;
			}

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

			$pedidos_por_semana[$semana][] = $value;
		}

		//carritos abandonados
		$filtro_carrito = " log_detalle='Agregar al carrito' ";
		$fecha1_corta = substr($fecha1, 0, 10);
		$fecha2_corta = substr($fecha1, 0, 10);

		$filtro_carrito .= " AND log_fecha>='$fecha1' AND log_fecha<='$fecha2' ";

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
				if (!isset($totales["abandonados_S" . $semana])) {
					$totales["abandonados_S" . $semana] = 0;
				}
				$totales["abandonados_S" . $semana]++;
				$semanas[] = $semana;
			}
		}



		$semanas = array_unique($semanas);
		sort($semanas);

		$this->_view->totales = $totales;
		$this->_view->semanas = $semanas;
		$this->_view->pedidos_por_semana = $pedidos_por_semana;

		//productos más vendidos
		$productosCarritoModel = new Page_Model_DbTable_Productoscarrito();
		$productos_vendidos_raw = $productosCarritoModel->getList(" id_carrito IN (SELECT pedido_id FROM pedidos WHERE $filtro) ", "");
		$productos_vendidos = array();

		foreach ($productos_vendidos_raw as $prod) {
			$id = $prod->id_productos;

			if (!array_key_exists($id, $productos_vendidos)) {
				$productos_vendidos[$id] = [
					'cantidad' => 0,
					'producto' => $prod,
				];
			}

			$productos_vendidos[$id]['cantidad'] += $prod->cantidad;
		}

		usort($productos_vendidos, function ($a, $b) {
			return $b['cantidad'] - $a['cantidad'];
		});

		$productos_vendidos = array_slice($productos_vendidos, 0, 10);;
		// Obtener nombres de productos
		$productosModel = new Page_Model_DbTable_Productos();
		foreach ($productos_vendidos as &$prod) {
			$producto = $productosModel->getById($prod['producto']->id_productos);
			$prod['nombre'] = $producto ? $producto->productos_nombre : 'Producto ' . $prod['producto']->id_productos;
		}

		$this->_view->productos_vendidos = $productos_vendidos;

		//top compradores
		$compradores = array();
		foreach ($pedidos as $pedido) {
			$doc = $pedido->pedido_documento;
			$nombre = $pedido->pedido_nombre;
			$apellido = $pedido->pedido_apellido;
			if (!isset($compradores[$doc])) {
				$compradores[$doc] = array(
					'total' => 0,
					'nombre' => $nombre,
					'apellido' => $apellido
				);
			}
			$compradores[$doc]['total'] += (int) $pedido->pedido_valorpagar;
		}
		// Ordenar por total
		uasort($compradores, function ($a, $b) {
			return $b['total'] - $a['total'];
		});
		$top_compradores = array_slice($compradores, 0, 10, true);
		$compradores_vista = array();
		foreach ($top_compradores as $doc => $datos) {
			$compradores_vista[] = array(
				'documento' => $doc,
				'total' => $datos['total'],
				'nombre' => $datos['nombre'],
				'apellido' => $datos['apellido']
			);
		}
		$this->_view->compradores_vendidos = $compradores_vista;		// Nueva gráfica: facturación por día
		$facturacion_por_dia = array();
		foreach ($pedidos as $pedido) {
			$fecha_dia = substr($pedido->pedido_fecha, 0, 10);
			if (!isset($facturacion_por_dia[$fecha_dia])) {
				$facturacion_por_dia[$fecha_dia] = 0;
			}
			$facturacion_por_dia[$fecha_dia] += (int) $pedido->pedido_valorpagar;
		}
		// Encontrar el día de mayor venta
		$dia_mayor_venta = '';
		$valor_mayor_venta = 0;
		foreach ($facturacion_por_dia as $dia => $valor) {
			if ($valor > $valor_mayor_venta) {
				$valor_mayor_venta = $valor;
				$dia_mayor_venta = $dia;
			}
		}
		$this->_view->facturacion_por_dia = $facturacion_por_dia;
		$this->_view->dia_mayor_venta = $dia_mayor_venta;
		$this->_view->valor_mayor_venta = $valor_mayor_venta;
	}
}
