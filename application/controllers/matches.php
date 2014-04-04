<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matches extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->config('content', TRUE);
        $this->load->library('dateandtime');
    }

	public function index()
	{
		$this->load->model('Matchescontent');
		$this->load->model('Tournament');

		//configuration
		$defaultTab = 1;
		$timeSetting = $this->config->item('time_setting', 'content');
		
		//get
		$getTab =  isset($_GET["tab"]) ? $_GET["tab"] : $defaultTab;
		$getTz = isset($_GET["tz"]) ? $_GET["tz"] : 1;
		if ($getTz!=1 && $getTz!=2 && $getTz!=3) $getTz = 1; //force
		
		$matchesGroupStage = $this->Matchescontent->getMatchesGroupStage();
		if (is_array($matchesGroupStage) && sizeof($matchesGroupStage)>0) {
			foreach ($matchesGroupStage as $mgsKey => $mgsData) {
				$this->Tournament->setTeamID($mgsData["team_home"]);
				$this->Tournament->setMatchID($mgsData["id"]);
				$teamHomeScore = $this->Tournament->getScore();
    			$teamAwayScore = $this->Tournament->getCompetitorScore();

    			$matchesGroupStage[$mgsKey]["teamHomeScore"] = $teamHomeScore;
    			$matchesGroupStage[$mgsKey]["teamAwayScore"] = $teamAwayScore;
			}
		}
		$data["matches_data"]["group_stage"]["contents"] = $matchesGroupStage;
		

		$data["getTz"] = $getTz;
		$data["tZone"] = $timeSetting[$getTz]["tz"];
 		$data["getTab"] = $getTab;
 		$data["timeSetting"] = $timeSetting;
 		
		$this->load->view('page_matches', $data);
	}
}

