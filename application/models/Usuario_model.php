<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

    public function create($user_data){
       
        $sql = "
        insert into usuario (num_documento, usuario, nombre, apellido, contraseña, fecha_nacimiento, email, direccion, estado)
        values('%s','%s','%s','%s','%s','%s','%s','%s','%s')
        ";

        $this->db->query($sql);
    }

}