<?php

class Bencana extends CI_Model
{
    public function find($param)
    {
        return $this->db->get_where('bencana', $param)->row();
    }

    public function insert($data)
    {
        $this->db->insert('bencana', $data);
    }
}