<?php

class Fuzzy {

    private $item;

    private $input;

    private $output;

    private $variable;

    public function setItem($item)
    {
        return $this->item = $item;
    }

    public function setInput($variable)
    {
        $this->variable = $variable;
        $this->input = $this->variable; 
    }

    public function setOutput($variable)
    {
        $this->output = $variable; 
    }

    public function output()
    {
        
        $attribute = [
            'attribute' => 'Produksi',
            'variables' => [
                'Permintaan' => [
                    'function'  => 'input',
                    'linguistik'=> [
                        'Turun', 'Normal', 'Naik'
                    ],
                    'semesta'   => ['x' => 0, 'y' => 800], //x is min, y is max
                    'domain'    => [
                        '60-430', '245-615', '430-800'
                    ],
                    'keanggotaan' => [
                        'Turun' => [

                        ], 
                        'Normal', 
                        'Naik'
                    ]
                ],
                'Persediaan' => [
                    'function'  => 'input',
                    'linguistik'=> [
                        'Turun', 'Normal', 'Naik'
                    ],
                    'semesta'   => ['x' => 0, 'y' =>90],
                    'domain'    => [
                        '10-15', '30-70', '50-90'
                    ]
                ],
                'Produksi' => [
                    'function'  => 'ouput',
                    'linguistik'=> [
                        'Berkurang', 'Normal', 'Bertambah'
                    ],
                    'semesta'   => ['a' => 0, 'b' =>800],
                    'domain'    => [
                        '50-425', '240-610', '425-800'
                    ]
                ]
            ] 
        ];

        return $attribute;
    }

}