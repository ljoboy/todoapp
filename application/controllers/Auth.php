<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if (isset($this->session->is_connected)) {
			redirect(base_url('tache'));
		}
		$this->load->model('users');
	}

	function index()
	{
		$data = [];
		$this->load->view('user/main', $data);
	}

	function connexion()
	{
		$this->form_validation->set_rules('pseudo', 'pseudo', 'trim|required', ['required' => 'Le %s est obligatoire']);
		$this->form_validation->set_rules('mdp', 'mot de passe', 'required', ['required' => 'Le %s est obligatoire']);
		if ($this->form_validation->run() == TRUE) {
			$pseudo = $this->input->post('pseudo', true);
			$mdp = sha1($this->input->post('mdp'));
			$user = $this->users->connectUser($pseudo, $mdp);
			if ($user != null) {
				$array = array(
					'id' => $user->id,
					'pseudo' => $user->pseudo,
					'is_connected' => true
				);

				$this->session->set_userdata($array);
				$this->session->set_flashdata('succes', "<h3>Bienvenue " . strtoupper($user->pseudo) . "</h3>");
				redirect('tache');
			} else {
				$this->session->set_flashdata('error', "<h3>Echec d'authentification !</h3> Combinaison <strong>Pseudo / Mot de passe</strong> Incorrecte !");
				redirect();
			}
		} else {
			$this->session->set_flashdata('error', "Erreur inattendu !");
			redirect();
		}
	}

	function ajouter()
	{
		$this->form_validation->set_rules('pseudo', 'pseudo', 'trim|required', ['required' => 'Le %s est obligatoire']);
		$this->form_validation->set_rules('mdp', 'mot de passe', 'required|min_length[6]', ['required' => 'Le %s est obligatoire', 'min_length' => 'Le %s doit avoir au mois 6 caracteres']);
		$this->form_validation->set_rules('mdp2', 'confirmer le mot de passe', 'required|matches[mdp]', ['required' => 'vous devez %s', 'matches' => 'Les deux mot de passe ne coincident pas']);
		if ($this->form_validation->run() == TRUE) {
			$user =
				[
					'pseudo' => $this->input->post('pseudo', true),
					'mdp' => sha1($this->input->post('mdp', true))
				];
			if ($this->users->addUser($user)) {
				$this->session->set_flashdata('succes', '<h3>Enregistrer avec succes !</h3> veuiller vous connectez maintenant !');
				redirect();
			} else {
				$this->session->set_flashdata('error', '<h3>Erreur inattendu !</h3> Veuiller reessayer svp !');
				redirect('auth/ajouter');
			}
		} else {
			$data = [];
			$this->load->view('user/ajouter', $data);
		}
	}

	function modifier()
	{ }
}