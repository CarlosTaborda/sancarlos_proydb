<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendant_model extends CI_Model {

    public function create($data){
        $sql="
        insert into acudiente (num_documento, nombres, apellidos, telefono, direccion, parentesco, tipo_documento_codigo)
        values(?,?,?,?,?,?,?);
        ";

        $this->db->query($sql, $data);
    }

    public function delete($data){
        $sql="
        delete from acudiente where num_documento=?
        ";

        $this->db->query($sql, $data);
    }

    public function update($data){
        $data = array_values($data);
        $sql="
        update acudiente set nombres='%s', apellidos='%s', telefono='%s', 
        direccion='%s', parentesco='%s', tipo_documento_codigo='%s'
        where num_documento='%s'
        ";

        $this->db->query(sprintf($sql, $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[0]));
        //echo $this->db->last_query();exit();
    }

    public function get_by_code($numdoc){

        $sql="
        select a.* from acudiente a
        where a.num_documento=?
        ";

        return $this->db->query($sql, [$numdoc])->first_row('array');
    }

    public function get_by_student($numdoc){

        $sql="
        select a.* from acudiente a
        join estudiante e on a.num_documento = e.acudiente_num_documento
        where e.num_documento=?
        ";

        return $this->db->query($sql, [$numdoc])->first_row('array');
    }

    public function get(){
        $sql = "select a.* from acudiente a order by a.nombres  ";
        return $this->db->query($sql)->result_array();
    }


}