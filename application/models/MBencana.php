<?php

class MBencana extends CI_Model {

    public function getAll()
    {
        return $this->db->get('m_bencana')->result();
    }
}