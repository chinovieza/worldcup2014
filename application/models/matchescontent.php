<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Matchescontent extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        
    }

    function getMatchesGroupStage() {
    	$sql = "SELECT A.id, team_home, team_away, stadium, match_status";
		$sql .= " , B.name AS hteam, B.short_name AS hteams, C.name AS ateam, C.short_name AS ateams, B.group_stage AS mgroup";
		$sql .= " , D.name AS venue_name, D.city AS venue_city";
		$sql .= " , DATE_FORMAT(match_datetime_gmt, '%e') AS mday, DATE_FORMAT(match_datetime_gmt, '%c') AS mmonth, DATE_FORMAT(match_datetime_gmt, '%Y') AS myear";
		$sql .= " , DATE_FORMAT(match_datetime_gmt, '%H') AS mhour, DATE_FORMAT(match_datetime_gmt, '%i') AS mmin, DATE_FORMAT(match_datetime_gmt, '%s') AS msec";
		$sql .= " FROM ".$this->db->dbprefix('match')." A";
		$sql .= " INNER JOIN ".$this->db->dbprefix('national_team')." B";
		$sql .= " ON A.team_home = B.id";
		$sql .= " INNER JOIN ".$this->db->dbprefix('national_team')." C";
		$sql .= " ON A.team_away = C.id";
		$sql .= " INNER JOIN ".$this->db->dbprefix('stadium')." D";
		$sql .= " ON A.stadium = D.id";
		$sql .= " WHERE stage = 1";
		//$sql .= " AND A.enable_2014 = 1";
		$sql .= " ORDER BY match_datetime_gmt ASC";

		//echo $sql;

		$query = $this->db->query($sql);

        $data = array();
        if ($query->num_rows() > 0) {
        	/*
            foreach ($query->result() as $row) {
                //print_r($row);

                $item = array(
                    "team_home" => $row->team_home,
                    "team_away" => $row->team_away,
                    "stadium" => $row->stadium,
                    "hteam" => $row->hteam,
                    "hteams" => $row->hteams,
                    "ateam" => $row->ateam,
                    "ateams" => $row->ateams,
                    "mgroup" => $row->mgroup,
                );
                array_push($data, $item);
            }
            */

            foreach ($query->result_array() as $row) {
            	array_push($data, $row);
            }
            
        }
        
        return $data;
    }
}