<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Teamscontent extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        
    }

    function getAllTeams() {

 		$this->db->where('enable_2014', 1);
        $this->db->order_by('name', 'ASC');
        //$this->db->limit($limit, $offset);
        $this->db->from($this->db->dbprefix('national_team'));
        $query = $this->db->get();

        $contents = array();
        foreach ($query->result() as $row) {
            //echo $i++."-".$row->id."-".$row->title."<br>";
            $content = array(
                "id" => $row->id,
                "name" => $row->name,
                "short_name" => $row->short_name,
                "group_stage" => $row->group_stage,
            );

            array_push($contents, $content);
        }

        return $contents;
    }
}