<!doctype html>
<html lang="es">
  <head>
    <base href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/" />
    <meta name="description" content="Servicio de Farmacia" />
    <meta charset="utf-8" />
    <title><?php echo $titulo; ?></title>
    <meta name="viewport" content="width=device-width"/>

    <!-- Agregado de icono -->
    <link href="img/favicon.ico" type="image/x-icon" rel="shortcut icon" /> 

    <!-- Añadido de Scripts adicionales JS de Foundation-->
    <script src="js/vendor/modernizr.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/foundation/foundation.js"></script>
    <script src="js/foundation/foundation.magellan.js"></script>
    <script src="js/foundation/foundation.reveal.js"></script>
    
    <!-- Hojas de estilo CSS -->
    <link rel="stylesheet" href="assets/css/foundation.css" />
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/estilos.css">
  </head>

  <body>
    <div id="wrapper">
      <div id="header">
        <div class="row">
          <div class="large-6 medium-6 columns">
            <img src="img/logo_farmacia_web.png" align="left" id="img_head"/>
          </div>
          <!-- Esta seccion puede mostrarse SOLO si se inicia sesion -->
          <?php
          $enlace = site_url();
          if($this->session->userdata('id_usuario'))
            echo '
          <div class="large-6 medium-6 columns">
            <div class="row">
              <div class="large-12 medium-12 columns">
                <label> <span class="letraA">Bienvenido, '.$this->session->userdata('nombre').' - <a href="'.$enlace.'/cerrar_sesion">Cerrar sesión</a></span></label>
                <label> <span class="letraC">Busqueda Rápida por Nombre de Medicamento</span></label>
              </div>
               <div class="large-8 medium-8 columns">
                <input type="text" placeholder="Ingrese el nombre del medicamento a consultar" id="elem_head"/> 
              </div>
              <div class="large-4 medium-4 columns">
                <a href="#" class="button [tiny small large]" id="elem_head">Buscar</a>
              </div>
            </div>
          </div>
          ';
          ?>
          <!-- FIN DE SECCIÓN -->
        </div>
      </div>
      <div id="content">
