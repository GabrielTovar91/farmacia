<?php
//Controlador para dar baja a un medicamento

class Consulta_controller extends CI_Controller {

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
			$data['titulo'] = 'Cosulta de Medicamentos - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['contenido_principal'] = $this->load->view('consulta_view',$data,true); //indicar la vista a cargar
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
					$data['titulo'] = 'Consulta de Medicamentos - Farmacia Pildora Roja';
					$data['existe'] = 'no';
					$data['contenido_principal'] = $this->load->view('consulta_view',$data,true); //indicar la vista a cargar
					$this->load->view('template/template',$data);
				}else{
					$data['titulo'] = 'Consulta de Medicamentos - Farmacia Pildora Roja';
					$data['existe'] = 'si';
					$data['medid'] = $consulta->indice_md;
					$data['nom'] = $consulta->nombre_md;
					$data['pres'] = $consulta->presentacion_md;
					$data['lab'] = $consulta->laboratorio_md;
					$data['ctg'] = $consulta->cantidad_md;
					$data['ctu'] = $consulta->en_unidosis;
					$data['pos'] = $consulta->dosis_md;
					$data['pp'] = $consulta->unidades_md;
					$data['smi'] = $consulta->lotemin_md;
					$data['sma'] = $consulta->lotemax_md;
					$data['prin'] = $this->medicamentos_model->get_principios_medi($consulta->indice_md);
					$data['contenido_principal'] = $this->load->view('consulta_view',$data,true); //indicar la vista a cargar
					$this->load->view('template/template',$data);
				}
			}else{
				$data['titulo'] = 'Consulta de Medicamentos - Farmacia Pildora Roja';
				$data['estado'] = 'espera';
				$data['contenido_principal'] = $this->load->view('consulta_view',$data,true); //indicar la vista a cargar
				$this->load->view('template/template',$data);
			}
		}
	}

	public function edit_stock()
	{
		if (!$this->session->userdata('id_usuario')){
			$data['titulo'] = 'Inicio de Sesión - Farmacia Pildora Roja';
			$data['estado'] = 'espera';
			$data['contenido_principal'] = $this->load->view('login_view',$data,true); //indicar la vista a cargar
			$this->load->view('template/template',$data);
		}else{
			if(!$_POST==null)
			{
				$this->medicamentos_model->update_stocks($_POST['index_med'],$_POST['stockmin'],$_POST['stockmax']);
				$consulta = $this->medicamentos_model->get_medicamento_porIndice($_POST['index_med']);
				$data['titulo'] = 'Consulta de Medicamentos - Farmacia Pildora Roja';
				$data['existe'] = 'si';
				$data['medid'] = $consulta->indice_md;
				$data['nom'] = $consulta->nombre_md;
				$data['pres'] = $consulta->presentacion_md;
				$data['lab'] = $consulta->laboratorio_md;
				$data['ctg'] = $consulta->cantidad_md;
				$data['ctu'] = $consulta->en_unidosis;
				$data['pos'] = $consulta->dosis_md;
				$data['pp'] = $consulta->unidades_md;
				$data['smi'] = $consulta->lotemin_md;
				$data['sma'] = $consulta->lotemax_md;
				$data['prin'] = $this->medicamentos_model->get_principios_medi($consulta->indice_md);
				$data['contenido_principal'] = $this->load->view('consulta_view',$data,true); //indicar la vista a cargar
				$this->load->view('template/template',$data);
			}else{
				$data['titulo'] = 'Consulta de Medicamentos - Farmacia Pildora Roja';
				$data['estado'] = 'espera';
				$data['contenido_principal'] = $this->load->view('consulta_view',$data,true); //indicar la vista a cargar
				$this->load->view('template/template',$data);
			}
		}
	}
}