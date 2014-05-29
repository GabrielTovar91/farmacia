<?php
//Controlador para buscar al usuario que ingresa al sistema
class Log_users extends CI_Controller {

	//CONSTRUCTOR
	function __construct()
	{
		parent::__construct();
		$this->load->model('usuarios_model');
		$this->load->model('medicamentos_model');
	}

	public function index()
	{
		if (!$this->session->userdata('id_usuario')){
			if(!$_POST==null)
			{
				$datauser = $this->usuarios_model->get_datos_usuario($_POST['emailField'],$_POST['passField']);			
				if(!$datauser==null)
				{
					$this->session->set_userdata('id_usuario', $datauser->id_usuario);
					$this->session->set_userdata('nombre', $datauser->nombre);
					$this->session->set_userdata('privilegio', $datauser->privilegio);
					$data['titulo'] = 'Menu Principal - Farmacia Pildora Roja';
					$data['estado'] = 'ingreso';
					$data['medlogin'] = $this->medicamentos_model->get_all_medicamentos();
					$data['contenido_principal'] = $this->load->view('index_main',$data,true); //indicar la vista a cargar
					$this->load->view('template/template',$data);
				}else{
					$data['titulo'] = 'Inicio de Sesión - Farmacia Pildora Roja';
					$data['estado'] = 'negado';
					$data['contenido_principal'] = $this->load->view('login_view',$data,true); //indicar la vista a cargar
					$this->load->view('template/template',$data);
				}
			}else{
				$data['titulo'] = 'Inicio de Sesión - Farmacia Pildora Roja';
				$data['estado'] = 'espera';
				$data['contenido_principal'] = $this->load->view('login_view',$data,true); //indicar la vista a cargar
				$this->load->view('template/template',$data);
			}
		}else{
			$data['titulo'] = 'Menu Principal - Farmacia Pildora Roja';
			$data['estado'] = 'ingreso';
			$data['medlogin'] = $this->medicamentos_model->get_all_medicamentos();
			$data['contenido_principal'] = $this->load->view('index_main',$data,true); //indicar la vista a cargar
			$this->load->view('template/template',$data);
		}
	}
}

?>