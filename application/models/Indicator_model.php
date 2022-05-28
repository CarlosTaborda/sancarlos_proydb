<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicator_model extends CI_Model {

    public function create($data){
        $sql="
        insert into indicador (codigo, sigla, descripcion)
        values('?','?','?');
        ";

        $this->db->query($sql, $data);
    }

    public function delete($data){
        $sql="
        delete from indicador where codigo=?
        ";

        $this->db->query($sql, $data);
    }

    public function update($data){
        $sql="
        update indicador set sigla=?, descripcion=?
        where codigo=?
        ";

        $this->db->query($sql, $data);
    }

    public function get($data){

        $sql="
        select * from indicador where codigo=?
        ";

        $this->db->query($sql, $data);

    }


}