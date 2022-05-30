<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {

    public function create($data){
        $sql="
        insert into estudiante (num_documento, nombres, apellidos, fecha_nacimiento, direccion, telefono, acudiente_num_documento, tipo_documento_codigo, grupo_codigo)
        values(?,?,?,?,?,?,?,?,?)
        ";

        $this->db->query($sql, $data);


    }

    public function delete($numdoc){
        $sql="
        delete from estudiante where num_documento=?
        ";

        $this->db->query($sql, [$numdoc]);
    }

    public function update($data){
        $sql="
        update estudiante set nombres='%s', apellidos='%s', fecha_nacimiento='%s', 
        direccion='%s', telefono='%s', acudiente_num_documento='%s', 
        tipo_documento_codigo='%s', grupo_codigo='%s'
        where num_documento='%s'
        ";


        $this->db->query(sprintf($sql, $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[0]));
    }

    public function get_by_numdoc($numdoc){

        $sql="
        select * from estudiante where num_documento=?
        ";

        return $this->db->query($sql, [$numdoc])->first_row('array');

    }


    public function get_list($filter="", $offset=0, $limit=10){
        $sql = "
        select  
            s.*,
            g.nombre,
            g.codigo,
            concat(a.nombres, ' ', a.apellidos) acudiente
        from estudiante s, tipo_documento td, grupo g, acudiente a
        where 
            s.tipo_documento_codigo = td.codigo and s.grupo_codigo = g.codigo and s.acudiente_num_documento = a.num_documento
            and concat(s.nombres, ' ', s.apellidos, ' ', s.num_documento) like '%%%s%%'
        limit %s, %s
        ";

        return $this->db->query(sprintf($sql, $filter, $offset, $limit))->result_array();
    }


}