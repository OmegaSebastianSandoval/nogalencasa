<ul class="sidebar-menu sticky-top z-2">


<?php if($_SESSION['kt_login_level']=="1" or $_SESSION['kt_login_level']=="2"){ ?>
	<li <?php if($this->botonpanel == 1){ ?>class="activo"<?php } ?>><a href="/administracion/panel"><i class="fas fa-info-circle"></i> Información Página</a></li>
	<li <?php if($this->botonpanel == 2){ ?>class="activo"<?php } ?>><a href="/administracion/publicidad"><i class="far fa-images"></i> Administrar Banner</a></li>
	<li <?php if($this->botonpanel == 3){ ?>class="activo"<?php } ?>><a href="/administracion/contenido"><i class="fas fa-file-invoice"></i> Administrar Contenidos</a></li>
<?php } ?>

<?php if($_SESSION['kt_login_level']=="1" or $_SESSION['kt_login_level']=="3" or $_SESSION['kt_login_level']=="4"){ ?>
	<li <?php if($this->botonpanel == 5){ ?>class="activo"<?php } ?>><a href="/administracion/categorias"><i class="fas fa-file-invoice"></i> Administrar Categorías</a></li>
	<li <?php if($this->botonpanel == 6){ ?>class="activo"<?php } ?>><a href="/administracion/productos"><i class="fas fa-file-invoice"></i> Administrar Productos</a></li>
<?php } ?>
<?php if($_SESSION['kt_login_level']=="1" or $_SESSION['kt_login_level']=="3"){ ?>
	<li <?php if($this->botonpanel == 9){ ?>class="activo"<?php } ?>><a href="/administracion/importarproductos/manage/?id=1"><i class="fas fa-file-invoice"></i> Importar Productos</a></li>
	<li <?php if($this->botonpanel == 9){ ?>class="activo"<?php } ?>><a href="/administracion/importarproductos/importarfotos/"><i class="fas fa-file-invoice"></i> Importar Fotos</a></li>
<?php } ?>
<?php if($_SESSION['kt_login_level']=="1" or $_SESSION['kt_login_level']=="3" or $_SESSION['kt_login_level']=="4"){ ?>
	<li <?php if($this->botonpanel == 12){ ?>class="activo"<?php } ?>><a href="/administracion/productos/exportar/?excel=1"><i class="fas fa-file-invoice"></i> Exportar Productos</a></li>
<?php } ?>
<?php if($_SESSION['kt_login_level']=="1" or $_SESSION['kt_login_level']=="4" or $_SESSION['kt_login_level']=="3"){ ?>
	<li <?php if($this->botonpanel == 13){ ?>class="activo"<?php } ?>><a href="/administracion/pedidos/"><i class="fas fa-file-invoice"></i> Pedidos</a></li>
	<li <?php if($this->botonpanel == 13){ ?>class="activo"<?php } ?>><a href="/administracion/pedidos/exportar/"><i class="fas fa-file-invoice"></i>Exportar Pedidos</a></li>
<?php } ?>
<?php if($_SESSION['kt_login_level']=="1" or $_SESSION['kt_login_level']=="3"){ ?>
	<!--<li <?php if($this->botonpanel == 10){ ?>class="activo"<?php } ?>><a href="/administracion/importarsocios/manage/?id=1"><i class="fas fa-file-invoice"></i> Importar Socios</a></li>-->
	<!--<li <?php if($this->botonpanel == 10){ ?>class="activo"<?php } ?>><a href="/administracion/socios/exportar/?excel=1" target="_blank"><i class="fas fa-file-invoice"></i> Exportar Socios</a></li>-->
<?php } ?>
<?php if($_SESSION['kt_login_level']=="1" or $_SESSION['kt_login_level']=="3" or $_SESSION['kt_login_level']=="4" or $_SESSION['kt_login_level']==11){ ?>
	<li <?php if($this->botonpanel == 11){ ?>class="activo"<?php } ?>><a href="/administracion/socios/"><i class="fas fa-file-invoice"></i>Socios</a></li>
<?php } ?>
<?php if($_SESSION['kt_login_level']=="1" or $_SESSION['kt_login_level']=="3"){ ?>
	<li <?php if($this->botonpanel == 7){ ?>class="activo"<?php } ?>><a href="/administracion/zonas"><i class="fas fa-map-marked-alt"></i> Zonas domicilios</a></li>
<?php } ?>

<?php if($_SESSION['kt_login_level']=="1" or $_SESSION['kt_login_level']=="3"){ ?>
	<li <?php if($this->botonpanel == 15){ ?>class="activo"<?php } ?>><a href="/administracion/horarios"><i class="fas fa-map-marked-alt"></i> Horarios</a></li>
	<!--<li <?php if($this->botonpanel == 15){ ?>class="activo"<?php } ?>><a href="/administracion/horariosexpress"><i class="fas fa-map-marked-alt"></i> Horarios Express</a></li>-->
<?php } ?>

<?php if($_SESSION['kt_login_level']=="1"){ ?>
	<li <?php if($this->botonpanel == 4){ ?>class="activo"<?php } ?>><a href="/administracion/usuario"><i class="fas fa-users"></i> Administrar Usuarios</a></li>
<?php } ?>

<?php if($_SESSION['kt_login_level']=="1" or $_SESSION['kt_login_level']=="3" or $_SESSION['kt_login_level']=="4"){ ?>
	<li <?php if($this->botonpanel == 12){ ?>class="activo"<?php } ?>><a href="/administracion/usuario/exportarinvitados/?excel=1"><i class="fas fa-file-invoice"></i> Exportar Invitados</a></li>
<?php } ?>

<?php if($_SESSION['kt_login_level']=="1"){ ?>
	<li <?php if($this->botonpanel == 16){ ?>class="activo"<?php } ?>><a href="/administracion/configpropinas/manage/?id=1"><i class="fas fa-concierge-bell"></i>Configuracion  Propinas</a></li>
  <li <?php if($this->botonpanel == 17){ ?>class="activo"<?php } ?>><a href="/administracion/propinasopciones"><i class="fas fa-concierge-bell"></i>Opciones de Propinas</a></li>
<?php } ?>

<?php if($_SESSION['kt_login_level']=="1"){ ?>
	<li <?php if($this->botonpanel == 18){ ?>class="activo"<?php } ?>><a href="/administracion/estadisticas"><i class="fa-solid fa-chart-line"></i> Estadisticas</a></li>
<?php } ?>

</ul>

<style>
  .sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
    background: var(--gray);
    width: 100%;
  }


  .sidebar-menu a {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 18px;
    border-radius: 8px;
    text-decoration: none;
    color: #222;
    font-weight: 500;
    font-size: 1rem;
    transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    background: transparent;
    box-shadow: none;
  }

  .sidebar-menu li.activo a,
  .sidebar-menu a:hover {
    background: #22223b;
    color: #fff;
    box-shadow: 0 2px 8px rgba(34, 34, 59, 0.08);
  }

  .sidebar-menu a {
    background: #3d4043;
    color: #fff;
    box-shadow: 0 2px 8px rgba(34, 34, 59, 0.08);
  }

  .sidebar-menu i {
    font-size: 1.2em;
    min-width: 22px;
    text-align: center;
  }
</style>