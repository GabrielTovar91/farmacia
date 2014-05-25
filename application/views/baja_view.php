<div class="row">							
	<div class="small-8 small-centered columns">
		<fieldset style="border-width: 3px; border-radius: 2em">
			<legend  align="center"><span class="letraB">Baja de Medicamentos</span></legend><br><br>
			<form data-abide action="#" method="POST">
				<fieldset style="border-width: 3px; border-radius: 2em">
					<legend  align="center">Datos del medicamento</legend><br><br>
					<div class="large-6 columns">
						<label>Nombre: </label>
						<input type="text" required placeholder="Nombre..." name="nombre">
					</div>

					<div class="large-6 columns">
						<label>Presentación: </label>
						<input type="text" required placeholder="Presentación..." name="presen">
					</div>

					<div align="left">
						<div class="large-6 columns" align="left">
							<label>Laboratorio: </label>
							<input type="text" required placeholder="Laboratorio..." name="presen">
						</div>
					</div>
					<div class="large-12 columns" align="center">
						<button type="submit" class="radius round button">Buscar</button>
					</div>
				</fieldset>

				<!-- El otro recuadro de informacio-->
				<fieldset style="border-width: 3px; border-radius: 2em">
					<legend  align="center">Descripción de la baja</legend><br><br>
					<div class="large-12 columns" align="center">
						<label>Inventario afectado</label>
						<input required type="radio" name="invAfec" value="gnral" id="general"><label for="general">General</label>
						<input required type="radio" name="invAfec" value="uni" id="unidosis"><label for="unidosis">Unidosis</label>
					</div>
					
					<div class="large-12 columns" align="left">
						<label for="customDropdown1">Causa de la baja:					
								<select id="customDropdown1" class="medium" required="" data-invalid="">
									<option value="">Seleccione la causa</option>
									<option value="first">Robo</option>
									<option value="second">Pérdida</option>
									<option value="third">Apropiación indebida</option>
									<option value="fourth">Destrucción</option>
									<option value="fifth">Deterioro</option>
									<option value="sixth">Otra causa...</option>
								</select>
						</label>
					</div>

					<div class="large-12 columns">
						<label>Especifique: 
							<textarea required placeholder="Especifique causa de la baja"></textarea>
						</label>
					</div>
  					<div class="large-8 columns" align="left">
  						<label>Cantidad: </label>
						<input type="number" required placeholder="Cantidad..." name="cantidad">
  					</div>
				</fieldset>
		</fieldset>
				<div align="center">
					<button type="submit" class="radius round button">Procesar</button>
					<a class ="radius round button" id="canbutton" href="iniciar_carga">Cancelar</a>	
				</div>
			</form>
	</div>
</div>