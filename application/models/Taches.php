<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Taches extends CI_Model
{

	function getAll()
	{
		$this->db->order_by('id', 'desc');
		$this->db->where('id_user', $this->session->id);
		return $this->db->get('tache')->result();
	}

	function getAllEncours()
	{
		$this->db->order_by('datecreation', 'desc');
		$this->db->where('id_user', $this->session->id);
		$this->db->where('etat', 0);
		return $this->db->get('tache')->result();
	}

	function getAllFini()
	{
		$this->db->order_by('datecreation', 'desc');
		$this->db->where('id_user', $this->session->id);
		$this->db->where('etat', 1);
		return $this->db->get('tache')->result();
	}

	function getById($id)
	{
		return $this->db->get_where('tache', array('id' => $id, 'id_user' => $this->session->id))->row();
	}

	function addTache($tache)
	{
		return $this->db->insert('tache', $tache);
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