<?php

class Medicamentos_model extends CI_Model {

	function get_medicamento($nombre,$lab,$pres)
	{
		$data = array(
			'nombre_md' => $nombre,
			'laboratorio_md' => $lab,
			'presentacion_md' => $pres
		);
		$query = $this->db->get_where('medicamentos_base',$data);
		return $query->row();
	}

	function get_all_medicamentos()
	{
		$query = $this->db->get('medicamentos_base');
		return $query;
	}

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

	function set_cant($indice,$cant)
	{
		$data = array(
			"cantidad_md"	=>	$cant,
		);
		$this->db->where('indice_md', $indice);
		$this->db->update('medicamentos_base',$data); 
	}

	function set_medicamento($nombre,$lab,$prese,$dosis,$cant,$stockmin,$stockmax,$unidades)
	{
		$data = array(
			"nombre_md" => $nombre,
			"laboratorio_md"	=>	$lab,
			"presentacion_md"	=>	$prese,
			"dosis_md"	=>	$dosis,
			"cantidad_md"	=>	$cant,
			"lotemin_md"	=>	$stockmin,
			"lotemax_md" => $stockmax,
			"unidades_md" => $unidades
		);
		$this->db->insert('medicamentos_base',$data);
	}

	function set_lote($indice,$lote,$felab,$fvenci,$cant)
	{
		$data = array(
			"indice_lote_md" => $indice,
			"numero_lote_md"	=>	$lote,
			"fechae_lote_md"	=>	$felab,
			"fechav_lote_md"	=>	$fvenci,
			"cantidad_lote_md"	=>	$cant
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

	function trasp_gtu($indice,$cantidad)//General a Unidosis
	{
		$data = array(
			"indice_md" => $indice
		);
		$fila = $this->db->get_where('medicamentos_base',$data);
		foreach ($fila->result() as $row)
		{
			if($row->cantidad_md >= $cantidad)
			{
				$data = array(
					"cantidad_md" => $row->cantidad_md - $cantidad,
					"en_unidosis" => $row->en_unidosis + ($cantidad * $row->unidades_md)
				);
				$this->db->where('indice_md', $indice);
				$this->db->update('medicamentos_base',$data);
			}
		}
	}

	function trasp_gtv($indice,$cantidad)//General a ventas
	{
		$data = array(
			"indice_md" => $indice
		);
		$fila = $this->db->get_where('medicamentos_base',$data);
		foreach ($fila->result() as $row)
		{
			if($row->cantidad_md >= $cantidad)
			{
				$data = array(
					"cantidad_md" => $row->cantidad_md - $cantidad
				);
				$this->db->where('indice_md', $indice);
				$this->db->update('medicamentos_base',$data);
			}
		}
	}

	function trasp_utv($indice,$cantidad)//Unidosis a Ventas
	{
		$data = array(
			"indice_md" => $indice
		);
		$fila = $this->db->get_where('medicamentos_base',$data);
		foreach ($fila->result() as $row)
		{
			if($row->en_unidosis >= $cantidad)
			{
				$data = array(
					"en_unidosis" => $row->en_unidosis - $cantidad
				);
				$this->db->where('indice_md', $indice);
				$this->db->update('medicamentos_base',$data);
			}
		}
	}

	function set_baja($indice,$inv,$cant)
	{
		$data = array(
			"indice_md" => $indice
		);
		$fila = $this->db->get_where('medicamentos_base',$data);
		if ($inv=='gnr')
		{
			foreach ($fila->result() as $row)
			{
				if($row->cantidad_md >= $cant)
				{
					$data = array(
						"cantidad_md" => $row->cantidad_md - $cant
					);
					$this->db->where('indice_md', $indice);
					$this->db->update('medicamentos_base',$data);
				}
			}
		}else{
			foreach ($fila->result() as $row)
			{
				if($row->en_unidosis >= $cant)
				{
					$data = array(
						"en_unidosis" => $row->en_unidosis - $cant
					);
					$this->db->where('indice_md', $indice);
					$this->db->update('medicamentos_base',$data);
				}
			}
		}
	}
}

?>