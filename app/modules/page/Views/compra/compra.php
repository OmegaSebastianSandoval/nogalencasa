<div align="center" style="padding-bottom: 30px;">
	<section id="interna">
		<h1>Compra</h1>
		<img src="/skins/page/images/raya.png" class="separador">
			<div class="container">
				<div class="tituloforma" align="left">
					Hola <?php echo $this->nombre; ?>
				</div>
				<form method="post" action="/page/carrito/generarpago">
					<div class="row">
						<div class="col-md-6 formularioform" align="left">
							<div class="form-group">
								<label>Nombre</label>
								<input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $this->user[0]->user_names;?>" placeholder="Nombre" required>
							</div>
							<div class="form-group">
								<label>Apellido</label>
								<input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $this->user[0]->user_lastnames;?>" placeholder="Apellido" required>
							</div>

							<div class="form-group">
								<label>Celular</label>
								<input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $this->user[0]->user_phone;?>" placeholder="Celular">
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" id="email" name="email" value="<?php echo $this->user[0]->user_email;?>" placeholder="Email">
							</div>
							<div class="form-group">
								<label>Ciudad</label>
								<input type="text" class="form-control" id="envio" name="envio" value="<?php echo $this->user[0]->user_ciudad;?>" placeholder="Ciudad">
							</div>
							<div class="form-group">
								<label>Modo de envío</label>
								<select name="mododeenvio" class="form-control"   onchange="fenvio(<?php echo $this->valortotaldescuento; ?>)" required>
									<option>Seleccionar modo de envio</option>
								    <option value="1">Envio a domicilio</option>
								    <option value="2">Recoger en Bodega</option>
								</select>
							</div>
							<div class="form-group direccion">
								<label>Dirección de envio</label>
								<input type="text" class="form-control" id="direccion" name="direccion" value="<?php echo $this->user[0]->user_city;?>" placeholder="Dirección">
							</div>
							<div class="form-group bodega">
								<label>Bodega</label>
								<select name="bodega-envio" class="form-control">
									<?php foreach ($this->bodegas as $key => $bodega): ?>
										<option value="<?php echo $bodega->bodegas_nombre; ?>">
											<?php echo $bodega->bodegas_nombre; ?>
										</option>
									<?php endforeach ?>
								</select>
							</div>
						</div>  
						<div class="col-md-6 formadepago">
							<div align="left">
								<div class="tituloforma">Resumen de la compra</div> 
									<div align="left">
										<div class="titulototal" style="font-size:21px;">
		                   					
		                   					<div>Subtotal con IVA: <span  id="totalgeneral">$<?php echo number_format($this->valorsiniva);?></span></div>
		                   					<div>Subtotal con descuento + IVA: <span  id="totalgeneral">$<?php echo number_format($this->valortotaldescuento);?></span></div>
		                   					<div>Total: <span  id="totalgeneral">$ <div class="totalmostrar"></div> <div class="totalnomostrar"><?php echo number_format($this->valortotaldescuento) ?></div></span></div>
	                   					<div>
	                   				</div>
	                    			<div style="clear:both"></div>
	                  					<input type="hidden" value="" id="valortotal" name="totalgeneral">
	                   				</div>
	                   				<div class="titulonotas">Notas del cliente</div>
	                            		<textarea id="notas" name="notas"  style="resize:none; color:#333;"></textarea>
	                       			</div>
								</div>
								<div class="form-check">
									<div align="left">
										<input type="checkbox" class="form-check-input" id="exampleCheck1" required>
										<span>Autorizo el tratamiento de mis datos personales conforme con lo establecido en la Política de Tratamiento de Datos Personales .</span>
									</div>
								</div>
								<input type="submit" class="botonagregar" value="Continuar">
							</div>
							</div>
						</div>
					</form>
			</div>
	</section>
</div>
<script type="text/javascript">
	function fenvio(valor){
   		if($('select[name=mododeenvio]').val() == 1){
   			$('.direccion').css('display','block');
   			$('.bodega').css('display','none');
   			if(valor >= 300000){
   				var valorflete = (valor*3)/100;
				var valortotal = valor + valorflete;
   			} else if(valor < 300000){
   				var valortotal = valor + 10000;
   			}
   			$('#valortotal').val(valortotal);
			$(".totalmostrar").html(number_format(valortotal));
   			
   		} else if($('select[name=mododeenvio]').val() == 2){
   			$('.bodega').css('display','block');
			$('.direccion').css('display','none');
			$('#valortotal').val(valor);
			$(".totalmostrar").html(number_format(valor));
		}
		$('.totalnomostrar').css('display','none');
	}

	function number_format (number, decimals, dec_point, thousands_sep) {
	    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	    var n = !isFinite(+number) ? 0 : +number,
	        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
	        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
	        s = '',
	        toFixedFix = function (n, prec) {
	            var k = Math.pow(10, prec);
	            return '' + Math.round(n * k) / k;
	        };
	    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	    if (s[0].length > 3) {
	        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	    }
	    if ((s[1] || '').length < prec) {
	        s[1] = s[1] || '';
	        s[1] += new Array(prec - s[1].length + 1).join('0');
	    }
	    return s.join(dec);
	}

	
</script>
