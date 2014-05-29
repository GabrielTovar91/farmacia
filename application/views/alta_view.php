<script type="text/javascript">
$(function () {
	$("#elab").datepicker({
	onClose: function (selectedDate) {
	$("#venci").datepicker("option", "minDate", selectedDate);
	}
	});
	$("#venci").datepicker({
	onClose: function (selectedDate) {
	$("#elab").datepicker("option", "maxDate", selectedDate);
	}
	});
});
var compActs=0;
</script>

<div class="row">							
	<div class="small-8 small-centered columns">
		<fieldset style="border-width: 3px; border-radius: 2em">
			<legend  align="center"><span class="letraB">Alta de Medicamentos</span></legend><br><br>
			<?php
				if(isset($estado)&&$estado=='existelote')
				{
					echo '<small id="no_existe" class="error">El medicamento/lote ingresado ya se encuentra registrado en su sistema. Verifique los datos e intente de nuevo</small>';
				}
			?>
			<?php
				if(isset($estado)&&$estado=='excedeMax'&&isset($restante))
				{
					echo '<small id="excedemaximo" class="error">La cantidad indicada excede el stock máximo del medicamento, solo pueden almacenarse ';
					echo $restante;
					echo ' más. Verifique los datos e intente de nuevo</small>';
				}
			?>
			<form data-abide name="datosmed" action="alta_controller/registrar_medicamento" onsubmit="return comprobar()" method="POST">
				
				<div align="center">
					<div style="width: 90%" align="left">
						<label>Nombre: </label>
						<input type="text" required placeholder="Nombre del medicamento" name="nombre">
						<small class="error">Se requiere un nombre.</small>
					</div>
				</div>
				<br>
				<div class="large-6 columns">
					<label>Laboratorio: </label>
					<input type="text" required placeholder="Nombre del laboratorio" name="lab">
				</div>
			
				<div class="large-6 columns">
					<label for="selectpresen">Presentación:
						<select onchange="es_otro('selectpresen');" id="selectpresen" class="medium" required data-invalid="" name="prese">
							<option value="">Seleccione su presentación</option>
							<option value="Tabletas">Tabletas</option>
							<option value="Píldoras">Píldoras</option>
							<option value="Comprimidos">Comprimidos</option>
							<option value="Capsulas blandas">Capsulas blandas</option>
							<option value="Jarabe">Jarabe</option>
							<option value="Solucion Inyectable">Solución Inyectable</option>
							<option value="Otro">Otro...</option>
						</select>
					</label>
				</div>

				<div id="otrapres" style="display:none">
					<div class="large-6 columns">
						<label>Indique la presentación del medicamento: </label><br><br>
					</div>

					<div class="large-6 columns">
						<input type="text" id="presocul" placeholder="Presentación" name="presotro">
					</div>
				</div>

				<div class="large-12 columns" align="center">
					<fieldset style="border-width: 3px; border-radius: 2em">
						<legend  align="left">Principios Activos:</legend>
						<!-- Este contenido debe ser modificado dinámicamente -->
						<div id="dinamic_principio">
							<div class="large-6 columns">
								<label><br>Descripción: </label>
								<input type="text" required placeholder="Descripción" name="descripcion[]">
							</div>

							<div class="large-6 columns">
								<label><br>MGRS: </label>
								<input type="text" pattern="[0-9]+" required placeholder="Miligramos" name="miligramos[]">
							</div>
						<!-- Fin de contenido dinámico -->
						</div>
						<div class="large-6 columns" align="center">
							<input type="button" class ="small radius round button" value="Agregar otro" id="addprinc" onClick="agregar_principio('dinamic_principio');">
						</div>
						<div class="large-6 columns" align="center">
							<input type="button" class ="small radius round button" value="Eliminar último" id="subprinc" onClick="remover_principio('dinamic_principio');">
						</div>
					</fieldset>

				<div class="large-6 columns">
					<label>Posología: </label>
					<input type="text" required placeholder="Posología..." name="dosis">
				</div>

				<div class="large-6 columns">
					<label>Lote: </label>
					<input type="text" required placeholder="Lote..." name="lote">
				</div>

				<div class="large-6 columns">
					<label>F. Elaboración: </label>
					<input type="date" required placeholder="MM/DD/AAAA" name="felab" id="elab">
				</div>

				<div class="large-6 columns">
					<label>F. Vencimiento: </label>
					<input type="date" required placeholder="MM/DD/AAAA" name="fvenci" id="venci">
				</div>
				
				<div class="large-12 columns">
					<small id="mayorst" class="error" style="display:none"></small>
				</div>

				<div class="large-6 columns">
					<label>Stock mínimo: </label>
					<input onclick="ocultar_error_stock()" id="stmn" type="text" pattern="[0-9]+" required placeholder="Stock mínimo..." name="stockmin">
				</div>

				<div class="large-6 columns">
					<label>Stock máximo: </label>
					<input onclick="ocultar_error_stock()" id ="stmx" type="text" pattern="[0-9]+" required placeholder="Stock máximo..." name="stockmax">
				</div>

				<div class="large-6 columns">
					<label>Cantidad a ingresar: </label>
					<input id="cnt" type="text" pattern="[0-9]+" onclick="ocultar_error_mayor()" required placeholder="Cantidad..." name="cant">
					<small id="mayor" class="error" style="display:none"></small>
				</div>

				<div class="large-6 columns">
					<label>Dosis por presentación: </label>
					<input type="text" pattern="[1-9]+" required placeholder="Dosis por presentación..." name="unidades">
				</div>
				<div class="large-6 columns" align="right">
					<label>Precio Unitario: </label>
				</div>
				<div class="large-6 columns">
					<input type="text" pattern="[0-9]+[.]{1}[0-9]+" step="0.01" required placeholder="Precio..." name="precio">
				</div>
		</fieldset>
				<div align="center">
					<button type="submit" class="radius round button">Aceptar</button>		
					<a class ="radius round button" id="canbutton" href="iniciar_carga">Cancelar</a>
				</div>
			</form>
	</div>
