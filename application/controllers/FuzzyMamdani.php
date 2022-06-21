<?php

class FuzzyMamdani extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Fuzzy');
        $this->load->model(['Kecamatan', 'Kelurahan']);
    }

    public function index()
    {
        $fuzzy = new Fuzzy;
        dd($fuzzy->output()['results']);

        $year = 2020;
        $config = [
            'title'     => 'Data Fuzzy Mamdani | BPBD Kota Kediri',
            'subtitle'  => 'Data Fuzzy Mamdani',
            'content'   => $this->load->view('pages/fuzzy', ['data' => $this->Kelurahan->getBencana($year)], true)
        ];
        $this->render($config);
    }

}