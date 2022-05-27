<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_model extends CI_Model {

    public function get_all(){
        $sql = "
        select * from area
        ";

        return $this->db->query($sql)->result_array();
    }

    public function create($data){
        $sql = "
        insert into area (codigo, nombre)
        values(?,?)
        ";

        $this->db->query($sql,$data[0],$data[1]);
    }


    public function delete($data){
        $sql = "
        delete area where codigo=?
        ";

        $this->db->query($sql,$data[0]);
    }

    public function update($data){
        $sql = "
        update area set nombre=?
        where codigo=?
        ";

        $this->db->query($sql,$data[0],$data[1]);
    }



}