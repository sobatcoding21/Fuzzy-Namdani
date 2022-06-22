<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model(['Kecamatan', 'Kelurahan', 'Mbencana', 'Bencana', 'FuzzyVariable']);
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
							'variable' => $this->FuzzyVariable->getAll(),
							'data' => $this->Kelurahan->getBencana($year)
						], true)
		];
		$this->render($config);
	}

	public function simpanBencana()
	{
		$p = $this->input->post();
		$exist = $this->db->get_where('pemetaan_bencana', ['kelurahan_id' => $p['id_kelurahan'], 'year' => $p['tahun']])->row();
		if( $exist )
		{
			$detail = $this->db->get_where('pemetaan_bencana_detail', ['pemetaan_id' => $exist->id, 'bencana_id' => $p['id_bencana']])->row();
			if( $detail )
			{
				$this->db->where('id', $detail->id);
				$this->db->update('pemetaan_bencana_detail', ['bencana' => $p['bencana'], 'populasi' => $p['populasi'], 'bangunan' => $p['bangunan'], 'faskes' => $p['faskes'] ]);
			}else{
				$this->db->insert('pemetaan_bencana_detail', ['pemetaan_id' => $exist->id, 'bencana_id' => $p['id_bencana'], 'bencana' => $p['bencana'], 'populasi' => $p['populasi'], 'bangunan' => $p['bangunan'], 'faskes' => $p['faskes'] ]);
			}

			setFlashMsg("Data bencana sudah pernah diinput sebelumnya", "info");
		}else{

			$this->db->insert('pemetaan_bencana', ['kelurahan_id' => $p['id_kelurahan'], 'year' => $p['tahun'], 'created_at' => date("Y-m-d H:i:s") ]);
			$this->db->insert('pemetaan_bencana_detail', ['pemetaan_id' => $exist->id, 'bencana_id' => $p['id_bencana'], 'bencana' => $p['bencana'], 'populasi' => $p['populasi'], 'bangunan' => $p['bangunan'], 'faskes' => $p['faskes'] ]);
			setFlashMsg("Data bencana berhasil disimpan");
		}

		redirect( base_url());
		
	}

	public function dummyDb()
	{
		$rows = $this->db->get('m_kelurahan')->result();
		$bencana = $this->db->get('m_bencana')->result();
		foreach($rows as $index=>$val)
		{
			if( !$exist = $this->db->get_where('pemetaan_bencana', ['year' => '2020', 'kelurahan_id' => $val->id_kelurahan])->row() )
			{
				$insert = [
					'year' => '2020',
					'kelurahan_id' => $val->id_kelurahan,
					'created_at' => date("Y-m-d H:i:s")
				];

				$this->db->insert('pemetaan_bencana', $insert);
				$id = $this->db->insert_id();
			}else{
				$id = $exist->id;
			}

			foreach($bencana as $k=>$b)
			{
				if( !$ex = $this->db->get_where('pemetaan_bencana_detail', ['pemetaan_id' => $id, 'bencana_id' => $b->id])->row() )
				{
					$insertDet = [
						'pemetaan_id' => $id,
						'bencana_id' => $b->id,
						'bencana'	=> rand(0,10),
						'populasi'	=> rand(1000,5000),
						'bangunan'	=> rand(1000,5000),
						'faskes'	=> rand(10,200),
						'created_at' => date("Y-m-d H:i:s")
					];
					$this->db->insert('pemetaan_bencana_detail', $insertDet);
				}
			}

			
		}

		
	}

}
