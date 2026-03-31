<?php

function codificar($x){
	//$x = str_replace("Ã‰","&Eacute;",$x);

	$x = utf8_decode($x);

	//$x = str_replace("Ã‰","&Eacute;",$x);

	return $x;
}


?>

<table border="1" width="100%">
	<tr>
		<th>CODIGO</th>
		<th>IMAGEN</th>
		<th>NOMBRE</th>
		<th>DESCRIPCION</th>
		<th>PRECIO</th>
		<th>CANTIDAD</th>
		<th>CATEGORIA</th>
		<th>SUBCATEGORIA</th>
		<th>CANTIDAD MINIMA</th>
		<th>LIMITE POR PEDIDO</th>
	</tr>
	<?php foreach ($this->productos as $key => $producto): ?>
		<tr>
			<td><?php echo $producto->productos_codigo; ?></td>
			<td><?php echo $producto->productos_imagen; ?></td>
			<td><?php echo codificar($producto->productos_nombre); ?></td>
			<td><?php echo codificar($producto->productos_descripcion); ?></td>
			<td><?php echo $producto->productos_precio; ?></td>
			<td><?php echo $producto->productos_cantidad; ?></td>
			<td><?php echo codificar($this->list_productos_categorias[$producto->productos_categorias]); ?></td>
			<td><?php echo codificar($this->list_productos_subcategorias[$producto->productos_subcategoria]); ?></td>
			<td><?php echo $producto->productos_cantidad_minima; ?></td>
			<td><?php echo $producto->productos_limite_pedido; ?></td>
		</tr>
	<?php endforeach ?>

</table>