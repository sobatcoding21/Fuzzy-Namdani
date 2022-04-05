<?php

class Peta extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['MBencana']);
    }

    public function index()
    {
        
        $config = [
            'title'     => 'Peta | BPBD Kota Kediri',
            'subtitle'  => 'Peta',
            'content'   => $this->load->view('pages/peta', ['data' => $this->MBencana->getAll()], true)
        ];
        $this->render($config);
    }

}

