<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Taches extends CI_Model {

	function getAll()
	{
		return $this->db->get('tache')->result_array();
	}

	function getById($id){
		return $this->db->get_where('tache', array('id' => $id))->row_array();
	}

	function addTache($tache){
		$this->db->insert('tache', $tache);
		return $this->db->insert_id();
	}

	function modifTache($id, $tache){
		$this->db->where('id', $id);
		return $this->db->update('tache', $tache);
	}

	function effacerTache($id){
		return $this->db->delete('tache', array('id' => $id));
	}

}