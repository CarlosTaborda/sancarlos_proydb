<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Area_model extends CI_Model {

    public function get_by_code($codigo){
        $sql="
        select * from area a
        where a.codigo=?
        ";
        return $this->db->query($sql, $codigo)->first_row("array");
    }

    public function get_all(){
        $sql = "
        select * from area
        ";

        return $this->db->query($sql)->result_array();
    }

    public function get_list($filter="", $offset=0, $limit=10){
        $sql = "
        select * from area
        where nombre like '%%%s%%'
        limit %s, %s
        ";

        return $this->db->query(sprintf($sql, $filter, $offset, $limit))->result_array();
    }

    public function create($data){
        $sql = "
        insert into area (codigo, nombre)
        values(?,?)
        ";

        $this->db->query($sql,$data);
    }


    public function delete($codigo){
        $sql = "
        delete from area where codigo=?
        ";

        $this->db->query($sql,[$codigo]);
    }

    public function update($data){
        $sql = "
        update area set nombre='%s'
        where codigo='%s'
        ";

        $this->db->query( sprintf($sql,$data[1],$data[0]));
    }



}