<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Document_model extends CI_Model {

    public function create($data){
        $sql="
        insert into documento (codigo, nombres, estado, fecha_creacion, usuario_num_documento)
        values('?','?','?','?','?');
        ";

        $this->db->query($sql, $data);
    }

    public function delete($data){
        $sql="
        delete from documento where codigo=?
        ";

        $this->db->query($sql, $data);
    }

    public function update($data){
        $sql="
        update documento set nombres=?, estado=?, fecha_creacion=?, usuario_num_documento=?
        where codigo=?
        ";

        $this->db->query($sql, $data);
    }

    public function get($data){

        $sql="
        select * from documento where codigo=?
        ";

        $this->db->query($sql, $data);

    }


}