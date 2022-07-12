<?php

/**
 * 
    Rumus
    µALow [x] 	:   1; 		if x ≤ a
		 	        (b - x) / (b - a); 	if a ≤ x < b
      		        0; 		if x ≥ b					(1)
	µAMedium [x]:   0; 		if x ≤ a or x ≥ c
			        (x - a) / (b - a); 	if a ≤ x < b
		 	        (c - x) / (c - b); 	if b ≤ x < c	(2)
	µAHigh [x]  :   0; 		if x ≤ b
		 	        (x - b) / (c - b); 	if b ≤ x < c
		 	        1; 		if x ≥ c		      		(3)
  
 */
class Fuzzy {


    private $variable;
    private $range;
    private $rules = [
        'Banjir' => [
            [
                'Bencana' => 'Rendah',
                'Populasi' => 'Rendah',
                'Bangunan' => 'Tinggi',
                'Faskes' => 'Tinggi',
            ],
            [
                'Bencana' => 'Rendah',
                'Populasi' => 'Sedang',
                'Bangunan' => 'Tinggi',
                'Faskes' => 'Tinggi',
            ]
        ],
        'Cuaca Ekstrim' => [
            [
                'Bencana' => 'Rendah',
                'Populasi' => 'Rendah',
                'Bangunan' => 'Tinggi',
                'Faskes' => 'Tinggi',
            ],
            [
                'Bencana' => 'Rendah',
                'Populasi' => 'Sedang',
                'Bangunan' => 'Tinggi',
                'Faskes' => 'Tinggi',
            ]
        ],
        'Gempa Bumi' => [
            [
                'Bencana' => 'Rendah',
                'Populasi' => 'Rendah',
                'Bangunan' => 'Tinggi',
                'Faskes' => 'Tinggi',   
            ]
            ],
        'Kekeringan' => [
            [
                'Bencana' => 'Rendah',
                'Populasi' => 'Rendah',
                'Bangunan' => 'Rendah',
                'Faskes' => 'Rendah',   
            ]
            ],
        'Tanah Longsor' => [
            [
                'Bencana' => 'Rendah',
                'Populasi' => 'Rendah',
                'Bangunan' => 'Tinggi',
                'Faskes' => 'Tinggi',   
            ]
        ]
    ];

    public function setRange()
    {
        $this->variable = ['Bencana', 'Populasi', 'Bangunan', 'Faskes'];
        $range = [
            'variable'  => $this->variable,
            'linguistik'=> [
                'Bencana' => [
                    'himpunan'  => ['Rendah', 'Sedang', 'Tinggi'],
                    'domain'    => [
                        'Rendah' => [0,4],
                        'Sedang' => [1,8],
                        'Tinggi' => [4]
                    ]
                ],
                'Populasi' => [
                    'himpunan' => ['Rendah', 'Sedang', 'Tinggi'],
                    'domain'    => [
                        'Rendah' => [0,23269],
                        'Sedang' => [2760,43778],
                        'Tinggi' => [23269]
                    ]
                ],
                'Bangunan' => [
                    'himpunan' => ['Rendah', 'Sedang', 'Tinggi'],
                    'domain'    => [
                        'Rendah' => [0,500],
                        'Sedang' => [500,1000],
                        'Tinggi' => [1000]
                    ]
                ],
                'Faskes' => [
                    'himpunan' => ['Rendah', 'Sedang', 'Tinggi'],
                    'domain'    => [
                        'Rendah' => [0,500],
                        'Sedang' => [500,1000],
                        'Tinggi' => [1000]
                    ]
                ]
            ]
        ];

        return $range;
    }

