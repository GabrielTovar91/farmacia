<?php
//Controlador para dar baja a un medicamento

class Baja_controller extends CI_Controller {

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
			$data['contenido_principal'] = $this->load->view('login_view',$data,true); //indicar la vista a cargar
			$this->load->view('template/template',$data);
		}else{
			$data['titulo'] = 'Baja de Medicamentos - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['contenido_principal'] = $this->load->view('baja_view',$data,true); //indicar la vista a cargar
			$this->load->view('template/template',$data);
		}
	}

	public function buscar_med()
	{
		if (!$this->session->userdata('id_usuario')){
			$data['titulo'] = 'Inicio de Sesión - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['contenido_principal'] = $this->load->view('login_view',$data,true); //indicar la vista a cargar
			$this->load->view('template/template',$data);
		}else{
			if(!$_POST==null)
			{
				$consulta = $this->medicamentos_model->get_medicamento($_POST['nom'],$_POST['lab'],$_POST['pres']);
				if ($consulta==null)
				{
					$data['titulo'] = 'Baja de Medicamentos - Farmacia Pildora Roja';
					$data['existe'] = 'no';
					$data['contenido_principal'] = $this->load->view('baja_view',$data,true); //indicar la vista a cargar
					$this->load->view('template/template',$data);
				}else{
					$data['titulo'] = 'Baja de Medicamentos - Farmacia Pildora Roja';
					$data['existe'] = 'si';
					$data['medid'] = $consulta->indice_md;
					$data['nom'] = $consulta->nombre_md;
					$data['pres'] = $consulta->presentacion_md;
					$data['lab'] = $consulta->laboratorio_md;
					$data['ctg'] = $consulta->cantidad_md;
					$data['ctu'] = $consulta->en_unidosis;
					$data['contenido_principal'] = $this->load->view('baja_view',$data,true); //indicar la vista a cargar
					$this->load->view('template/template',$data);
				}
			}else{
				$data['titulo'] = 'Baja de Medicamentos - Farmacia Pildora Roja';
				$data['estado'] = 'espera';
				$data['contenido_principal'] = $this->load->view('baja_view',$data,true); //indicar la vista a cargar
				$this->load->view('template/template',$data);
			}
		}
	}

	public function procesar_baja()
	{
		if (!$this->session->userdata('id_usuario')){
			$data['titulo'] = 'Inicio de Sesión - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['contenido_principal'] = $this->load->view('login_view',$data,true); //indicar la vista a cargar
			$this->load->view('template/template',$data);
		}else{
			if(!$_POST==null)
			{
				$efectuada = $this->medicamentos_model->set_baja($_POST['index_med'],$_POST['invAfec'],$_POST['cantidad']);
				if($efectuada){
					$data['titulo'] = 'Menu Principal - Farmacia Pildora Roja';
					$data['estado'] = 'bajaproc';
					$data['contenido_principal'] = $this->load->view('index_main',$data,true); //indicar la vista a cargar
					$this->load->view('template/template',$data);
				}else{
					$consulta = $this->medicamentos_model->get_medicamento_porIndice($_POST['index_med']);
					$data['titulo'] = 'Baja de Medicamentos - Farmacia Pildora Roja';
					$data['estado'] = 'incorrecto';
					$data['existe'] = 'si';
					$data['medid'] = $consulta->indice_md;
					$data['nom'] = $consulta->nombre_md;
					$data['pres'] = $consulta->presentacion_md;
					$data['lab'] = $consulta->laboratorio_md;
					$data['ctg'] = $consulta->cantidad_md;
					$data['ctu'] = $consulta->en_unidosis;
					$data['contenido_principal'] = $this->load->view('baja_view',$data,true); //indicar la vista a cargar
					$this->load->view('template/template',$data);
				}
			}else{
				$data['titulo'] = 'Baja de Medicamentos - Farmacia Pildora Roja';
				$data['estado'] = 'espera';
				$data['contenido_principal'] = $this->load->view('baja_view',$data,true); //indicar la vista a cargar
				$this->load->view('template/template',$data);
			}
		}
	}
}