<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('taches');
	}
	
	
	public function index()
	{
		$data['taches'] = $this->taches->getAll();
		$page = $this->load->view('index', $data, true);
		$this->load->view('global', ['page' => $page]);
		
	}
	
}