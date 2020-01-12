<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tache extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		if (!isset($this->session->is_connected)) {
			redirect();
		}
		$this->load->model('taches');
		$this->load->helper('date');
	}


	function index()
	{
		$data['nomPage'] = 'index';
		$data['title'] = 'Liste des taches';
		$data['desc'] = 'Toutes les taches enregistrées';
		$data['taches'] = $this->taches->getAll();
		$page = $this->load->view('tache/index', $data, true);
		$this->load->view('global', ['page' => $page]);
	}

	function ajouter()
	{
		$this->form_validation->set_rules('desc', 'description', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$tache = [
				'datecreation' => date('Y-m-d H:i:s'),
				'description' => $this->input->post('desc', true),
				'id_user' => $this->session->id,
				'etat' => 0
			];
			$this->taches->addTache($tache);
			$this->session->set_flashdata('succes', 'Tache enregistrée avec succes !');
			redirect('tache');
		} else {
			$data['nomPage'] = 'ajouter';
			$data['title'] = 'Ajouter une tache';
			$data['desc'] = 'Remplir ce formulaire...';
			$page = $this->load->view('tache/ajouter', $data, true);
			$this->load->view('global', ['page' => $page]);
		}
	}

	function supprimer($id)
	{
		$tache = $this->taches->getById($id);
		if (isset($tache)) {
			$this->taches->effacerTache($id);
			$this->session->set_flashdata('succes', 'Tache supprimer avec succes !');
		} else {
			$this->session->set_flashdata('error', "La tache que vous avez demandé n'existe pas");
		}
		redirect('tache');
	}

	function modifier()
	{
		$this->form_validation->set_rules('idTache', 'id tache', 'trim|required');
		$this->form_validation->set_rules('desc', 'description', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$id = $this->input->post('idTache', true);
			$tache = [
				'description' => $this->input->post('desc', true)
			];
			$this->taches->modifTache($id, $tache);
			$this->session->set_flashdata('succes', 'Modifier avec succes !');
		} else {
			$this->session->set_flashdata('error', '<strong>Erreur inattendu !</strong> reessayer svp !');
		}
		redirect('tache');
	}

	function encours()
	{
		$data['nomPage'] = 'encours';
		$data['title'] = 'Liste des taches en cours';
		$data['desc'] = 'Toutes les taches qui ne sont pas encore terminées';
		$data['taches'] = $this->taches->getAllEncours();
		$page = $this->load->view('tache/index', $data, true);
		$this->load->view('global', ['page' => $page]);
	}

	function fini()
	{
		$data['nomPage'] = 'fini';
		$data['title'] = 'Liste des taches finies';
		$data['desc'] = 'Toutes les taches qui ont été terminées';
		$data['taches'] = $this->taches->getAllFini();
		$page = $this->load->view('tache/index', $data, true);
		$this->load->view('global', ['page' => $page]);
	}

	function finir($id)
	{
		$tache = [
			'etat' => 1
		];
		$this->taches->modifTache($id, $tache);
		$this->session->set_flashdata('succes', 'Vous venez de finir une tache !');
		redirect('tache');
	}
}