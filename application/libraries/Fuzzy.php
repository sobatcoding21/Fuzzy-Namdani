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
                        'Rendah' => [0,29240],
                        'Sedang' => [2456,51024],
                        'Tinggi' => [29240]
                    ]
                ],
                'Faskes' => [
                    'himpunan' => ['Rendah', 'Sedang', 'Tinggi'],
                    'domain'    => [
                        'Rendah' => [0,72],
                        'Sedang' => [28,115],
                        'Tinggi' => [72]
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
                    $v->fuzzy_variable[$b->nama][$attr] = $detBencana ? $detBencana->$attr : 0;

                    $membership = $this->getMemberShip([
                        'key' => $val,
                        'x' => $v->fuzzy_variable[$b->nama][$attr]
                    ]);
                    
                    //[Results][nama_kelurahan][nama_bencana][Bencana|Populasi|Bangunan|Faskes]
                    $results['results'][$v->nama][$b->nama][$val] = [
                        'membership' => $membership['membership'],
                        'nilai' => number_format($membership['nilai'],2,",","."),
                        'nilai_huruf' => $membership['nilai_huruf'],
                        ];

                    $results['rules'][$b->nama][$v->nama]['if'][$val] = $membership['nilai_huruf'];
                    $results['rules'][$b->nama][$v->nama]['if_nilai'][$val] = number_format($membership['nilai'],2,",",".");
                    $results['rules'][$b->nama][$v->nama]['max'] = $membership['max_huruf'];
                    $results['rules'][$b->nama][$v->nama]['min_nilai'] = number_format($membership['nilai'],2,",",".");
                    
                    //Defuzzy
                    $results['defuzzy'][$b->nama][$v->nama][$val] = [];
                }

                //REFORMAT rules                
            }            

        }
        dd($results['defuzzy']);
        if(!empty($results['rules']))
        {
            foreach($results['rules'] as $bencana => $val)
            {
                
                foreach($val as $kelurahan => $data)
                {
                    
                    $cont = '';
                    $n = 0;
                    $maxs= '';
                    foreach($data['if'] as $index => $d) {
                        
                        $cont .= $n == 0 ? 'IF ': '';
                        $cont .= '<b>'. $index. ' ' .$d. '</b> THEN ';
                        $n++;
                    }

                    $w = '';
                    switch($data['max'])
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
                    $cont = $cont . '<b>Single Risk ' .strtoupper($data['max']).'</b>';
                    $cont .= '<br/>Weight : <b>'. $w.'</b>';

                    $pred = '('. implode(";",$data['if_nilai']) .') = '.$data['min_nilai'].' (min)';
                    $cont .= ' Predic : <b>'. $pred .'</b>';

                    $results['rules'][$bencana][$kelurahan] = $cont;
                }

                #$results['rules'][$bencana] = array_unique(array_values($results['rules'][$bencana]));
                
            }
        }
        #dd($results['rules']);
        return $results;
    }

    public function getMemberShip($param)
    {
        $arr = ['Rendah' => $this->_setLow($param['key'], $param['x']), 'Sedang' => $this->_setMedium($param['key'], $param['x']), 'Tinggi' => $this->_setHigh($param['key'], $param['x'])];

        $nilaiKeanggotaan = min($arr);
        $index = array_search(min($arr), $arr);

        $max = max($arr);
        $indexMax = array_search(max($arr), $arr);

        return ['membership' => $arr, 'nilai' => $nilaiKeanggotaan, 'nilai_huruf' => $index, 'max' => $max, 'max_huruf' => $indexMax ];
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
        }else if( ($x >= $a ) && ($x <= $b) ) {
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
        $b = $this->range['linguistik'][$key]['domain']['Tinggi'][0];
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

}