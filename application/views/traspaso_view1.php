<div class="row">
<form data-abide name="procesatras" action="traspaso_controller/aplicar_traspasos" method="POST">
	<fieldset style="border-width: 3px; border-radius: 2em">
	<legend  align="center"><span class="letraB">Traspaso de Bienes</span></legend><br><br>
	<table>
		<thead>
			<tr>
				<th style="display:none">indice_bd</th>
				<th>Nombre de Medicamento</th>
				<th>Laboratorio</th>
				<th>Presentación</th>
				<th>Cantidad en General</th>
				<th>Cantidad en Unidosis</th>
				<th width="200">Traspasos Disponibles</th>
				<th>Cantidad a Traspasar</th>
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
				<td>'.$fila['cantidad_md'].'</td>
				<td>'.$fila['en_unidosis'].'</td>
				<td>
					<select id="tipotras" required name="traspaso[]">
						<option value="0">Ninguno</option>';
						if ($fila['cantidad_md']>0)
							echo'<option value="1">De general a unidosis</option>
						<option value="2">De general a ventas</option>';
						if ($fila['en_unidosis']>0)
							echo'<option value="3">De unidosis a ventas</option>';
					echo'</select>
				</td>
				<td><input type="number" min="0" required placeholder="Cantidad..." name="cantidad[]" value="0"></td>
			</tr>';
			}
			?>
		</tbody>
	</table>
	<div align="center">
		<button type="submit" class="radius round button">Procesar</button>
		<a class ="radius round button" id="canbutton" href="iniciar_carga">Volver</a>	
	</div>
	</fieldset>
</form>
</div>