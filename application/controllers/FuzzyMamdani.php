<?php

class FuzzyMamdani extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Fuzzy');
        $this->load->model(['Kecamatan', 'Kelurahan', 'Mbencana', 'FuzzyVariable']);
    }

    public function index()
    {
        
        $year = 2020;
        $fuzzy = new Fuzzy;
        $results = $fuzzy->output($year);
        #dd($results['results']);
        $config = [
            'title'     => 'Data Fuzzy Mamdani | BPBD Kota Kediri',
            'subtitle'  => 'Data Fuzzy Mamdani',
            'content'   => $this->load->view('pages/fuzzy', [
                'data' => $results, 'year' => $year,
                'kelurahan' => $this->Kelurahan->getAll(),
                'jbencana' => $this->Mbencana->getAll(),
                'variable' => $this->FuzzyVariable->getAll(),
            ], true),
            'custom_js' => base_url('assets/js/customs/fuzzy.js')
        ];
        $this->render($config);
    }

}