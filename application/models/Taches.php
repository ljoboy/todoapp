<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Taches extends CI_Model
{

	function getAll()
	{
		$this->db->order_by('id', 'asc');
		return $this->db->get('tache')->result();
	}

	function getById($id)
	{
		return $this->db->get_where('tache', array('id' => $id))->row();
	}

	function addTache($tache)
	{
		$this->db->insert('tache', $tache);
		return $this->db->insert_id();
	}

	function modifTache($id, $tache)
	{
		$this->db->where('id', $id);
		return $this->db->update('tache', $tache);
	}

	function effacerTache($id)
	{
		return $this->db->delete('tache', array('id' => $id));
	}

}