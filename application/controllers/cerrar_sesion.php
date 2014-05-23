<?php
//echo '<pre>'.print_r($this->session->all_userdata(),true).'</pre>';//LINEA UTIL PARA DEPURACION
class Cerrar_sesion extends CI_Controller {

	//CONSTRUCTOR
	function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		$this->session->sess_destroy();
		$data['titulo'] = 'Inicio de Sesión - Farmacia Pildora Roja';
		$data['contenido_principal'] = $this->load->view('login_view',$data,true); //indicar la vista a cargar
		$this->load->view('template/template',$data);
	}
}

?>
