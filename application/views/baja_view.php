<div class="row">							
	<div class="small-8 small-centered columns">
		<fieldset style="border-width: 3px; border-radius: 2em">
			<legend  align="center"><span class="letraB">Baja de Medicamentos</span></legend><br><br>
				<fieldset style="border-width: 3px; border-radius: 2em">
					<legend  align="center">Datos del medicamento</legend><br><br>
					<?php
					if (isset($existe) && $existe=='si')
					{
						echo
						'<div class="large-6 columns">
							<label>Nombre: </label>
							'.$nom.'
						</div>

						<div class="large-6 columns">
							<label>Presentación: </label>
							'.$pres.'
						</div>
						<div class="large-6 columns" align="left">
							<label>Laboratorio: </label>
							'.$lab.'
						</div>
						<div class="large-6 columns" align="left">
							<label>Cantidad Actual en General: </label>
							'.$ctg.'
						</div>
						<div class="large-6 columns" align="left">
							<label>Cantidad Actual en Unidosis: </label>
							'.$ctu.'
						</div>
						';
					}else{
						if (isset($existe) && $existe=='no') echo '<small id="no_existe" class="error">El medicamento ingresado no se encuentra registrado en su sistema. Intente de nuevo</small>';
						echo '
						<form data-abide action="baja_controller/buscar_med" method="POST">
						<div class="large-6 columns">
							<label>Nombre: </label>
							<input type="text" required placeholder="Nombre..." name="nom">
						</div>

						<div class="large-6 columns" align="left">
							<label>Laboratorio: </label>
							<input type="text" required placeholder="Laboratorio..." name="lab">
						</div>
						
						<div class="large-6 columns">
							<label>Presentación: </label>
							<input type="text" required placeholder="Presentación..." name="pres">
						</div>

						<div class="large-12 columns" align="center">
							<button type="submit" class="radius round button">Buscar</button>
						</div>
						</form>
						';
					}
					?>
				</fieldset>

				<!-- El otro recuadro de informacion-->
				<?php
				if(isset($existe)&&$existe=='si'){
					echo '
					<fieldset style="border-width: 3px; border-radius: 2em">
						<legend  align="center">Descripción de la baja</legend><br><br>
						<form data-abide action="baja_controller/procesar_baja" method="POST">
						<input type="text" name="index_med" style="display:none" value="'.$medid.'">
						<div class="large-12 columns" align="center">
							<label>Inventario afectado</label>
							<input required type="radio" name="invAfec" value="gnr" id="general"><label for="general">General</label>
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

						<div class="large-4 columns">
							<label>Fecha: </label>
							<input type="text" readonly name="fecha" value="'.date('m-d-Y').'">
						</div>
	  					<div class="large-8 columns" align="left">
	  						<label>Cantidad: </label>
							<input type="number" required placeholder="Cantidad..." name="cantidad">
	  					</div>
	  					<div class="large-12 columns">
							<label>Descripción: 
								<textarea required placeholder="Especifique..."></textarea>
							</label>
						</div>
					</fieldset>
					<div align="center">
						<button type="submit" class="radius round button">Procesar</button>
						<a class ="radius round button" id="canbutton" href="iniciar_carga">Cancelar</a>	
					</div>
					</form>';
				}else{
					echo'
						<div align="center">
							<a class ="radius round button" id="canbutton" href="iniciar_carga">Cancelar</a>	
						</div>
					';
				}
				?>
		</fieldset>
		</form>
	</div>
</div>