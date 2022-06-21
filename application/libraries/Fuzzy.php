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

    public function output()
    {
        $this->range = $this->setRange();
        $results['range'] = $this->range;

        #wilayah
        $ci =& get_instance();
        $bencana = $ci->db->query('SELECT * FROM m_bencana ')->result();
        $wilayah = $ci->db->query('SELECT * FROM m_kelurahan ')->result();
        foreach($wilayah as $k=>$v)
        {
            
            foreach($bencana as $ib =>$b )
            {
                
                foreach($this->variable as $index=>$val)
                {
                    $attr = $val;
                    $v->fuzzy_variable[$b->nama][$attr] = rand(10,55000);
                    $results['results'][$v->nama]['membership'][$b->nama][$val] = $this->getMemberShip([
                        'key' => $val,
                        'x' => $v->fuzzy_variable[$b->nama][$val]
                    ]);
                }
            }            

            /*foreach($this->variable as $index=>$val)
            {
                $results[$v->nama][$val]['membership'] = $this->getMemberShip([
                    'key' => $val,
                    'x' => 250
                ]);
            }*/
        }
        
        
        return $results;
    }

    public function getMemberShip($param)
    {
        return ['Rendah' => $this->_setLow($param['key'], $param['x']), 'Sedang' => $this->_setMedium($param['key'], $param['x']), 'Tinggi' => $this->_setHigh($param['key'], $param['x'])];
    }

    /**
     * @param $key IS ENUM ('Bencana','Populasi','Fasilitas','Faskes')
     */
    public function _setLow($key, $x=0)
    {
        $a = $this->range['linguistik'][$key]['domain']['Rendah'][0];
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
        $b = $this->range['linguistik'][$key]['domain']['Sedang'][1];
        $c = $this->range['linguistik'][$key]['domain']['Tinggi'][0];

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