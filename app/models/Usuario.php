<?php

namespace App\Models;

use App\Core\Model;

class Usuario extends Model{
    public function getUserData(){
        return [
            'name' => 'ViniMB2',
            'age' => 41,
            'email' => 'vini@test.com.br'
        ];
    }   

    public function createUSer($name){
        $sql = "INSERT INTO usuarios (nome) VALUES (:name)";
        $params = ['name' => $name];
        return $this->db->execute($sql, $params);
    }

    public function getAllUsers(){
        return $this->db->fetchAll('SELECT * FROM usuarios');
    }

    public function getUserById($id){
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $params = ['id' => $id];
        return $this->db->fetch($sql, $params);
    }

    public function getUsersCount(){
        return $this->db->fetch('SELECT COUNT(*) AS count FROM usuarios')['count'];
    }
}