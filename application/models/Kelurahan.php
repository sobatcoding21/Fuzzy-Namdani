<?php

class Kelurahan extends CI_Model {

    public function getAll()
    {
        return $this->db->order_by('nama')->get("m_kelurahan")->result();
    }

    public function getBencana( $year )
    {
        $rows = $this->db->query('SELECT a.nama, CONCAT('.$year.') AS `year`, b.id AS id_pemetaan
                        FROM m_kelurahan a
                        LEFT JOIN pemetaan_bencana b ON b.kelurahan_id = a.id_kelurahan')->result();

        $results = [];
        foreach($rows as $k=>$v) {
            $results[$k] =  $v;

            $details = $this->db->query(' SELECT b.nama, a.bencana AS D, a.populasi AS PD, a.bangunan AS NB, a.faskes AS HF FROM pemetaan_bencana_detail a 
                                            INNER JOIN m_bencana b ON b.id = a.bencana_id
                                          WHERE a.pemetaan_id = "'.$v->id_pemetaan.'" ')->result();

            $info = [];
            foreach($details as $d)  {
                $info[$d->nama] = $d;
            }
            $results[$k]->info = $info;

        }

        return $results;
    }

    public function getInfo($idKelurahan, $year)
    {
        $rows = $this->db->get_where('pemetaan_bencana', ['kelurahan_id' => $idKelurahan, 'year' => $year])->result();
        $return = [];
        foreach($rows as $index=>$val) {
            
        }

        return $return;

    }
}