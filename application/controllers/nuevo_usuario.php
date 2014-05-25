<?php
//echo '<pre>'.print_r($this->session->all_userdata(),true).'</pre>';//LINEA UTIL PARA DEPURACION
class Nuevo_usuario extends CI_Controller {

	//CONSTRUCTOR
	function __construct()
	{
		parent::__construct();
		$this->load->model('usuarios_model');
	}


	public function index()
	{
		if($this->session->userdata('id_usuario'))
		{
			$data['titulo'] = 'Menu Principal - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['contenido_principal'] = $this->load->view('index_main',$data,true); //indicar la vista a cargar
			$this->load->view('template/template',$data);
		}else{
			$data['titulo'] = 'Registro de Nuevo Usuario - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['contenido_principal'] = $this->load->view('registro_view',$data,true); //indicar la vista a cargar
			$this->load->view('template/template',$data);
		}
	}

	public function registro()
	{
		if  (!$this->session->userdata('id_usuario')){
			if(!$_POST==null){
				$datauser=null;
				$datauser = $this->usuarios_model->get_datos_usuario($_POST['emailField'],$_POST['passField']);
				if($datauser==null)
				{
					$this->usuarios_model->registrar_usuario($_POST['nameField'],$_POST['passField'],$_POST['emailField'],$_POST['priv']);
					$data['titulo'] = 'Inicio de Sesión - Farmacia Pildora Roja';
					$data['estado'] = 'nuevo';
					$data['contenido_principal'] = $this->load->view('login_view',$data,true); //indicar la vista a cargar
					$this->load->view('template/template',$data);
				}else{
					$data['titulo'] = 'Registro de Nuevo Usuario - Farmacia Pildora Roja';
					$data['estado'] = 'repetido';
					$data['contenido_principal'] = $this->load->view('registro_view',$data,true); //indicar la vista a cargar
					$this->load->view('template/template',$data);
				}
			}else{
				$data['titulo'] = 'Registro de Nuevo Usuario - Farmacia Pildora Roja';
				$data['estado'] = 'espera';
				$data['contenido_principal'] = $this->load->view('registro_view',$data,true); //indicar la vista a cargar
				$this->load->view('template/template',$data);
			}
		}else{
			$data['titulo'] = 'Menu Principal - Farmacia Pildora Roja';
			$data['estado'] = 'ingreso';
			$data['contenido_principal'] = $this->load->view('index_main',$data,true); //indicar la vista a cargar
			$this->load->view('template/template',$data);
		}

	}
}

?>
