<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sanction_model extends CI_Model {

    public function create($data){
        $sql="
        insert into sancion (id_sancion, fecha, motivo, descripcion, estudiante_num_documento)
        values('?','?','?','?','?');
        ";

        $this->db->query($sql, $data);
    }

    public function delete($data){
        $sql="
        delete from sancion where id_sancion=?
        ";

        $this->db->query($sql, $data);
    }

    public function update($data){
        $sql="
        update sancion set fecha=?, motivo=?, descripcion=?, estudiante_num_documento=?
        where id_sancion=?
        ";

        $this->db->query($sql, $data);
    }

    public function get($data){

        $sql="
        select * from sancion where id_sancion=?
        ";

        $this->db->query($sql, $data);

    }


}