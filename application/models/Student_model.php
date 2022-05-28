<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_model extends CI_Model {

    public function create($data){
        $sql="
        insert into estudiante (num_documento, nombres, apellidos, fecha_nacimiento, direccion, telefono, estado, acudiente_num_documento, tipo_documento_codigo, grupo_codigo)
        values('?','?','?','?','?','?','?','?','?','?');
        ";

        $this->db->query($sql, $data);
    }

    public function delete($data){
        $sql="
        delete from estudiante where num_documento=?
        ";

        $this->db->query($sql, $data);
    }

    public function update($data){
        $sql="
        update estudiante set nombres=?, apellidos=?, fecha_nacimiento=?, direccion=?, telefono=?, estado=?, acudiente_num_documento=?, tipo_documento_codigo=?, grupo_codigo=?
        where num_documento=?
        ";

        $this->db->query($sql, $data);
    }

    public function get($data){

        $sql="
        select * from estudiante where num_documento=?
        ";

        $this->db->query($sql, $data);

    }


}