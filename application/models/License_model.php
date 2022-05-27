<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class License_model extends CI_Model {

    public function create($data){
        $sql="
        insert into licencia(id_licencia, fecha_inicio, fecha_fin, descripcion, docente_num_documento)
        values('?','?','?','?','?');
        ";

        $this->db->query($sql, $data);
    }

    public function delete($data){
        $sql="
        delete from licencia where id_licencia=?
        ";

        $this->db->query($sql, $data);
    }

    public function update($data){
        $sql="
        update licencia set fecha_inicio=?, fecha_fin=?, descripcion=?, docente_num_documento=?
        where id_licencia=?
        ";

        $this->db->query($sql, $data);
    }

    public function get($data){

        $sql="
        select * from licencia where id_licencia=?
        ";

        $this->db->query($sql, $data);

    }


}