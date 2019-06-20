<?php
defined('BASEPATH') or exit('No direct script access allowed');
class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (!isset($this->session->is_connected)) {
			redirect();
		}
		$this->load->model('users');
	}

	function modifier()
	{
		$this->form_validation->set_rules('pseudo', 'pseudo', 'trim|required', ['required' => 'Le %s est obligatoire']);
		$this->form_validation->set_rules('mdp', 'mot de passe', 'trim|required|min_length[6]', ['required' => 'Le %s est obligatoire', 'min_length' => 'Le %s doit avoir au mois 6 caracteres']);
		$this->form_validation->set_rules('mdp2', 'confirmer le mot de passe', 'trim|required|matches[mdp]', ['required' => 'vous devez %s', 'matches' => 'Les deux mot de passe ne coincident pas']);
		if ($this->form_validation->run() == TRUE) {
			$user =
				[
					'pseudo' => $this->input->post('pseudo', true),
					'mdp' => sha1($this->input->post('mdp', true))
				];
			if ($this->users->addUser($user)) {
				$this->session->set_flashdata('succes', '<h3>Modifier avec succes !</h3>');
				redirect();
			}
		} else {
			$data = [];
			$this->load->view('user/modifier', $data);
		}
	}

	function deconnexion()
	{
		$this->session->unset_userdata('is_connected');
		redirect();
	}
}