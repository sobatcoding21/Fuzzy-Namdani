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
            $tahun = $this->input->get('tahun') ? $this->input->get('tahun') : '2020';
            $key = $this->input->get('q') ? $this->input->get('q') : 'Banjir';
            $config = [
                'title'     => 'Peta | BPBD Kota Kediri',
                'subtitle'  => 'Peta',
                'content'   => $this->load->view('pages/peta_detail', ['title' => ucfirst($key), 'key' => $key, 'indeks' => $this->input->get('indeks') ? $this->input->get('indeks') : 'Rendah', 'tahun' => $tahun ], true),
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

    /*public function dataPetaBencana()
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
    }*/

    public function getGeoJson()
    {
        $geoJsonKediri= [];
        foreach($this->config->item('geojson_kotakediri') as $index => $val) {
            $geoJsonKediri[] = json_decode($val, TRUE);
        }
        
        $geoMap = [];
        $tahun = $this->input->get('tahun') ? $this->input->get('tahun') : '2020';
        $bencana = $this->input->get('bencana') ? $this->input->get('bencana') : 'Banjir';
        $indeks = $this->input->get('indeks') ? $this->input->get('indeks') : 'Rendah';
        if( $bencana && $indeks )
        {
            $dbBencana = $this->db->get_where('m_bencana', ['nama' => $bencana])->row();
            $raw = $this->db->query('   SELECT a.coordinate, b.status 
                                        FROM fuzzy_result_details b
                                        INNER JOIN fuzzy_results c ON b.fuzzy_id = c.id
                                        INNER JOIN m_kelurahan a ON a.id_kelurahan = c.id_kelurahan
                                        WHERE b.id_bencana ="'. $dbBencana->id .'" AND b.status="'.$indeks.'" AND c.tahun= "'.$tahun.'" ')->result_array();
            
            foreach($raw as $k=>$v)
            {
                $value = json_decode($v['coordinate'], TRUE);
                if( isset($value[0]) )
                {
                    foreach($value as $k=>$d)
                    {
                        $value = $d;
                        $value['properties']['output'] =  $v['status'];
                        $geoMap[] = $value;
                    }
                }else{
                    $value['properties']['output'] =  $v['status'];
                    $geoMap[] = $value;
                }

                
            }
            
            $geoMapbencana = array_filter(array_merge($geoJsonKediri, $geoMap));
            $data = [
                "type"      => "FeatureCollection",
                "features"  => $geoMapbencana
            ];

        }else{
            $data = [
                "type"      => "FeatureCollection",
                "features"  => []
            ];
        }
        

        return toJson($data);

    }

}

