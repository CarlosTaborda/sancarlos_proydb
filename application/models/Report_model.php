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

    public function report_c(){
        $sql="
        select
            e.*,
            g.nombre grupo_nomb
        from estudiante e
        left join grupo g on g.codigo=e.grupo_codigo
        where e.estado=0
        order by e.nombres
        ";
        return $this->db->query($sql)->result_array();
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

    public function report_e( $codigo ){

        $sql = "
        select
            u.tipo_documento_codigo,
            u.num_documento,
            u.nombres,
            u.apellidos,
            d.profesion,
            g.nombre gru_nombre,
            g.anio,
            m.nombre mat_nombre
        from usuario u 
        join docente d on u.num_documento = d.usuario_num_documento
        join grupo g on g.docente_num_documento = d.usuario_num_documento
        join materia_grupo mg on mg.grupo_codigo = g.codigo
        join materia m on m.codigo = mg.materia_codigo
        where g.codigo = ?
        ";

        return $this->db->query($sql, [$codigo])->result_array();
    }


    public function report_h($anio){
        $sql="
        select
            num_documento,
            nombres,
            apellidos,
            nomb_grupo,
            count(materia) cant_mat_perd
        from (
            select
                e.num_documento,
                e.nombres,
                mg.materia_codigo materia,
                e.apellidos,
                g.nombre nomb_grupo,
                avg(n.nota) nota
            from estudiante e
            join grupo g on e.grupo_codigo = g.codigo
            join materia_grupo mg on mg.grupo_codigo = g.codigo
            join nota n on (n.estudiante_num_documento = e.num_documento and n.materia_codigo = mg.materia_codigo and n.grupo_codigo=g.codigo)
            where g.anio=?
            group by e.num_documento, mg.materia_codigo
            having avg(n.nota) < 3
        ) mp
        group by num_documento
        ";

        return $this->db->query($sql, [$anio])->result_array();
        
    }

    public function report_i($anio){
        $sql ="
        select 
            mp.grupo_codigo, nomb_grupo, count(mp.grupo_codigo) cant_perd  , cg.cant cant_tot 
        from (
        select
            mp.grupo_codigo,
            mp.nomb_grupo,
            mp.num_documento
            from  
            (
                select
                    e.num_documento,
                    e.nombres,
                    mg.materia_codigo materia,
                    e.apellidos,
                    mg.grupo_codigo,
                    g.nombre nomb_grupo,
                    avg(n.nota) nota
                from estudiante e
                join grupo g on e.grupo_codigo = g.codigo
                join materia_grupo mg on mg.grupo_codigo = g.codigo
                join nota n 
                    on (n.estudiante_num_documento = e.num_documento and n.materia_codigo = mg.materia_codigo and n.grupo_codigo=g.codigo)
                where g.anio=?
                group by e.num_documento, mg.materia_codigo
                having avg(n.nota) < 3

            ) mp 
            group by mp.num_documento
        )mp
        join (
            select
                grupo_codigo,
                count(grupo_codigo) cant
            from estudiante
            group by grupo_codigo
        ) cg on mp.grupo_codigo = cg.grupo_codigo
        group by mp.grupo_codigo
        ";

        return $this->db->query($sql, [$anio])->result_array();
        //var_dump($this->db->last_query());
    }

    public function report_j(){

        $sql = "
        select
            ce.codigo,
            ce.gru_nombre,
            ce.cant_estudiantes,
            ifnull(cp.cant_inactivos, 0) cant_inactivos
        from (
            select
            g.codigo,
            g.nombre gru_nombre,
            count(e.num_documento) cant_estudiantes
            from grupo g
            join estudiante e on g.codigo = e.grupo_codigo
            group by g.codigo
        )
        ce 
        left join (
        select
            g.codigo,
            g.nombre gru_nombre,
            count(e.num_documento) cant_inactivos
        from  grupo g
        left join estudiante e on g.codigo = e.grupo_codigo
        where e.estado=0
        group by g.codigo
        ) cp on ce.codigo = cp.codigo
        ";

        return $this->db->query($sql)->result_array();
    }

}