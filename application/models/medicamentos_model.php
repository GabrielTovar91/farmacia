<?php

class Medicamentos_model extends CI_Model {

	function get_indice($nombre,$lab,$pres)
	{
		$indice = null;
		$data = array(
			'nombre_md' => $nombre,
			'laboratorio_md' => $lab,
			'presentacion_md' => $pres
		);
		$query = $this->db->get_where('medicamentos_base',$data);
		foreach ($query->result() as $row)
		{
			$indice = $row->indice_md;
		}
		return $indice;
	}

	function get_lote($indice,$lote)
	{
		$data = array(
			'indice_lote_md' => $indice,
			'numero_lote_md' => $lote
		);
		$query = $this->db->get_where('lotes_md',$data);
		return $query->row();
	}

	function set_medicamento($nombre,$lab,$prese,$dosis,$cant,$stockmin,$stockmax)
	{
		$data = array(
			"nombre_md" => $nombre,
			"laboratorio_md"	=>	$lab,
			"presentacion_md"	=>	$prese,
			"dosis_md"	=>	$dosis,
			"cantidad_md"	=>	$cant,
			"lotemin_md"	=>	$stockmin,
			"lotemax_md" => $stockmax
		);
		$this->db->insert('medicamentos_base',$data);
	}

	function set_lote($indice,$lote,$felab,$fvenci)
	{
		$data = array(
			"indice_lote_md" => $indice,
			"numero_lote_md"	=>	$lote,
			"fechae_lote_md"	=>	$felab,
			"fechav_lote_md"	=>	$fvenci
		);
		$this->db->insert('lotes_md',$data);
	}

	function set_principios($indice,$nombrep,$milip)
	{
		$data = array(
			"indice_pa_md" => $indice,
			"descripcion_pa_md"	=>	$nombrep,
			"miligramos_pa_md"	=>	$milip
		);
		$this->db->insert('principios_activos_md',$data);
	}

	function set_cant($indice,$cant)
	{
		
	}

}

?>