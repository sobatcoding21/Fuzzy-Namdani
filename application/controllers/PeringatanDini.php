<?php

class PeringatanDIni extends MY_Controller {

    public function index()
    {
        $config = [
            'title'     => 'Peringatan Dini | BPBD Kota Kediri',
            'subtitle'  => 'Peringatan Dini',
            'content'   => $this->load->view('pages/info_bmkg', [ 'data' => $this->getData()], true)
        ];
        $this->render($config);
    }

    private function getData()
    {
        $key = 'xml_digital_forecast_jatim';
        $cache = $this->cache->file->get($key);
        if( !$cache )
        {
            $xmlfile = file_get_contents("https://data.bmkg.go.id/DataMKG/MEWS/DigitalForecast/DigitalForecast-JawaTimur.xml");
            $data = $this->parsingXML($xmlfile);

            $this->cache->file->save($key, $data );
            $cache = $this->cache->file->get($key);
        }
        
        
        $area = $cache['forecast']['area'];
        $result = $area[16]; //Kota Kediri Index 16

        return [
            'attribute' => [
                'name'  => $result['@attributes']['description'],
                'latt'  => $result['@attributes']['latitude'],
                'long'  => $result['@attributes']['longitude'],
            ],
            'humidity' => $result['parameter'][0],
            'humax' => $result['parameter'][1],//max humadity
            'tmax' => $result['parameter'][2],//max temperature
            'humin' => $result['parameter'][3],//min humidity
            'tmin' => $result['parameter'][4],//min temeperature
            't' => $result['parameter'][5],//temperature
            'weather' => $result['parameter'][6],
            'wd'=> $result['parameter'][7], //Wind Direction
            'ws'=> $result['parameter'][8],//Wind Speed
        ];
    }

    private function parsingXML($xmlfile)
    {
        $new  = simplexml_load_string($xmlfile);
        $json = json_encode($new);
        $array= json_decode($json, true);

        return $array;
    }
}