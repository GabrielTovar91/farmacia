<?php
//Controlador para buscar al usuario que ingresa al sistema

class Traspaso_controller extends CI_Controller {

	//CONSTRUCTOR
	function __construct(){
		parent::__construct();
		$this->load->model('medicamentos_model');
	}

	//FUNCIONES
	public function index()
	{
		if (!$this->session->userdata('id_usuario')){
			$data['titulo'] = 'Inicio de Sesión - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['contenido_principal'] = $this->load->view('login_view',$data,true);
			$this->load->view('template/template',$data);
		}else{
			$data['titulo'] = 'Traspaso de Bienes - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['medics'] = $this->medicamentos_model->get_all_medicamentos();
			$data['contenido_principal'] = $this->load->view('traspaso_view1',$data,true);
			$this->load->view('template/template',$data);
		}
	}

	public function aplicar_traspasos()
	{
		if (!$this->session->userdata('id_usuario')){
			$data['titulo'] = 'Inicio de Sesión - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['contenido_principal'] = $this->load->view('login_view',$data,true);
			$this->load->view('template/template',$data);
		}else{
			if(!$_POST==null)
			{
				$indices = $_POST["index_med"];
				$tipos = $_POST["traspaso"];
				$cantidad = $_POST["cantidad"];
				for($i=0;$i<count($indices);$i++)
				{
					if($tipos[$i]==1) $this->medicamentos_model->trasp_gtu($indices[$i],$cantidad[$i]);
					else if($tipos[$i]==2) $this->medicamentos_model->trasp_gtv($indices[$i],$cantidad[$i]);
					else if($tipos[$i]==3) $this->medicamentos_model->trasp_utv($indices[$i],$cantidad[$i]);
				}
				$data['titulo'] = 'Menu Principal - Farmacia Pildora Roja';
				$data['estado'] = 'traspasados';
				$data['contenido_principal'] = $this->load->view('index_main',$data,true); //indicar la vista a cargar
				$this->load->view('template/template',$data);
			}else{
				$data['titulo'] = 'Traspaso de Bienes - Farmacia Pildora Roja';
				$data['estado'] = 'espera';
				$data['medics'] = $this->medicamentos_model->get_all_medicamentos();
				$data['contenido_principal'] = $this->load->view('traspaso_view1',$data,true);
				$this->load->view('template/template',$data);		
			}
		}
	}
}
?>