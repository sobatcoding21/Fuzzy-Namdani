<?php

class FuzzyMamdani extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model(['Kecamatan', 'Kelurahan']);
    }

    public function index()
    {
        $year = 2020;
        $config = [
            'title'     => 'Data Fuzzy Mamdani | BPBD Kota Kediri',
            'subtitle'  => 'Data Fuzzy Mamdani',
            'content'   => $this->load->view('pages/fuzzy', ['data' => $this->Kelurahan->getBencana($year)], true)
        ];
        $this->render($config);
    }

}