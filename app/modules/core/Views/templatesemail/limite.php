<div style="background:#FFFFFF; padding:20px;" align="center">
    <div style="display:inline-block; width:900px; padding:20px;">
        <h1>El siguiente producto tiene un nivel de stock bajo:</h1>
        <br>
    	<h2>Información del producto</h2>
        <div style="width: 49%;"><b>Código</b></div>
        <div style="width: 49%;"><?php echo $this->productos->productos_codigo; ?></div>
        <div style="width: 49%;"><b>Nombre</b></div>
        <div style="width: 49%;"><?php echo $this->productos->productos_nombre; ?></div>
        <div style="width: 49%;"><b>Cantidad disponible</b></div>
        <div style="width: 49%;"><?php echo $this->productos->productos_cantidad; ?></div>
    </div>
</div>