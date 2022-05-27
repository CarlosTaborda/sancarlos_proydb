<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course_model extends CI_Model {

    public function create( $data){
        $sql = "
        insert into materia(codigo, nombre, hrs_semana, area_codigo)
        values(?,?,?,?);
        ";

        return $this->db->query($sql, $data);
    }

    public function get_by_code($codigo){
        $sql="
        select * from materia m
        where m.codigo=?
        ";
        return $this->db->query($sql, $codigo)->first_row("array");
    }

    public function update($data){
        $sql = "
            update materia set nombre='%s', hrs_semana='%s', area_codigo='%s'
            where codigo='%s'
        ";

        $this->db->query(sprintf($sql, $data[1], $data[2], $data[3], $data[0]));
    }

    public function get_list($filter="", $offset=0, $length="10"){

        $sql="
        select m.*, a.nombre area_nombre from materia m
        join area a on m.area_codigo = a.codigo
        where m.nombre like '%%%s%%'
        limit $offset, $length
        ";
        return $this->db->query(sprintf($sql, $filter))->result_array();
    }

    public function delete( $codigo){

        $sql ="delete from materia where codigo=?";
        $this->db->query($sql, $codigo);
    }

}