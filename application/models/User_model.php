<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function create($user_data){
       
        $sql = "
        insert into usuario (num_documento, usuario, nombres, apellidos, contrasena, fecha_nacimiento, email, direccion, estado, tipo_documento_codigo)
        values('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s')
        ";

        $this->db->query(sprintf(
            $sql,
            $user_data[0],
            $user_data[1],
            $user_data[2],
            $user_data[3],
            $user_data[4],
            $user_data[5],
            $user_data[6],
            $user_data[7],
            $user_data[8],
            $user_data[9]
        ));
    }


    public function update($user_data){
       
        $sql = "
        update usuario set  usuario='%s', nombres='%s',
        apellidos='%s', contrasena='%s', fecha_nacimiento='%s', email='%s',
        direccion='%s' where num_documento='%s'
        ";

        $this->db->query(sprintf(
            $sql,
            $user_data[1],
            $user_data[2],
            $user_data[3],
            $user_data[4],
            $user_data[5],
            $user_data[6],
            $user_data[7],
            $user_data[0]
        ));
    }

    public function update_teacher($data){

        $sql="
        update docente set profesion='%s' where usuario_num_documento='%s'
        ";

        $this->db->query(sprintf($sql, $data[0], $data[1]));
    }

    public function update_admin($data){

        $sql="
        update administrativo set eps='%s', fondo_pensional='%s' where usuario_num_documento='%s'
        ";

        $this->db->query(sprintf($sql, $data[0], $data[1], $data[2]));
    }

    public function get_by_numdoc($numdoc){
        $sql="
        select
            *
        from usuario u
        left join docente d on u.num_documento = d.usuario_num_documento
        left join administrativo a on u.num_documento = a.usuario_num_documento
        where u.num_documento=?
        ";

        $user = $this->db->query($sql, [$numdoc])->first_row('array');

        if( empty($user) ){
            return null;
        }

        $user["is_teacher"]= !empty($user["profesion"]);
        return $user;
    }

    public function create_admin($data){
        $sql ="
        insert into administrativo(eps,fondo_pensional, usuario_num_documento)
        value('%s','%s','%s')
        ";
        $this->db->query(sprintf(
            $sql,
            $data[0],
            $data[1],
            $data[2]
        ));
    }

    public function create_teacher($data){
        $sql ="
        insert into docente(profesion, usuario_num_documento)
        value('%s','%s')
        ";
        $this->db->query(sprintf(
            $sql,
            $data[0],
            $data[1]
        ));
    }

    public function auth( $username, $password){
        $sql = "
        select * from usuario where usuario='%s' and contrasena='%s'
        ";
        return $this->db->query(sprintf($sql, $username, $password))->first_row('array');
    }

    public function get_by_type($type="teachers"){
        $sql="
        select * from usuario u
        ".($type=="teachers"?"join docente d on d.usuario_num_documento = u.num_documento":"join administrativo a on a.usuario_num_documento = u.num_documento")."
        order by u.nombres";
        return $this->db->query($sql)->result_array();
    }

    public function delete($numdoc){
        $sql ="delete from administrativo where usuario_num_documento=?";
        $this->db->query( $sql, [$numdoc] );
        $sql ="delete from docente where usuario_num_documento=?";
        $this->db->query( $sql, [$numdoc] );
        $sql ="delete from usuario where num_documento=?";
        $this->db->query( $sql, [$numdoc] );
    }

}