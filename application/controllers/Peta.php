<?php

class Peta extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['MBencana']);
    }

    public function index()
    {
        
        if( $this->input->get('q') )
        {
            $key = $this->input->get('q') ? $this->input->get('q') : 'Banjir';
            $config = [
                'title'     => 'Peta | BPBD Kota Kediri',
                'subtitle'  => 'Peta',
                'content'   => $this->load->view('pages/peta_detail', ['title' => ucfirst($key), 'key' => $key, 'indeks' => $this->input->get('indeks') ? $this->input->get('indeks') : 'Rendah' ], true),
                'custom_js' => base_url('assets/js/customs/peta.js')
            ];
            $this->render($config);
        }else{
            $config = [
                'title'     => 'Peta | BPBD Kota Kediri',
                'subtitle'  => 'Peta',
                'content'   => $this->load->view('pages/peta', ['data' => $this->MBencana->getAll()], true)
            ];
            $this->render($config);
        }
        
    }

    public function dataPetaBencana()
    {
        $bencana = $this->input->get('bencana') ? $this->input->get('bencana') : 'Banjir';
        $indeks = $this->input->get('indeks') ? $this->input->get('indeks') : 'Rendah';
       
        if( $bencana && $indeks )
        {
            $dbBencana = $this->db->get_where('m_bencana', ['nama' => $bencana])->row();
            $raw = $this->db->query('   SELECT a.nama, a.lat, a.long FROM m_kelurahan a WHERE a.id_kelurahan IN (
                                        SELECT c.id_kelurahan 
                                        FROM fuzzy_result_details b
                                        INNER JOIN fuzzy_results c ON b.fuzzy_id = c.id
                                        WHERE b.id_bencana ="'. $dbBencana->id .'" AND b.status="'.$indeks.'" ) ')->result();
            
        }else{
            $raw = [];
        }
        

        return toJson($raw);
    }

}

