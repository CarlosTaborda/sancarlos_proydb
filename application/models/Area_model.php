<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_model extends CI_Model {

    public function get_all(){
        $sql = "
        select * from area
        ";

        return $this->db->query($sql)->result_array();
    }

}