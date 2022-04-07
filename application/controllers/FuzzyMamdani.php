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
        $fuzzy->setItem('Produksi');
        $fuzzy->setInput(['Permintaan', 'Persediaan']);
        $fuzzy->setOutput(['Produksi']);
        dd($fuzzy->output());

        $year = 2020;
        $config = [
            'title'     => 'Data Fuzzy Mamdani | BPBD Kota Kediri',
            'subtitle'  => 'Data Fuzzy Mamdani',
            'content'   => $this->load->view('pages/fuzzy', ['data' => $this->Kelurahan->getBencana($year)], true)
        ];
        $this->render($config);
    }

}