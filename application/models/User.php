<?php

namespace application\models;

use application\core\Model;

class User extends Model 
{
    public function has($email)
    {
        $params = [
            'email' => $email
        ];
        
        return $this->db->column('SELECT email FROM users WHERE email = :email', $params) != null;
    }
    
    public function add($name, $email, $password)
    {
        $params = [
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ];
        
        $this->db->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)', $params);
    }
    
    public function get($email)
    {
        $params = [
            'email' => $email,
        ];
        
        return $this->db->row('SELECT * FROM users WHERE email = :email', $params)[0];
    }
}