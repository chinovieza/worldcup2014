<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Teams extends CI_Controller {

	public function index()
	{
		$this->load->model('Teamscontent');

		$allTeamList = $this->Teamscontent->getAllTeams();
		print_r($allTeamList);

		//$this->load->view('page_matches');
	}
}

