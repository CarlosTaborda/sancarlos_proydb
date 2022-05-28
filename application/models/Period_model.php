<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Period_model extends CI_Model {

    public function create($data){
        $sql="
        insert into periodo (codigo, nombre, fecha_inicio, fecha_fin)
        values(?,?,?,?);
        ";

        $this->db->query($sql, $data);
    }

    public function get_list($filter="", $offset=0, $limit=10){
        $sql = "
        select * from periodo
        where nombre like '%%%s%%'
        limit %s, %s
        ";

        return $this->db->query(sprintf($sql, $filter, $offset, $limit))->result_array();
    }

    public function delete($codigo){
        $sql="
        delete from periodo where codigo=?
        ";

        $this->db->query($sql, [$codigo]);
    }

    public function update($data){
        $sql="
        update periodo set nombre='%s', fecha_inicio='%s', fecha_fin='%s'
        where codigo='%s'
        ";

        $this->db->query(sprintf($sql, $data[1], $data[2], $data[3], $data[0]));
    }

    public function get_by_code($codigo){

        $sql="
        select * from periodo where codigo=?
        ";

        return $this->db->query($sql, [$codigo])->first_row('array');

    }


}