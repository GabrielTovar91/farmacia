			</div>
			<div id="footer">
				<div class="large-12 small-centered columns", background-color:blue>
				<br>
					<ul class="breadcrumbs">
						<li class="unavailable"><a href="#">Copyright G&G 2014. All rights reserved </a></li>
						<?php
							if($this->session->userdata('id_usuario'))
					            echo '
					                <li>Bienvenid@, '.$this->session->userdata('nombre').' -
					                 <a href="cerrar_sesion">Cerrar sesión</a></li>
								';
						?>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>




