<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends CI_Model {

    public function get_all(){
        $sql = "
        insert into grupo(codigo, nombre, anio)
        ";

        return $this->db->query($sql)->result_array();
    }

}