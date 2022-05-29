<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends CI_Model {

    public function get_all(){
        $sql = "
        select * from grupo g order by g.nombre
        ";

        return $this->db->query($sql)->result_array();
    }

}