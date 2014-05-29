<div class="row">							
	<div class="small-8 small-centered columns">
		<fieldset style="border-width: 3px; border-radius: 2em">
			<legend  align="center"><span class="letraB">Consulta de Medicamentos</span></legend><br><br>
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
						<div class="large-12 columns" align="left">
							<br>								
							<label align="center"><b>Principio(s) Activo(s):</b></label>
							<br>
							<table align="center">
								<thead>
									<tr>
										<th>Descripción:</th>
										<th>Cantidad (mgrs):</th>
									</tr>
								</thead>
								<tbody>';
									foreach ($prin->result_array() as $fila) {
										echo '
										<tr>
											<td>'.$fila['descripcion_pa_md'].'</td>
											<td>'.$fila['miligramos_pa_md'].'</td>
										</tr>';
									}
						echo'	</tbody>
							</table><br>
						</div>
						<div class="large-6 columns" align="left">
							<label>Cantidad Actual en General: </label>
							'.$ctg.'
						</div>
						<div class="large-6 columns" align="left">
							<label>Cantidad Actual en Unidosis: </label>
							'.$ctu.'
						</div>
						<div class="large-12 columns" align="left">
							<br><label>Posologia:</label>
							'.$pos.'
						</div>
						<div class="large-6 columns" align="left">
							<br><label>Contiene:</label>
							'.$pp.' unidades (Por presentación).
						</div>
						<div class="large-6 columns" align="left">
							<br><label>Precio Unitario:</label>
							'.$sell.' BsF.
						</div>
						';
					}else{
						if (isset($existe) && $existe=='no') echo '<small id="no_existe" class="error">El medicamento ingresado no se encuentra registrado en su sistema. Intente de nuevo</small>';
						echo '
						<form data-abide action="consulta_controller/buscar_med" method="POST">
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
					<input type="text" id="cantidact" value="'.$ctg.'" style="display:none">
					<form data-abide name="fstocks" action="consulta_controller/edit_stock" onsubmit="return checkstocks()" method="POST">
					<input type="text" name="index_med" value="'.$medid.'" style="display:none">
					<fieldset style="border-width: 3px; border-radius: 2em">
						<legend  align="center">Datos de stock del Medicamento</legend><br><br>';
						echo '
						<div class="large-12 columns">
							<small id="mayorst" class="error" style="display:none"></small>
						</div>
						<div class="large-6 columns">
							<label>Stock mínimo: </label>
							<input id ="stmn" type="text" onclick="ocultar_error_stock()" pattern="[0-9]+" required placeholder="Stock mínimo..." name="stockmin" value="'.$smi.'" readonly>
						</div>
						<div class="large-6 columns">
							<label>Stock máximo: </label>
							<input id ="stmx" type="text" onclick="ocultar_error_stock()" pattern="[0-9]+" required placeholder="Stock máximo..." name="stockmax" value="'.$sma.'" readonly>
						</div>
					<div align="center" id="botones">';
						if ($this->session->userdata('privilegio')==0) echo '
						<a class ="radius round button" id="editbutton" onclick="edit_true()">Habilitar Edición</a>
						<button id="setchange" name="aplibutton" type="submit" class="radius round button" style="display:none">Aplicar Cambios</button>
						<a class ="radius round button" id="canbutton" style="display:none" onclick="edit_false()">Cancelar</a>';
						echo '
					</div>
					</form>
					</fieldset>
					<div align="center">
						<a class ="radius round button" id="volbutton" href="iniciar_carga" >Volver</a>
					</div>';
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

<script type="text/javascript">
	
	var maxst=0;
	var minst=0;

	function edit_true()
	{
  		document.getElementById("stmn").readOnly=false;
  		document.getElementById("stmx").readOnly=false;
  		minst = document.getElementById("stmn").value;
  		maxst = document.getElementById("stmx").value;
  		document.getElementById("setchange").style.display="inline";
  		document.getElementById("canbutton").style.display="inline";
  		document.getElementById("editbutton").style.display="none";
	}

	function edit_false()
	{
		document.getElementById("stmn").readOnly=true;
  		document.getElementById("stmx").readOnly=true;
  		document.getElementById("stmn").value=minst;
  		document.getElementById("stmx").value=maxst;
  		document.getElementById("setchange").style.display="none";
  		document.getElementById("canbutton").style.display="none";
  		document.getElementById("editbutton").style.display="inline-block";
	}

	function ocultar_error_stock()
	{
		document.getElementById("mayorst").style.display="none";
		document.getElementById("mayorst").innerHTML="";
	}

	function checkstocks()
	{
		/*var stockmin = document.forms["fstocks"]["stmn"].value;
		var stockmax = document.forms["fstocks"]["stmx"].value;*/
		if(parseInt(document.getElementById("stmn").value) > parseInt(document.getElementById("stmx").value))
		{
			document.getElementById("mayorst").style.display="block";
			document.getElementById("mayorst").innerHTML="El stock máximo debe superar el stock mínimo";
			return false;
		}else{
			if(parseInt(document.getElementById("cantidact").value) > parseInt(document.getElementById("stmx").value))
			{
				document.getElementById("mayorst").style.display="block";
				document.getElementById("mayorst").innerHTML="El stock máximo debe superar la cantidad actual en inventario general";
				return false;
			}else{
				return true;
			}
		}
	}

</script>
