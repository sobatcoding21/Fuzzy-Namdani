<?php

class FuzzyMamdani extends MY_Controller {

    public function index()
    {
        $config = [
            'title'     => 'Data Fuzzy Mamdani | BPBD Kota Kediri',
            'subtitle'  => 'Data Fuzzy Mamdani',
            'content'   => $this->load->view('pages/fuzzy', [], true)
        ];
        $this->render($config);
    }

}