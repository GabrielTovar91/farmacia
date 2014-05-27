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
				if($indice==null)//Si el medicamento no se encuentra registrado, lo registra
				{
					$this->medicamentos_model->set_medicamento($_POST['nombre'],$_POST['lab'],$_POST['prese'],$_POST['dosis'],$_POST['cant'],$_POST['stockmin'],$_POST['stockmax'],$_POST['unidades']);
					$indice = $this->obtener_indice($_POST['nombre'],$_POST['lab'],$_POST['prese']);
					$this->medicamentos_model->set_lote($indice,$_POST['lote'],$_POST['felab'],$_POST['fvenci'],$_POST['cant']);
					$nombrep = $_POST["descripcion"];
					$milip = $_POST["miligramos"];
					for($i=0;$i<count($nombrep);$i++)
					{
					     $this->medicamentos_model->set_principios($indice,$nombrep[$i],$milip[$i]);
					}
					$data['titulo'] = 'Menu Principal - Farmacia Pildora Roja';
					$data['estado'] = 'ingresomedic';
					$data['contenido_principal'] = $this->load->view('index_main',$data,true); //indicar la vista a cargar
					$this->load->view('template/template',$data);
				}else{//Si esta registrado, verifica si el lote a ingresar se encuentra registrado
					$existelote = $this->medicamentos_model->get_lote($indice,$_POST['lote']);
					if ($existelote==null)//Si el lote no se encuentra registrado, verifica si la cantidad supera el stock maximo del medicamento
					{
						$consulta = $this->medicamentos_model->get_medicamento($_POST['nombre'],$_POST['lab'],$_POST['prese']);
						if (($consulta->cantidad_md + $_POST['cant']) < $consulta->lotemax_md)
						{
							$this->medicamentos_model->set_lote($indice,$_POST['lote'],$_POST['felab'],$_POST['fvenci'],$_POST['cant']);
							$this->medicamentos_model->set_cant($indice,$_POST['cant'] + $consulta->cantidad_md);
							$data['titulo'] = 'Menu Principal - Farmacia Pildora Roja';
							$data['estado'] = 'ingresolote';
							$data['contenido_principal'] = $this->load->view('index_main',$data,true); //indicar la vista a cargar
							$this->load->view('template/template',$data);
						}else{
							$data['titulo'] = 'Alta de Medicamentos - Farmacia Pildora Roja';
							$data['estado'] = 'excedeMax';
							$data['restante'] = $consulta->lotemax_md - $consulta->cantidad_md;
							$data['contenido_principal'] = $this->load->view('alta_view',$data,true); //indicar la vista a cargar
							$this->load->view('template/template',$data);
						}
					}else{
						$data['titulo'] = 'Alta de Medicamentos - Farmacia Pildora Roja';
						$data['estado'] = 'existelote';
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