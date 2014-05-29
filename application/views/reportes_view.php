<div class="row">
<fieldset style="border-width: 3px; border-radius: 2em">
<legend  align="center"><span class="letraB">Medicamentos en Sistema</span></legend><br><br>
	<table align="center">
		<thead>
			<tr>
				<th>Nombre de Medicamento</th>
				<th>Laboratorio</th>
				<th>Presentación</th>
				<th>Stock Mínimo</th>
				<th>Stock Máximo</th>
				<th>Cantidad Actual</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($medics->result_array() as $fila) {
				echo '
				<tr>
				<td style="display:none"><input type="text" name="index_med[]" value="'.$fila['indice_md'].'"></td>
				<td>'.$fila['nombre_md'].'</td>
				<td>'.$fila['laboratorio_md'].'</td>
				<td>'.$fila['presentacion_md'].'</td>
				<td>'.$fila['lotemin_md'].'</td>
				<td>'.$fila['lotemax_md'].'</td>
				<td>'.$fila['cantidad_md'].'</td>
			</tr>';
			}
			?>
		</tbody>
	</table>
</fieldset>
<fieldset style="border-width: 3px; border-radius: 2em">
<legend  align="center"><span class="letraB">Reportes Avanzados</span></legend><br><br>
	<div class="large-12 centered columns">
		<fieldset style="border-width: 3px; border-radius: 2em">
		<legend  align="center"><span class="letraB">Por Estado</span></legend><br><br>
			<div class="large-6 centered columns">
			<b>Agotados</b>
			<table align="center">
					<thead>
						<tr>
							<th>Nombre de Medicamento</th>
							<th>Laboratorio</th>
							<th>Presentación</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($medics->result_array() as $fila) {
							if ($fila['cantidad_md']==0)
							echo '
							<tr>
								<td>'.$fila['nombre_md'].'</td>
								<td>'.$fila['laboratorio_md'].'</td>
								<td>'.$fila['presentacion_md'].'</td>
							</tr>';
						}
						?>
					</tbody>
			</table>
			</div>
			<div class="large-6 centered columns">
			<b>En stock Mínimo</b>
			<table align="center">
					<thead>
						<tr>
							<th>Nombre de Medicamento</th>
							<th>Laboratorio</th>
							<th>Presentación</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($medics->result_array() as $fila) {
							if ($fila['cantidad_md']<$fila['lotemin_md'])
							echo '
							<tr>
								<td>'.$fila['nombre_md'].'</td>
								<td>'.$fila['laboratorio_md'].'</td>
								<td>'.$fila['presentacion_md'].'</td>
							</tr>';
						}
						?>
					</tbody>
			</table>
			</div>
		</fieldset>
		<!--REPORTES DE PRINCIPIOS ACTIVOS POR MEDICAMENTOS-->
		<div class="large-6 centered columns">
		<fieldset style="border-width: 3px; border-radius: 2em">
		<legend  align="center">Principios Activos por Medicamento</legend><br><br>
			<?php
			foreach ($medics->result_array() as $filasm)
			{
				echo $filasm['nombre_md'].', '.$filasm['laboratorio_md'].', '.$filasm['presentacion_md'];
				echo '<label align="center"><b>Principio(s) Activo(s):</b></label>
							<table align="center">
								<thead>
									<tr>
										<th>Descripción:</th>
										<th>Cantidad (mgrs):</th>
									</tr>
								</thead>
								<tbody>';
									foreach ($pas->result_array() as $filasp) {
										if ($filasm['indice_md']==$filasp['indice_pa_md'])echo '
										<tr>
											<td>'.$filasp['descripcion_pa_md'].'</td>
											<td>'.$filasp['miligramos_pa_md'].'</td>
										</tr>';
									}
						echo'	</tbody></table>';
			}
			?>
		</fieldset>
		</div>
		<!--REPORTES DE LOTES DE MEDICAMENTOS-->
		<div class="large-6 centered columns">
		<fieldset style="border-width: 3px; border-radius: 2em">
		<legend  align="center">Lotes por Medicamento</legend><br><br>
			<?php
			foreach ($medics->result_array() as $filasm)
			{
				echo $filasm['nombre_md'].', '.$filasm['laboratorio_md'].', '.$filasm['presentacion_md'];
				echo '		<table align="center">
								<thead>
									<tr>
										<th>Lote:</th>
										<th>F.Elab:</th>
										<th>F.Venc:</th>
									</tr>
								</thead>
								<tbody>';
									foreach ($lotes->result_array() as $filasp) {
										if ($filasm['indice_md']==$filasp['indice_lote_md'])echo '
										<tr>
											<td>'.$filasp['numero_lote_md'].'</td>
											<td>'.$filasp['fechae_lote_md'].'</td>
											<td>'.$filasp['fechav_lote_md'].'</td>
										</tr>';
									}
						echo'	</tbody></table>';
			}
			?>
		</fieldset>
		</div>
		<!--FIN REPORTES-->
	</div>
</fieldset>
<div align="center">
	<a class ="radius round button" id="canbutton" href="iniciar_carga">Volver</a>	
</div>
</div>
