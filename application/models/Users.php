<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Users extends CI_Model
{
	function connectUser($pseudo, $mdp)
	{
		return $this->db->get_where('user', array('pseudo' => $pseudo, 'mdp' => $mdp))->row();
	}

	function addUser($user)
	{
		return $this->db->insert('user', $user);
	}
}