    public function output($year)
    {
        $this->range = $this->setRange();
        $results['range'] = $this->range;

        #wilayah
        $ci =& get_instance();
        $bencana = $ci->db->query('SELECT * FROM m_bencana ')->result();
        $wilayah = $ci->db->query('SELECT a.id_kelurahan, a.nama, b.id FROM m_kelurahan a LEFT JOIN pemetaan_bencana b ON b.kelurahan_id = a.id_kelurahan WHERE b.year= "'.$year.'" ')->result();
        foreach($wilayah as $k=>$v)
        {
            
            foreach($bencana as $ib =>$b )
            {
                $detBencana = $ci->db->query('SELECT * FROM pemetaan_bencana_detail WHERE pemetaan_id = "'. $v->id .'" AND bencana_id = "'. $b->id .'" ')->row();
                foreach($this->variable as $index=>$val)
                {
                    $attr = strtolower($val);
                    $nilai = $detBencana ? ( in_array($attr, ['bangunan', 'faskes']) ?  $detBencana->$attr * 1000 : $detBencana->$attr )  : 0;
                    $v->fuzzy_variable[$b->nama][$attr] = $nilai;

                    $membership = $this->getMemberShip([
                        'key' => $val,
                        'x' => $v->fuzzy_variable[$b->nama][$attr]
                    ]);
                    
                    //[Results][nama_kelurahan][nama_bencana][Bencana|Populasi|Bangunan|Faskes]
                    $results['results'][$v->nama][$b->nama][$val] = [
                        'value'      => $nilai,
                        'membership' => $membership['membership'],
                        'nilai' => number_format($membership['nilai'],2,",","."),
                        'nilai_huruf' => $membership['nilai_huruf'],
                        ];

                }

            }            

        }

        //Build Inference
        if(isset($results['results']) && !empty($results['results']))
        {
            foreach($results['results'] as $kelurahan=>$item)
            {
                
                //collect not nol value
                foreach($item as $bencana => $det )
                {
                    
                    foreach($det as $var => $v )
                    {
                        foreach($v['membership'] as $k => $val )
                        {
                            if( $val != 0 )
                            {
                                $results['inference'][$kelurahan][$bencana][$var][$k] = $val;
                            }
                        }
                    }
                }

            }
        }

        #dd($results['inference']);
        //Build Rules If Else
        if(!empty($results['inference'])) {

            foreach($results['inference'] as $kl => $b)
            {
                
                foreach($b as $bc => $inf )
                {
                    $arrRule = $this->rules[$bc];
                    $results['rules'][$kl][$bc]['array'] = $arrRule;

                    foreach($arrRule as $index=> $rule)
                    {
                        $ifelse="";
                        $n=0;
                        foreach($rule as $k=>$value)
                        {
                            //Rules with Nilai
                            $results['rules'][$kl][$bc]['nilai'][$index][$k] = isset($results['inference'][$kl][$bc][$k][$value]) ? $results['inference'][$kl][$bc][$k][$value] : 0;

                            $ifelse .= $n == 0 ? 'IF ': '';
                            $ifelse .= '<b>'. $k. ' ' .$value. '</b> AND ';
                            $n++;

                        }

                        foreach($results['rules'][$kl][$bc]['nilai'] as $kN => $n )
                        {
                            $results['rules'][$kl][$bc]['min'][$kN] = number_format(min($n),2);

                            $indexFind = array_search(min($n), $n);
                            $results['rules'][$kl][$bc]['caption'][$kN] = $results['rules'][$kl][$bc]['array'][$kN][$indexFind];
                        }

                        //Formating IF .. AND .. AND .. THEN
                        $explode = explode("AND", $ifelse);
                        array_pop($explode);
                        $implode = implode("AND", $explode);
                        $ifelse = $implode. 'THEN ';
                        $singleRisk = $results['rules'][$kl][$bc]['caption'][$index];                        
                        $weight = $this->getWeight($singleRisk);

                        $ifelse = $ifelse . '<b>Single Risk '.$singleRisk.' </b>';
                        $ifelse .= '<br>';
                        $ifelse .= 'Weight = <b>'. $weight. '</b> Predict = ';
                        $ifelse .= '('. implode(";",$results['rules'][$kl][$bc]['nilai'][$index]) .') = '.$results['rules'][$kl][$bc]['min'][$index].' (min)';


                        $results['rules'][$kl][$bc]['text'][$index] = $ifelse;
                        $results['rules'][$kl][$bc]['wight'][$index] = $weight;

                        $results['defuzzy'][$kl][$bc]['up'][$index] = $weight * $results['rules'][$kl][$bc]['min'][$index];
                        $results['defuzzy'][$kl][$bc]['down'][$index] = $results['rules'][$kl][$bc]['min'][$index];
                        $results['defuzzy'][$kl][$bc]['up_text'][$index] = $weight .'*'. $results['rules'][$kl][$bc]['min'][$index];

                        $results['defuzzy'][$kl][$bc]['total_up'] = isset($results['defuzzy'][$kl][$bc]['total_up']) ? ($results['defuzzy'][$kl][$bc]['total_up']+$results['defuzzy'][$kl][$bc]['up'][$index]) : $results['defuzzy'][$kl][$bc]['up'][$index];
                        $results['defuzzy'][$kl][$bc]['total_down'] = isset($results['defuzzy'][$kl][$bc]['total_down']) ? ($results['defuzzy'][$kl][$bc]['total_down']+$results['defuzzy'][$kl][$bc]['down'][$index]) : $results['defuzzy'][$kl][$bc]['down'][$index];

                        $results['defuzzy'][$kl][$bc]['z'] = $results['defuzzy'][$kl][$bc]['total_down'] > 0 ? $results['defuzzy'][$kl][$bc]['total_up'] / $results['defuzzy'][$kl][$bc]['total_down'] : 0;
                        $results['defuzzy'][$kl][$bc]['output'] = $this->getFuzzyOutput($results['defuzzy'][$kl][$bc]['z']);
                    }

                    $pembilang = implode(" + ", $results['defuzzy'][$kl][$bc]['up_text']);
                    $penyebut = implode(" + ", $results['defuzzy'][$kl][$bc]['down']);
                    $results['defuzzy'][$kl][$bc]['rumus'] = 'z='. $pembilang ." / ". $penyebut. ' = '. $results['defuzzy'][$kl][$bc]['z'];

                    #save to DB
                    $mkelurahan = $ci->db->select('id_kelurahan')->get_where('m_kelurahan', ['nama' => $kl])->row();
                    $mbencana = $ci->db->select('id')->get_where('m_bencana', ['nama' => $bc])->row();

                    $head = ['tahun' => $year, 'id_kelurahan' => $mkelurahan->id_kelurahan];
                    $exist = $ci->db->select('id')->get_where('fuzzy_results', $head)->row();
                    if(!$exist)
                    {
                        $exist = $ci->db->insert('fuzzy_results', $head);
                        $id = $ci->db->insert_id();
                    }else{
                        $id = $exist->id;
                    }

                    $out = $results['defuzzy'][$kl][$bc]['z'];
                    $status = $results['defuzzy'][$kl][$bc]['output'];

                    $existDet = $ci->db->select('fuzzy_id')->get_where('fuzzy_result_details', ['fuzzy_id' => $id, 'id_bencana' => $mbencana->id])->row();
                    if(!$existDet)
                    {
                        $ci->db->insert('fuzzy_result_details', ['fuzzy_id' => $id, 'id_bencana' => $mbencana->id, 'out' => $out, 'status' => $status ]);
                    }else{
                        $ci->db->where('fuzzy_id', $id);
                        $ci->db->where('id_bencana', $mbencana->id);
                        $ci->db->update('fuzzy_result_details', ['out' => $out, 'status' => $status ]);
                    }
                }
            }
        };
        
        return $results;
        
    }

