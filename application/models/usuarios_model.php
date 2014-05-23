<?php

class Usuarios_model extends CI_Model {

	function get_datos_usuario($correo,$pass)
	{
		$data = array(
			"email"	=>	$correo,
			"password"	=>	$pass
		);
		$query = $this->db->get_where('system_user', $data);
		return $query->row();
	}

}

?>