<?php

namespace application\models;

use application\core\Model;

class Message extends Model 
{
    public function has($id)
    {
        $params = [
            'id' => $id
        ];
        
        return $this->db->column('SELECT id FROM messages WHERE id = :id', $params) != null;
    }
    
    public function add($text, $createtime)
    {
        $params = [
            'email' => $_SESSION['user']['email'],
            'text' => $text,
            'createtime' => $createtime,
        ];
        
        $this->db->query('INSERT INTO messages (email, text, createtime) VALUES(:email, :text, :createtime)', $params);
        
        return $this->db->getInsertId();
    }
    
    public function getMessages($limit, $offset)
    {
        return $this->db->row('SELECT * FROM messages ORDER BY createtime DESC LIMIT '. $limit .' OFFSET '. $offset);
    }
    
    public function getMessage($id)
    {
        $params = [
            'id' => $id,
        ];
        
        return $this->db->row('SELECT * FROM messages WHERE id = :id', $params)[0];
    }
    
    public function delete($id)
    {
        $params = [
            'id' => $id
        ];
        
        $this->db->query('DELETE FROM messages WHERE id = :id', $params);
    }
}