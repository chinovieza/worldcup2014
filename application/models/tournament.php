<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Tournament extends CI_Model {

	const winPoint = 3;
    const drawPoint = 1;

    var $teamID;
    var $matchID;

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        
    }

    function setTeamID($value){
        $this->teamID = $value;
    }

    function setMatchID($value){
        $this->matchID = $value;
    }

    function getTeamID(){
        return $this->teamID;
    }

    function getMatchID(){
        return $this->matchID;
    }

    function getCountP($stage=0) {
        $sql = "Select count(*) as num";
        $sql .= " From ".$this->db->dbprefix('match');
        $sql .= " Where match_status = 4";
        $sql .= " And (team_home = ".$this->getTeamID();
        $sql .= " Or team_away = ".$this->getTeamID().")";
        if ($stage==1){
            $sql .= " And stage = 1";   //Group Stage Only;
        }

        $value = null;
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0)
		{
		   $row = $query->row_array();
		   $value = $row;
		}

		return $value;
    }

    function getCountMatchResult($stage=0){
        $sql = "Select id";
        $sql .= " From ".$this->db->dbprefix('match');
        $sql .= " Where match_status = 4";
        $sql .= " And (team_home = ".$this->getTeamID();
        $sql .= " Or team_away = ".$this->getTeamID().")";
        if ($stage==1){
            $sql .= " And stage = 1";   //Group Stage Only;
        }

        $query = $this->db->query($sql);
        $win = $draw = $lost = $goalScored = $goalAgainst = 0;
        foreach ($query->result_array() as $rec) {
            $this->setMatchID($rec["id"]);
            $ourScore = $this->getScore();
            $theirScore = $this->getCompetitorScore();

            $goalScored += $ourScore;
            $goalAgainst += $theirScore;

            if ($ourScore>$theirScore){
                $win++;
            } else if ($ourScore==$theirScore){
                $draw++;
            } else if ($ourScore<$theirScore){
                $lost++;
            }
        }
        $value = array(
            "w" => $win,
            "d" => $draw,
            "l" => $lost,
            "gs" => $goalScored,
            "ga" => $goalAgainst
        );
        return $value;
    }

    function getScore() {
        $competitor = $this->getCompetitor();

        //Take the score from normal score.
        $this->db->where('match_id', $this->getMatchID());
        $this->db->where('team_id', $this->getTeamID());
        $this->db->where('score_type <=', 4);
		$this->db->from($this->db->dbprefix('score'));
		$value1 = $this->db->count_all_results();

        //Take the score from competitor own goal.
        $this->db->where('match_id', $this->getMatchID());
        $this->db->where('team_id', $competitor);
        $this->db->where('score_type', 5);
		$this->db->from($this->db->dbprefix('score'));
		$value2 = $this->db->count_all_results();

        return ($value1 + $value2);
    }
    
    function getCompetitorScore(){
        $competitor = $this->getCompetitor();
        
        //Take the score from normal score.
        $this->db->where('match_id', $this->getMatchID());
        $this->db->where('team_id', $competitor);
        $this->db->where('score_type <=', 4);
		$this->db->from($this->db->dbprefix('score'));
		$value1 = $this->db->count_all_results();
        
         //Take the score from our own goal.
        $this->db->where('match_id', $this->getMatchID());
        $this->db->where('team_id', $this->getTeamID());
        $this->db->where('score_type', 5);
		$this->db->from($this->db->dbprefix('score'));
		$value2 = $this->db->count_all_results();
        
        return ($value1 + $value2);
    }

    function getCompetitor(){
        //Query competitor
        $sql = "Select team_home, team_away From ".$this->db->dbprefix('match')." Where id = ".$this->getMatchID();

        $query = $this->db->query($sql);

        $competitor = null;
        if ($query->num_rows() > 0)
		{
		   $rec = $query->row_array();
		   if ($this->getTeamID() == $rec["team_home"]) {
	            $competitor = $rec["team_away"];
	        } else {
	            $competitor = $rec["team_home"];
	        }
		}

        return $competitor;
    }
}


//Group Regulations
//The ranking of each team in each group will be determined as follows:
// a) greatest number of points obtained in all group matches;
// b) goal difference in all group matches;
// c) greatest number of goals scored in all group matches.48FINAL COMPETITION
//If two or more teams are equal on the basis of the above three criteria, their
//rankings will be determined as follows:
// d) greatest number of points obtained in the group matches between the
//teams concerned;
// e) goal difference resulting from the group matches between the teams
//concerned;
// f) greater number of goals scored in all group matches between the teams
//concerned;
// g) drawing of lots by the FIFA Organising Committee.
//http://www.fifa.com/mm/document/tournament/competition/56/42/69/fifawcsouthafrica2010inhalt_e.pdf
//ในรอบแบ่งกลุ่มให้เรียงอันดับตามคะแนนก่อน
//- จากนั้นให้ดูผลต่างประตูได้เสีย
//- แล้วค่อยดูว่าทีมไหนยิงประตูมากกว่า
//ถ้ายังเสมอกันตั้งแต่ 2 ทีมขึ้นไป
//- ให้นับคะแนนที่แข่งกันระหว่างทีมคู่กรณี
//- ถ้าเท่ากันให้ดูประตูได้เสียในการแข่งระหว่างทีมคู่กรณี
//- ถ้ายังเท่ากันให้ดูว่าทีมไหนยิงประตูมากที่สุดในการแข่งระหว่างทีมคู่กรณี
//- ถ้ายังเสมอกันให้จับฉลาก
