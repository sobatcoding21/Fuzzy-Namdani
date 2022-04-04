<?php

class Auth extends CI_Controller {

    /**
     * Username & Pwd is Static
     * username : admin
     * pass     : admin
     */
    public function login()
    {
        if( $this->input->post('username') && $this->input->post('password') )
        {
            if( $this->input->post('username') == 'admin' && $this->input->post('password') == 'admin' )
            {
                $this->session->set_userdata('_login_data', json_encode(['name' => $this->input->post('username'), 'username' => $this->input->post('username')]));
                redirect(base_url());
            }else{
                setFlashMsg("Username/Password anda tidak sesuai", "danger");
                redirect(base_url('login'));
            }
        }else{
            $this->load->view('login');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('_login_data');

        redirect(base_url('login'));
    }

}