<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teams extends CI_Controller {

	public function index()
	{
		$this->load->model('Teamscontent');
		
		$data["teamslist"]["contents"] = $this->Teamscontent->getAllTeams();
		
		$this->load->view('page_teams', $data);
	}
}

