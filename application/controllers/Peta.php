<?php

class Peta extends MY_Controller {

    public function index()
    {
        
        $config = [
            'title'     => 'Peta | BPBD Kota Kediri',
            'subtitle'  => 'Peta',
            'content'   => $this->load->view('pages/peta', [], true)
        ];
        $this->render($config);
    }

}

