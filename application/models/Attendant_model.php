<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Attendant_model extends CI_Model {

    public function create($data){
        $sql="
        insert into acudiente (num_documento, nombres, apellidos, telefono, direccion, parentesco, tipo_documento)
        values('?','?','?','?','?''?','?');
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
        $sql="
        update acudiente set nombres=?, apellidos=?, telefono=?, direccion=?, parentesco=?, tipo_documento_codigo=?
        where num_documento=?
        ";

        $this->db->query($sql, $data);
    }

    public function get($data){

        $sql="
        select * from acudiente where num_documento=?
        ";

        $this->db->query($sql, $data);

    }


}