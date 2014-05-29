<?php
class Reportes_controller extends CI_Controller {

		//CONSTRUCTOR
		function __construct(){
			parent::__construct();
			$this->load->model('medicamentos_model');
		}

	public function index()
	{
		if (!$this->session->userdata('id_usuario')){
			$data['titulo'] = 'Inicio de Sesión - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['contenido_principal'] = $this->load->view('login_view',$data,true);
			$this->load->view('template/template',$data);
		}else{
			$data['titulo'] = 'Cosulta de Medicamentos - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['medics'] = $this->medicamentos_model->get_all_medicamentos();
			$data['pas'] = $this->medicamentos_model->get_all_pa();
			$data['lotes'] = $this->medicamentos_model->get_all_lotes();
			$data['contenido_principal'] = $this->load->view('reportes_view',$data,true);
			$this->load->view('template/template',$data);
		}
	}
}