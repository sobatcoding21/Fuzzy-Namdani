<?php

class Kelurahan extends CI_Model {

    public function getAll()
    {
        return $this->db->order_by('nama')->get("m_kelurahan")->result();
    }

    public function getBencana( $year )
    {
        return $this->db->query('SELECT a.*, CONCAT('.$year.') AS `year`,
        ( SELECT COUNT(b.id_bencana) FROM bencana b WHERE b.id_kelurahan = a.id_kelurahan AND b.id_bencana = 1 AND b.tahun= '.$year.') AS banjir,
        ( SELECT COUNT(b.id_bencana) FROM bencana b WHERE b.id_kelurahan = a.id_kelurahan AND b.id_bencana = 2 AND b.tahun= '.$year.') AS cuaca_ekstrim,
        ( SELECT COUNT(b.id_bencana) FROM bencana b WHERE b.id_kelurahan = a.id_kelurahan AND b.id_bencana = 3 AND b.tahun= '.$year.') AS gempa_bumi,
        ( SELECT COUNT(b.id_bencana) FROM bencana b WHERE b.id_kelurahan = a.id_kelurahan AND b.id_bencana = 4 AND b.tahun= '.$year.') AS kekeringan,
        ( SELECT COUNT(b.id_bencana) FROM bencana b WHERE b.id_kelurahan = a.id_kelurahan AND b.id_bencana = 5 AND b.tahun= '.$year.') AS tanah_longsor
        FROM m_kelurahan a')->result();
    }
}