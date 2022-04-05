<?php

class Kecamatan extends CI_Model {

    public function getAll()
    {
        return $this->db->get("m_kecamatan");
    }
}