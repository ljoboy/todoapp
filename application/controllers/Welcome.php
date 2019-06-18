<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->model('taches');
		$this->load->helper('date');
	}


	function index()
	{
		$data['title'] = 'Liste des taches';
		$data['desc'] = 'Toutes les taches enregistrées';
		$data['taches'] = $this->taches->getAll();
		$page = $this->load->view('index', $data, true);
		$this->load->view('global', ['page' => $page]);
	}

	function ajouter()
	{
		$this->form_validation->set_rules('dates', 'date début et fin', 'trim|required');
		$this->form_validation->set_rules('desc', 'description', 'trim|required');

		if ($this->form_validation->run() == TRUE) {
			$dates = explode(" - ", $this->input->post('dates', true));
			$tache = [
				'date_debut' => nice_date($dates[0], 'Y-m-d'),
				'date_fin' => nice_date($dates[1], 'Y-m-d'),
				'description' => $this->input->post('desc', true)
			];
			$this->taches->addTache($tache);
			$this->session->set_flashdata('succes', 'Enregistrer avec succes !');
			redirect(base_url());
		} else {
			$data['title'] = 'Ajouter une tache';
			$data['desc'] = 'Remplir ce formulaire...';
			$page = $this->load->view('ajouter', $data, true);
		}
		$this->load->view('global', ['page' => $page]);
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
		redirect(base_url());
	}

	function modifier($id)
	{
		$data['tache'] = $this->taches->getById($id);
		if (isset($data['tache'])) {
			$this->form_validation->set_rules('dates', 'date début et fin', 'trim|required');
			$this->form_validation->set_rules('desc', 'description', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				$dates = explode(" - ", $this->input->post('dates', true));
				$tache = [
					'date_debut' => nice_date($dates[0], 'Y-m-d'),
					'date_fin' => nice_date($dates[1], 'Y-m-d'),
					'description' => $this->input->post('desc', true)
				];
				$this->taches-> modifTache($id, $tache);
				$this->session->set_flashdata('succes', 'Modifier avec succes !');
				redirect(base_url());
			} else {
				$data['title'] = 'Ajouter une tache';
				$data['desc'] = 'Remplir ce formulaire...';
				$page = $this->load->view('modifier', $data, true);
			}
			$this->load->view('global', ['page' => $page]);
		} else {
			$this->session->set_flashdata('error', "La tache que vous avez demandé n'existe pas");
			redirect(base_url());
		}
	}
}