</div>

<script type="text/javascript">
function agregar_principio(divName)
{
	compActs ++;
	var newdiv = document.createElement('div');
	newdiv.className="large-6 columns";
	newdiv.id="desc"+compActs;
	newdiv.innerHTML = "<br><label>Descripción: </label><input type='text' required placeholder='Descripción' name='descripcion[]'>";
	document.getElementById(divName).appendChild(newdiv);

	newdiv = document.createElement('div');
	newdiv.className="large-6 columns";
	newdiv.id="mili"+compActs;
	newdiv.innerHTML = "<br><label>MGRS: </label><input type='number' required placeholder='Miligramos' name='miligramos[]'>";
	document.getElementById(divName).appendChild(newdiv);
	document.getElementById("addprinc").blur();
}

function remover_principio(divName)
{
	document.getElementById("subprinc").blur();
	if (compActs>0)
	{
		var divi = document.getElementById(divName);

		var descID = 'desc'+compActs;
		var child=document.getElementById(descID);
		divi.removeChild(child);

		descID = 'mili'+compActs;
		child=document.getElementById(descID);
		divi.removeChild(child);
		compActs--;
	}
}

function es_otro(idobjeto)
{
	var seleccion = document.getElementById(idobjeto);
	if(seleccion && seleccion.tagName=="SELECT")
	{
		if (seleccion.options[seleccion.selectedIndex].value == "Otro" || seleccion.options[seleccion.selectedIndex].value == "Otro...")
  		{
  			document.getElementById("otrapres").style.display="inline";
  			document.getElementById("presocul").required=true;
  			document.getElementById("selectpresen").setAttribute("name","presotro");
  			document.getElementById("presocul").setAttribute("name","prese");
  		}else
  		{
  			document.getElementById("otrapres").style.display="none";
  			document.getElementById("presocul").required=false;
  			document.getElementById("presocul").value="";
  			document.getElementById("selectpresen").setAttribute("name","prese");
  			document.getElementById("presocul").setAttribute("name","presotro");
  		}
  	}
}

function ocultar_error_stock()
	{
		document.getElementById("mayorst").style.display="none";
		document.getElementById("mayorst").innerHTML="";
	}

function ocultar_error_mayor()
	{
		document.getElementById("mayor").style.display="none";
		document.getElementById("mayor").innerHTML="";
	}

function comprobar()
{
	var cantidad = parseInt(document.forms["datosmed"]["cnt"].value);
	var stockmax = parseInt(document.forms["datosmed"]["stmx"].value);
	if(cantidad > stockmax)
	{
		document.getElementById("mayor").style.display="block";
		document.getElementById("mayor").innerHTML="La cantidad no debe superar el stock máximo";
		return false;
	}else{
		var stockmin = parseInt(document.forms["datosmed"]["stmn"].value);
		if(stockmin > stockmax)
		{
			document.getElementById("mayorst").style.display="block";
			document.getElementById("mayorst").innerHTML="El stock máximo debe superar el stock mínimo";
			return false;
		}else{
			return true;
		}
	}
}
</script>