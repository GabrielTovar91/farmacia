<?php
//Controlador para buscar al usuario que ingresa al sistema

class Alta_controller extends CI_Controller {

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
			$data['titulo'] = 'Alta de Medicamentos - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['contenido_principal'] = $this->load->view('alta_view',$data,true); //indicar la vista a cargar
			$this->load->view('template/template',$data);
		}
	}

	public function obtener_indice($nombre,$lab,$presentacion)
	{
		return $this->medicamentos_model->get_indice($nombre,$lab,$presentacion);
	}

	public function registrar_medicamento()
	{
		if  (!$this->session->userdata('id_usuario'))
		{
			$data['titulo'] = 'Inicio de Sesión - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['contenido_principal'] = $this->load->view('login_view',$data,true);
			$this->load->view('template/template',$data);
		}else{
			if(!$_POST==null)
			{
				$indice = $this->obtener_indice($_POST['nombre'],$_POST['lab'],$_POST['prese']);
				if($indice==null)
				{
					$this->medicamentos_model->set_medicamento($_POST['nombre'],$_POST['lab'],$_POST['prese'],$_POST['dosis'],$_POST['cant'],$_POST['stockmin'],$_POST['stockmax']);
					$indice = $this->obtener_indice($_POST['nombre'],$_POST['lab'],$_POST['prese']);
					$this->medicamentos_model->set_lote($indice,$_POST['lote'],$_POST['felab'],$_POST['fvenci']);
					$nombrep = $_POST["descripcion"];
					$milip = $_POST["miligramos"];
					for($i=0;$i<count($nombrep);$i++)
					{
					     $this->medicamentos_model->set_principios($indice,$nombrep[$i],$milip[$i]);
					}
					$data['titulo'] = 'Menu Principal - Farmacia Pildora Roja';
					$data['estado'] = 'ingreso';
					$data['contenido_principal'] = $this->load->view('index_main',$data,true); //indicar la vista a cargar
					$this->load->view('template/template',$data);
				}else{
					$existelote = $this->medicamentos_model->get_lote($indice,$_POST['lote']);
					if ($existelote==null)
					{
						$this->medicamentos_model->set_lote($indice,$_POST['lote'],$_POST['felab'],$_POST['fvenci']);
						$this->medicamentos_model->set_cant($indice,$_POST['cant']);
						$data['titulo'] = 'Menu Principal - Farmacia Pildora Roja';
						$data['estado'] = 'ingreso';
						$data['contenido_principal'] = $this->load->view('index_main',$data,true); //indicar la vista a cargar
						$this->load->view('template/template',$data);
					}else{
						$data['titulo'] = 'Alta de Medicamentos - Farmacia Pildora Roja';
						$data['estado'] = 'existeMed';
						$data['contenido_principal'] = $this->load->view('alta_view',$data,true); //indicar la vista a cargar
						$this->load->view('template/template',$data);
					}
				}
			}else{
				$data['titulo'] = 'Alta de Medicamentos - Farmacia Pildora Roja';
				$data['estado'] = 'espera';
				$data['contenido_principal'] = $this->load->view('alta_view',$data,true); //indicar la vista a cargar
				$this->load->view('template/template',$data);
			}
		}
	}
}