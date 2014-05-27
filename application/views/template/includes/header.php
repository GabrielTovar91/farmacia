<!doctype html>
<html lang="es">
  <head>
    <base href="http://<?php echo $_SERVER['SERVER_NAME']; ?>/" />
    <meta name="description" content="Servicio de Farmacia" />
    <meta charset="utf-8"/>
    <title><?php echo $titulo; ?></title>
    <meta name="viewport" content="width=device-width"/>

    <!-- Agregado de icono -->
    <link href="img/favicon.ico" type="image/x-icon" rel="shortcut icon" /> 

    <!-- Añadido de Scripts adicionales JS de Foundation -->
    <script src="js/vendor/modernizr.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/foundation/foundation.js"></script>
    <script src="js/foundation/foundation.magellan.js"></script>
    <script src="js/foundation/foundation.reveal.js"></script>
    
    <!-- Hojas de estilo CSS -->
    <link rel="stylesheet" href="assets/css/foundation.css" />
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/estilos.css">

    <!-- Archivos Jquery UI -->
    <link rel="stylesheet" href="js/development-bundle/themes/ui-darkness/jquery-ui.css">
    <link rel="stylesheet" href="js/css/ui-darkness/jquery-ui-1.10.4.custom.css">
    <script src="js/jquery-1.11.1.js"></script>
    <script src="js/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <script src="js/js/jquery-ui-1.10.4.custom.min.js"></script>
    


  </head>

  <body>
    <div id="wrapper">
      <div id="header">
        <div class="row">
          <div class="large-6 medium-6 columns">
            <img src="img/logo_farmacia_web.png" align="left" id="img_head"/>
          </div>

          <!--Esta seccion puede mostrarse SOLO si se inicia sesion-->

          <?php
          if($this->session->userdata('id_usuario'))
            echo '
              <div class="large-6 medium-6 columns">
                <br><br>
                <div class="row">
                  <div class="large-8 medium-8 columns">
                    <div class="row collapse">
                      <div class="small-9 columns">
                        <input type="text" placeholder="Buscar medicamento...">
                      </div>
                      <div class="small-3 columns">
                        <a href="#" class="button postfix">&nbsp;&nbsp;&nbsp;Buscar&nbsp;&nbsp;&nbsp;&nbsp;</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

          <div class="large-12 columns">
            <nav class="top-bar" data-topbar>
              <section class="top-bar-section">
                <!-- Left Nav Section -->
                <ul class="left">
                  <li><a href="alta_controller">Alta de Medicamentos</a></li>
                  <li><a href="baja_controller">Baja de Medicamentos</a></li>
                  <li><a href="traspaso_controller">Traspaso de Bienes</a></li>
                  <li><a href="#">Modificar datos de Medicamento</a></li>
                  <li><a href="#">Reportes</a></li>
                </ul>
              </section>
            </nav>
          </div>
          ';
          ?>
          <!-- FIN DE SECCIÓN -->
        </div>
      </div>
      <div id="content">

   