    public function getMemberShip($param)
    {
        $arr = ['Rendah' => $this->_setLow($param['key'], $param['x']), 'Sedang' => $this->_setMedium($param['key'], $param['x']), 'Tinggi' => $this->_setHigh($param['key'], $param['x'])];

        $nilaiKeanggotaan = max($arr);
        $index = array_search(max($arr), $arr);

        $max = max($arr);
        $indexMax = array_search(max($arr), $arr);

        $weight = $this->getWeight($indexMax);

        return ['membership' => $arr, 'nilai' => $nilaiKeanggotaan, 'nilai_huruf' => $index, 'max' => $max, 'max_huruf' => $indexMax, 'weight' => $weight ];
    }

    /**
     * @param $key IS ENUM ('Bencana','Populasi','Fasilitas','Faskes')
     */
    public function _setLow($key, $x=0)
    {
        $a = $this->range['linguistik'][$key]['domain']['Sedang'][0];
        $b = $this->range['linguistik'][$key]['domain']['Rendah'][1];
    
        $out=0;
        if( $x <= $a ) {
            $out = 1;
        }else if( $a <= $x && $x < $b ) {
            $out = ($b - $x) / ($b - $a);
        }
        else if( $x >= $b ) {
            $out = 0;
        }

        return $out;
    }

    /**
     * @param $key IS ENUM ('Bencana','Populasi','Fasilitas','Faskes')
     */
    public function _setMedium($key, $x=0)
    {
        $a = $this->range['linguistik'][$key]['domain']['Sedang'][0];
        $b = $this->range['linguistik'][$key]['domain']['Rendah'][1];
        $c = $this->range['linguistik'][$key]['domain']['Sedang'][1];

        $out=0;
        if( ($x <= $a) || ($x >= $c) ) {
            $out = 0;
        }else if( ($x >= $a ) && ($x < $b) ) {
            $out = ($x - $a) / ($b - $a);
        }
        else if( ($x >= $b) && ( $x < $c) ) {
            $out = ($c - $x) / ($c - $b);
        }

        return $out;
    }

    /**
     * @param $key IS ENUM ('Bencana','Populasi','Fasilitas','Faskes')
     */
    public function _setHigh($key, $x=0)
    {
        $b = $this->range['linguistik'][$key]['domain']['Rendah'][1];
        $c = $this->range['linguistik'][$key]['domain']['Sedang'][1];

        $out=0;
        if( $x <= $b ) {
            $out = 0;
        }else if( ($x >= $b ) && ($x < $c) ) {
            $out = ($x - $b) / ($c - $b);
        }
        else if( $x >= $c  ) {
            $out = 1;
        }

        return $out;
    }

    public function getWeight($data)
    {
        $w = '';
        switch($data)
        {   
            case 'Rendah':
                $w = 1;
                break;
            case 'Sedang':
                $w = 2;
                break;
            case 'Tinggi':
                $w = 3;
                break;
        }

        return $w;
    }

    public function getFuzzyOutput($total)
    {
        if( $total >= 3 )
        {
            $o = 'Tinggi';
        }else if( $total > 1 )
        {
            $o = 'Sedang';
        }else
        {
            $o = 'Rendah';
        }

        return $o;
    }

}