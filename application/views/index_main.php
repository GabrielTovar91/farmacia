<div class="row">							
	<div class="large-12 centered columns">
		<fieldset style="border-width: 3px; border-radius: 2em">
			<legend  align="center"><span class="letraB">Notificaciones del Sistema</span></legend><br><br>
			<?php
			$cont=0;
			foreach ($medlogin->result_array() as $fila) {
				if ($fila['cantidad_md']==0){
					echo '
						<p style="color:red">ALERTA: el medicamento '.$fila['nombre_md'].' de Laboratorios '.$fila['laboratorio_md'].' en presentación '.$fila['presentacion_md'].' esta agotado.</p>
					';
					$cont++;
				} else if ($fila['cantidad_md']<$fila['lotemin_md']){
					echo '
						<p style="color:orange">AVISO: el medicamento '.$fila['nombre_md'].' de Laboratorios '.$fila['laboratorio_md'].' en presentación '.$fila['presentacion_md'].' se encuentra por debajo del lote mínimo. Tome sus precauciones.</p>
					';
					$cont++;
				}
				if ($fila['en_unidosis']==0){
					echo '
						<p style="color:orange">AVISO: No hay dosis del medicamento '.$fila['nombre_md'].' de Laboratorios '.$fila['laboratorio_md'].' en presentación '.$fila['presentacion_md'].' en el inventario de Unidosis.</p>
					';
					$cont++;
				}
			}
			if ($cont==0) echo '<p style="color:green">Actualmente no se muestran notificaciones actuales o de caracter urgente.</p>';
			?>
			
		</fieldset>
	</div>
</div>