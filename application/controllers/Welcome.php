<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{


	function __construct()
	{
		parent::__construct();
		$this->load->model('taches');
	}


	function index()
	{
		$this->load->helper('date');
		$data['title'] = 'Liste des taches';
		$data['desc'] = 'Toutes les taches enregistrées';
		$data['taches'] = $this->taches->getAll();
		$page = $this->load->view('index', $data, true);
		$this->load->view('global', ['page' => $page]);
	}

	function ajouter()
	{ }

	function supprimer($id)
	{ }

	function modifier($id)
	{ }
}