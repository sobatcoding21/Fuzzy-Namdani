<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(['Kecamatan', 'Kelurahan', 'Mbencana', 'Bencana']);
    }

	public function index()
	{
		$year = $this->input->get('tahun') ? $this->input->get('tahun') : '2020';
		$config = [
			'title' => 'Data Bencana Hidrometeorologi',
			'subtitle' => 'Data Bencana Hidrometeorologi',
			'content'   => $this->load->view('pages/dashboard', [
							'tahun' => $year,
							'kelurahan' => $this->Kelurahan->getAll(),
							'jbencana' => $this->Mbencana->getAll(),
							'data' => $this->Kelurahan->getBencana($year)
						], true)
		];
		$this->render($config);
	}

	public function simpanBencana()
	{
		$p = $this->input->post();
		$exist = $this->Bencana->find(['tahun' => $p['tahun'], 'id_kelurahan' => $p['id_kelurahan'], 'id_bencana' => $p['id_bencana']]);
		if( $exist )
		{
			setFlashMsg("Data bencana sudah pernah diinput sebelumnya", "info");
		}else{

			$this->Bencana->insert($p);
			setFlashMsg("Data bencana berhasil disimpan");
		}

		redirect( base_url());
		
	}

}
