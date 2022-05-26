<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TypeDocument_model extends CI_Model {

    public function get_all(){
        $sql = "
        select * from tipo_documento
        ";

        return $this->db->query($sql)->result_array();
    }

}