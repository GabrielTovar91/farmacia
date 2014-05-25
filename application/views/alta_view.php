<div class="row">							
	<div class="small-8 small-centered columns">
		<fieldset style="border-width: 3px; border-radius: 2em">
			<legend  align="center"><span class="letraB">Alta de Medicamentos</span></legend><br><br>
			<form data-abide action="#" method="POST">
				
				<div align="center">
					<div style="width: 90%" align="left">
						<label>Nombre: </label>
						<input type="text" required placeholder="Nombre del medicamento" name="nombre">
						<small class="error">Se requiere un nombre.</small>
					</div>
				</div>
				<div align="center"><br>Principio (s) Activo (s):<br></div>
				<!-- Este contenido debe ser generado dinámicamente al clickear en la cruz -->
				<div id="dinamic_principio">
					<div class="large-6 columns">
						<label><br>Descripción: </label>
						<input type="text" required placeholder="Descripción" name="descripcion[]">
					</div>

					<div class="large-6 columns">
						<label><br>MGRS: </label>
						<input type="number" required placeholder="Miligramos" name="miligramos[]">
					</div>
				</div>
				<!-- Fin de contenido dinámico -->
				<div align="center">
					<input type="button" class ="radius round button" value="Agregar otro" id="addprinc" onClick="agregar_principio('dinamic_principio');">
				</div>
				
				<br>
				<div class="large-6 columns">
					<label>Laboratorio: </label>
					<input type="text" required placeholder="Nombre del laboratorio" name="lab">
				</div>
			
				<div class="large-6 columns">
					<label for="customDropdown1">Presentación:
						<select id="customDropdown1" class="medium" required="" data-invalid="">
							<option value="">Seleccione su presentación</option>
							<option value="first">Comprimidos</option>
							<option value="second">Capsulas blandas</option>
							<option value="third">Jarabe</option>
							<option value="fourth">Solución Inyectable</option>
							<option value="fifth">Otro...</option>
						</select>
					</label>
				</div>

				<div class="large-6 columns">
					<label>Dosis: </label>
					<input type="text" required placeholder="Dosis..." name="dosis">
				</div>

				<div class="large-6 columns">
					<label>Lote: </label>
					<input type="text" required placeholder="Dosis del medicamento..." name="lote">
				</div>

				<div class="large-6 columns">
					<label>F. Elaboración: </label>
					<input type="date" required placeholder="DD/MM/AAAA" name="felab">
				</div>

				<div class="large-6 columns">
					<label>F. Vencimiento: </label>
					<input type="date" required placeholder="DD/MM/AAAA" name="fvenci">
				</div>

				<div align="center">
					<div style="width: 50%" align="left">
						<label>Precio Unitario: </label>
						<input type="number" required placeholder="Precio..." name="precio">
					</div>
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
var compActs = 1;
function agregar_principio(divName){
	var newdiv = document.createElement('div');
	newdiv.className="large-6 columns"
	newdiv.innerHTML = "<br><label>Descripción: </label><input type='text' required placeholder='Descripción' name='descripcion[]'>";
	document.getElementById(divName).appendChild(newdiv);

	newdiv = document.createElement('div');
	newdiv.className="large-6 columns"
	newdiv.innerHTML = "<br><label>MGRS: </label><input type='number' required placeholder='Miligramos' name='miligramos[]'>";
	document.getElementById(divName).appendChild(newdiv);
	compActs
}
</script>