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
            $config = [
                'title'     => 'Peta | BPBD Kota Kediri',
                'subtitle'  => 'Peta',
                'content'   => $this->load->view('pages/peta_detail', ['title' => ucfirst($this->input->get('q')) ], true),
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

}

