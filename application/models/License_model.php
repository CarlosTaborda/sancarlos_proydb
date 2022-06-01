<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class License_model extends CI_Model {

    public function create($data){
        $sql="
        insert into licencia( docente_num_documento, fecha_inicio, fecha_fin, descripcion )
        values(?,?,?,?);
        ";

        $this->db->query($sql, $data);
    }

    public function delete($codigo){
        $sql="
        delete from licencia where id_licencia=?
        ";

        $this->db->query($sql, [$codigo]);
    }

    public function update($data){
        $sql="
        update licencia set fecha_inicio='%s', fecha_fin='%s', descripcion='%s', docente_num_documento='%s'
        where id_licencia='%s'
        ";

        $this->db->query(sprintf($sql, $data[2], $data[3], $data[4], $data[0], $data[1]));
    }

    public function get_by_code($codigo){

        $sql="
        select * from licencia where id_licencia=? 
        ";

        return $this->db->query($sql, [$codigo])->first_row("array");

    }

    public function get_list($filter="", $offset=0, $limit=10){
        $sql = "
        select l.*, u.nombres, u.apellidos, u.tipo_documento_codigo from licencia l, docente d, usuario u
        where 
			d.usuario_num_documento = l.docente_num_documento and 
			d.usuario_num_documento = u.num_documento and
			concat(l.descripcion, ' ', u.nombres, ' ', u.apellidos, ' ', u.num_documento) like '%%%s%%'
        limit %s, %s
        ";

        return $this->db->query(sprintf($sql, $filter, $offset, $limit))->result_array();
    }



}