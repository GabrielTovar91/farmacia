<?php
//Controlador para buscar al usuario que ingresa al sistema

class Alta_controller extends CI_Controller {

		//CONSTRUCTOR
		function __construct(){
			parent::__construct();
		}

	public function index(){
		if (!$this->session->userdata('id_usuario')){
			$data['titulo'] = 'Inicio de Sesión - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['contenido_principal'] = $this->load->view('login_view',$data,true); //indicar la vista a cargar
			$this->load->view('template/template',$data);
		}else{
			$data['titulo'] = 'Alta de Medicamentos - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['contenido_principal'] = $this->load->view('alta_view',$data,true); //indicar la vista a cargar
			$this->load->view('template/template',$data);
		}
	}
}