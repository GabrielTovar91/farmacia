<?php

class Log_users extends CI_Controller {

	//CONSTRUCTOR
	function __construct()
	{
		parent::__construct();
		$this->load->model('usuarios_model');
	}

	public function index()
	{
		$datauser = $this->usuarios_model->get_datos_usuario($_POST['emailField'],$_POST['passField']);
		if(!$datauser==null)
		{
			$this->session->set_userdata('id_usuario', $datauser->id_usuario);
			$this->session->set_userdata('nombre', $datauser->nombre);
			$this->session->set_userdata('privilegio', $datauser->privilegio);
			$data['titulo'] = 'Menu Principal - Farmacia Pildora Roja';
			$data['contenido_principal'] = $this->load->view('index_main',$data,true); //indicar la vista a cargar
			$this->load->view('template/template',$data);
		}else{
			echo 'Usuario no existe';
		}
	}
}

?>