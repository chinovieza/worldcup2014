<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matches extends CI_Controller {

	public function index()
	{
		$this->load->view('page_matches');
	}
}

