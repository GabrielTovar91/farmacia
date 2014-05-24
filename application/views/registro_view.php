<div class="row" id="centrar_pantalla">
	<div class="large-6 large-centered columns" >
		<fieldset><legend> <span class="letraB">Registro de Nuevo Usuario</span></legend>
		<!-- Esta alerta se muestra si el usuario no existe en la Base de Datos -->
		<?php
			if(isset($estado)&&$estado=='repetido')
			{
				echo '<small id="no_existe" class="error">El usuario ya se encuentra registrado</small>';
			}else{
				echo '<small id="no_existe" class="error" style="display:none"></small>';
			}
		?>
		<!-- Aqui se arma el formulario correspondiente al ingreso del usuario al sistema -->
			<form  name="formRegister" onsubmit="return validarRegistro()" action='nuevo_usuario/registro' method="post">
			<!-- Cuadro de texto para indicar nombre -->
				<div class="row">
					<div class="large-8 large-centered columns" >
						<h3> <span class="letraB">Nombre de Usuario:</span></h3>
						<input type="text" name="nameField" autocomplete="off" onfocus="ocultar_error_name()" placeholder="Su nombre aqui"/>
						<small id="name_invalido" class="error" style="display:none"></small>
					</div>
				</div>
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
				<div class="row">
					<div class="large-8 large-centered columns" >
						<h3> <span class="letraB">Repetir Contraseña:</span></h3>
						<input type="password" name="passFieldR" onfocus="ocultar_error_passr()" placeholder="********"/>
						<small id="passr_invalido" class="error" style="display:none"></small>
					</div>
				</div>
				<!-- Selector de prioridad -->
				<div class="row">
					<div class="large-8 large-centered columns" >
						<h3> <span class="letraB">Nivel de Privilegio:</span></h3>
					</div>
					<div class="large-10 large-centered columns" >
						<div class="large-4 columns" >
							<input type="radio" checked name="priv" value="1">Vendedor
						</div>
						<div class="large-6 columns" >
							<input type="radio" name="priv" value="0">Administrador
						</div>
					</div>
				</div>
				<!-- Boton para ingresar datos indicados -->
				<div class="row">
					<div class="large-10 large-offset-2 columns" >
						<input type="submit" class ="radius round button" value="Registrar" id="resbutton">
						<a class ="radius round button" id="canbutton" href="iniciar_carga">Cancelar</a>
					</div>
				</div>
				<!-- Enlaces para opciones de usuario -->
			</form>
		</fieldset>
	</div>
</div>
<br><br>

<!-- Scripts para validación del formulario -->
<script type="text/javascript">
	function ocultar_error_name()
	{
		document.getElementById("no_existe").style.display="none";
		document.getElementById("no_existe").innerHTML="";
		document.getElementById("name_invalido").style.display="none";
		document.getElementById("name_invalido").innerHTML="";
	}

	function ocultar_error_email()
	{
		document.getElementById("no_existe").style.display="none";
		document.getElementById("no_existe").innerHTML="";
		document.getElementById("email_invalido").style.display="none";
		document.getElementById("email_invalido").innerHTML="";
	}

	function ocultar_error_pass()
	{
		document.getElementById("no_existe").style.display="none";
		document.getElementById("no_existe").innerHTML="";
		document.getElementById("pass_invalido").style.display="none";
		document.getElementById("pass_invalido").innerHTML="";
	}

	function ocultar_error_passr()
	{
		document.getElementById("no_existe").style.display="none";
		document.getElementById("no_existe").innerHTML="";
		document.getElementById("passr_invalido").style.display="none";
		document.getElementById("passr_invalido").innerHTML="";
	}

	function validarRegistro()
	{
		//PRIMERO SE VERIFICA QUE EL CAMPO DEL NOMBRE DEL USUARIO NO ESTE EN BLANCO, NO SEA SOLO DE ESPACIOS EN BLANCO Y SU LONGITUD SEA AL MENOS DE TRES CARACTERES
		var valenombre=false;
		var x=document.forms["formRegister"]["nameField"].value;
		if(x==null || x=="")
		{
			document.getElementById("name_invalido").style.display="block";
			document.getElementById("name_invalido").innerHTML="Este campo no debe quedar en blanco";
		}else{
			valenombre=true;
		}
		//LUEGO SE VERIFICA QUE EL CORREO ELECTRÓNICO NO ESTÉ EN BLANCO O SU FORMATO SEA EL CORRECTO
		var valemail=false;
		x=document.forms["formRegister"]["emailField"].value;
		if (x==null || x=="")
		{
		document.getElementById("email_invalido").style.display="block";
		document.getElementById("email_invalido").innerHTML="El campo correo electrónico está en blanco";
		valemail=false;
		}else{
			var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
     		if (document.formRegister.emailField.value.search(emailRegEx) == -1) 
  			{
  				document.getElementById("email_invalido").style.display="block";
				document.getElementById("email_invalido").innerHTML="El formato del correo electrónico es incorrecto";
  				valemail=false;
  			}else{
  				valemail=true;
  			}
		}
		//LUEGO SE VERIFICA QUE LAS CONTRASEÑA NO ESTEN EN BLANCO, NO TENGAN ESPACIOS EN BLANCO O QUE SU LONGITUD SEA MAYOR QUE LA PERMITIDA
		var valpass=false;
		x=document.forms["formRegister"]["passField"].value;
		if (x==null || x=="")
		{
			document.getElementById("pass_invalido").style.display="block";
			document.getElementById("pass_invalido").innerHTML="El campo contraseña está en blanco";
			valpass=false;
		}else{
			if (x.length<8)
  			{
  				document.getElementById("pass_invalido").style.display="block";
				document.getElementById("pass_invalido").innerHTML="La longitud de la contraseña debe ser mayor a 8";
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
		var valpassr=false;
		var y=document.forms["formRegister"]["passFieldR"].value;
		if (y==null || y=="")
		{
			document.getElementById("passr_invalido").style.display="block";
			document.getElementById("passr_invalido").innerHTML="El campo repetir contraseña está en blanco";
			valpassr=false;
		}else{
			if (y.length<8)
  			{
  				document.getElementById("passr_invalido").style.display="block";
				document.getElementById("passr_invalido").innerHTML="La longitud de la contraseña debe ser mayor a 8";
  				valpassr=false;
  			}else{
  				if (/\s/.test(y))
  				{
  					document.getElementById("passr_invalido").style.display="block";
					document.getElementById("passr_invalido").innerHTML="La contraseña no debe poseer espacios en blanco";
  					valpassr=false;
  				}else{
  					valpassr=true;
  				}
  			}
		}
		//SE VERIFICA QUE AMBAS CONTRASEÑAS INSERTADAS SEAN IGUALES
		if(valpass&&valpassr)
		{
			var iguales=false;
			if(x!=y)
			{
				document.getElementById("passr_invalido").style.display="block";
				document.getElementById("passr_invalido").innerHTML="Ambas contraseñas deben coincidir";
				iguales=false;
			}else{
				iguales=true;
			}
		}
		//LUEGO SE EVALUAN RESULTADOS Y SE DEVUELVE 
		document.getElementById("resbutton").blur();
		return (valenombre&&valemail&&valpass&&valpassr&&iguales);//OJO: Quitar el false al tener la busqueda realizada
	}
</script>
