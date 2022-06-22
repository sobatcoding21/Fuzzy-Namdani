<?php

class FuzzyVariable extends CI_Model
{

    public function getAll()
    {
        return $this->db->get('fuzzy_variables')->result();
    }
}