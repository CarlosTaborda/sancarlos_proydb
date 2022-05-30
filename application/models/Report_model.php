<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {

    public function report_a(){
        $sql="
        select g.codigo, g.nombre, count(e.num_documento) num_estudiantes
        from grupo g
        join estudiante e on g.codigo = e.grupo_codigo
        group by 1
        ";
        return $this->db->query($sql)->result_array();
    }

    public function report_b($grupo){
        $sql="
        SELECT e.*, g.nombre grupo_nombre, td.codigo FROM estudiante e
        join grupo g on g.codigo = e.grupo_codigo
        join tipo_documento td on td.codigo = e.tipo_documento_codigo
        where e.grupo_codigo = ?
        order by e.apellidos, e.nombres
        ";
        return $this->db->query($sql, [$grupo])->result_array();
    }

}