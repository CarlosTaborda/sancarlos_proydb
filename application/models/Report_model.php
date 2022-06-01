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


    public function report_d(){

        $sql="
        select
            u.num_documento,
            u.nombres,
            u.apellidos,
            d.profesion,
            sum(abs(datediff( l.fecha_fin, l.fecha_inicio))) numdias
        from docente d, usuario u, licencia l
        where d.usuario_num_documento = u.num_documento
            and l.docente_num_documento = d.usuario_num_documento
        group by 1
        ";

        return $this->db->query($sql)->result_array();
    }

}