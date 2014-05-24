<div class="row" id="centrar_pantalla">
	<div class="large-6 large-centered columns" >
		<fieldset><legend> <span class="letraB">Inicio de Sesión en Sistema</span></legend>
		<!-- Esta alerta se muestra si el usuario no existe en la Base de Datos -->
		<?php
			if(isset($estado)&&$estado=='negado')
			{
				echo '<small id="no_existe" class="error">El usuario ingresado no existe o los datos son incorrectos</small>';
			}else{
				if(isset($estado)&&$estado=='nuevo'){
					echo '<small id="no_existe" class="error" style="display:none">Usuario Registrado satisfactoriamente</small>';
				}else{
					echo '<small id="no_existe" class="error" style="display:none"></small>';
				}
			}
		?>
		<!-- Aqui se arma el formulario correspondiente al ingreso del usuario al sistema -->
		<form  name="formLogin" onsubmit="return validarForm()" action='log_users' method="post">
		<!-- Cuadro de texto para indicar correo -->
			<div class="row">
				<div class="large-8 large-centered columns" >
					<h3> <span class="letraB">Correo electrónico:</span></h3>
					<input type="text" name="emailField" autocomplete="off" onfocus="ocultar_error_email()" placeholder="ejemplo@correo.com"/>
					<small id="email_invalido" class="error" style="display:none"></small>
				</div>
			</div>
			<!-- Cuadro de texto para indicar contraseña -->
			<div class="row">
				<div class="large-8 large-centered columns" >
					<h3> <span class="letraB">Contraseña:</span></h3>
					<input type="password" name="passField" onfocus="ocultar_error_pass()" placeholder="********"/>
					<small id="pass_invalido" class="error" style="display:none"></small>
				</div>
			</div>
			<!-- Boton para ingresar datos indicados -->
			<div class="row">
				<div class="large-12 large-offset-4 columns" >
					<input type="submit" class ="radius round button" value="Acceder" id="subbutton">
				</div>
			</div>
			<!-- Enlaces para opciones de usuario -->
		</form>
		<br>
		<div class="row">
			<div class="small-11 small-centered columns" >
				<a href="nuevo_usuario">¿Necesita registrarse?</a>
			/
				<a href="#">¿Ha olvidado su contraseña?</a>
			</div>
		</div>
		<br>
		</fieldset>
	</div>
</div>

<!-- Scripts para validación del formulario -->
<script type="text/javascript">
	function ocultar_error_pass()
	{
		document.getElementById("no_existe").style.display="none";
		document.getElementById("no_existe").innerHTML="";
		document.getElementById("pass_invalido").style.display="none";
		document.getElementById("pass_invalido").innerHTML="";
	}

	function ocultar_error_email()
	{
		document.getElementById("no_existe").style.display="none";
		document.getElementById("no_existe").innerHTML="";
		document.getElementById("email_invalido").style.display="none";
		document.getElementById("email_invalido").innerHTML="";
	}

	function validarForm()
	{
		//PRIMERO SE VERIFICA QUE EL CORREO ELECTRÓNICO NO ESTÉ EN BLANCO O SU FORMATO SEA EL CORRECTO
		var valemail=false;
		var x=document.forms["formLogin"]["emailField"].value;
		if (x==null || x=="")
		{
		document.getElementById("email_invalido").style.display="block";
		document.getElementById("email_invalido").innerHTML="El campo correo electrónico está en blanco";
		valemail=false;
		}else{
			var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
     		if (document.formLogin.emailField.value.search(emailRegEx) == -1) 
			/*var atpos=x.indexOf("@");
			var dotpos=x.lastIndexOf(".");
			if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length || /\s/.test(x))*/
  			{
  				document.getElementById("email_invalido").style.display="block";
				document.getElementById("email_invalido").innerHTML="El formato del correo electrónico es incorrecto";
  				valemail=false;
  			}else{
  				valemail=true;
  			}
		}
		//LUEGO SE VERIFICA QUE LA CONTRASEÑA NO ESTE EN BLANCO, NO TENGA ESPACIOS EN BLANCO O QUE SU LONGITUD SEA MAYOR QUE LA PERMITIDA
		var valpass=false;
		x=document.forms["formLogin"]["passField"].value;
		if (x==null || x=="")
		{
			document.getElementById("pass_invalido").style.display="block";
			document.getElementById("pass_invalido").innerHTML="El campo contraseña está en blanco";
			valpass=false;
		}else{
			if (x.length<8)
  			{
  				document.getElementById("pass_invalido").style.display="block";
				document.getElementById("pass_invalido").innerHTML="La longitud de la contraseña es incorrecta";
  				valpass=false;
  			}else{
  				if (/\s/.test(x))
  				{
  					document.getElementById("pass_invalido").style.display="block";
					document.getElementById("pass_invalido").innerHTML="La contraseña no debe poseer espacios en blanco";
  					valpass=false;
  				}else{
  					valpass=true;
  				}
  			}
		}
		//SI EL CORREO Y LA CONTRASEÑA SON CORRECTOS, SE BUSCA SI EL USUARIO EN LA BASE DE DATOS EXISTE
		document.getElementById("subbutton").blur();

		return (valemail&&valpass);//OJO: Quitar el false al tener la busqueda realizada
	}
</script>
