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

	function registrar_usuario($nombre,$pass,$correo,$priv)
	{
		$data = array(
			"nombre" => $nombre,
			"password"	=>	$pass,
			"email"	=>	$correo,
			"privilegio" =>$priv
		);
		$this->db->insert('system_user',$data);
	}
}

?>