<?php


class MY_Controller extends CI_controller {


    public function __construct()
    {
        parent::__construct();
        isAuth();
    }

    protected function render( $config = [], $temp = "index")
    {

        $configuration = [
            'title'     => isset($config['title']) ? $config['title'] : 'BPBD Kota Kediri',
            'subtitle'  => isset($config['subtitle']) ? $config['subtitle'] : 'Dashboard',
            'content'   => isset($config['content']) ? $config['content'] : 'No Content',
            'custom_js' => isset($config['custom_js']) ? $config['custom_js'] : '',
        ];

        $this->load->view($temp, $configuration);
    }
}