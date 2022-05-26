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

}