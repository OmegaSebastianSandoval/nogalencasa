<style type="text/css">
  .separador_vertical2{
    height: 70px !important;
  }
  footer .puntos {
      height: 6rem;
  }
</style>

<div class="footer-redes">
	<div class="container">
		<div class="row" style="margin-bottom: 30px;">
			<div class="col-lg-3 text-left ">
				
				<div class="red1 titulosfooter">
					<div><img src="/corte2/logo-nogal.png" ></div>
				</div>
			</div>
			<div class="col-lg-5 text-left puntos separador_vertical2" style="margin-left: 5%">
				<div class="text-footer margen_footer">
          <ul class="lista_horizontal">
            <li class="li2"><a href="/"><span>Inicio</span></a></li>
            <li class="li2"><a href="/page/comprar"><span>¿Cómo comprar?</span></a></li>
            <li class="li2"><a href="/page/seguridadsanitaria"><span>Seguridad sanitaria</span></a></li>
            <li><a href="/page/formulario"><span>Contactenos</span></a></li>
          </ul>
				</div>
			</div>
			<div class="col-lg-3 text-left puntos separador_vertical2" style="margin-left:-2%">
				<div class="text-footer margen_footer" style="margin-left: 32%;">
              <?php if($online2==1){ ?>
                <div class=""><a href="https://express.clubelnogal.com/page/index/"><span style="color:#FFFFFF">Ir a La Taberna Express</span></a></div>
              <?php }else{ ?>
                <div class=""><a href="#" onclick="$('#boton_modal2').click();"><span style="color:#FFFFFF">Ir a La Taberna Express</span></a></div>
              <?php } ?>

              <a href="https://cafeparis.clubelnogal.com/page/index/"><span style="color:#FFFFFF">Ir a Café París Express</span></a>

				</div>
		</div>
	</div>
</div>

<div align="center">
	<div class="derechos">
		<span>© 2020</span> Todos los Derechos Reservados Corporación Club El Nogal | Desarrollado por <a href="http://www.omegasolucionesweb.com" target="_blank" class="enlacered1">Omega Soluciones Web</a>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-body">
      	<iframe id="iframe_login" src="/page/login/" width="100%" scrolling="auto" frameborder="0" height="500"></iframe>
      </div>
    </div>
  </div>
</div>


</div>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" id="boton_modal2" data-toggle="modal" data-target="#exampleModal_express">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal_express" tabindex="-1" role="dialog" aria-labelledby="exampleModal_expressLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModal_expressLabel">Restaurante Express Cocina Nogal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<?php if($hora>="18:00:00"){ ?>
        	Apreciado socio, lo invitamos a realizar su pedido el día de mañana en el horario de 10 a.m. a 6 p.m. y disfrutar de nuestra carta.
    	<?php }else{ ?>
    		Apreciado socio, lo invitamos a realizar su pedido en el horario de 10 a.m. a 6 p.m. y disfrutar de nuestra carta.
    	<?php } ?>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>




<!-- Button trigger modal -->
<button type="button" class="btn btn-primary d-none" id="boton_modal3" data-toggle="modal" data-target="#exampleModal_cafeparis">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal_cafeparis" tabindex="-1" role="dialog" aria-labelledby="exampleModal_expressLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModal_expressLabel">Café París Express</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<?php if($hora>="16:00:00"){ ?>
        	Apreciado socio, lo invitamos a realizar su pedido el día de mañana en el horario de 8 a.m. a 4 p.m. y disfrutar de nuestra carta.
    	<?php }else{ ?>
    		Apreciado socio, lo invitamos a realizar su pedido en el horario de 8 a.m. a 4 p.m. y disfrutar de nuestra carta.
    	<?php } ?>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>