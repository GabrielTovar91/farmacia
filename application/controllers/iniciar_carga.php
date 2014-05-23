<?php
//echo '<pre>'.print_r($this->session->all_userdata(),true).'</pre>';//LINEA UTIL PARA DEPURACION
class Iniciar_carga extends CI_Controller {

	//CONSTRUCTOR
	function __construct()
	{
		parent::__construct();
	}


	public function index()
	{
		if($this->session->userdata('id_usuario'))
		{
			$data['titulo'] = 'Menu Principal - Farmacia Pildora Roja';
			$data['contenido_principal'] = $this->load->view('index_main',$data,true); //indicar la vista a cargar
			$this->load->view('template/template',$data);
		}
		else
		{
			$data['titulo'] = 'Inicio de Sesión - Farmacia Pildora Roja';
			$data['contenido_principal'] = $this->load->view('login_view',$data,true); //indicar la vista a cargar
			$this->load->view('template/template',$data);
		}
	}
}

?>
