<?php

if ( !function_exists('dd') ) {
    function dd($str)
    {
        echo '<code>';
        echo '<pre>';
        print_r($str);
        echo '</pre>';
        echo '</code>';
        die();
    }
}

if ( !function_exists('toJson') ) {

    /**
     * toJson()
     *
     * @param mixed $dt
     * 
     * @return json
     */
    function toJson($dt)
    {
        header("Content-type:text/html; charset=UTF-8");
        header("Content-type:application/json");
        echo json_encode($dt, JSON_PRETTY_PRINT);
    }

}

if ( !function_exists('isAuth') ) {
    function isAuth() {
        // Get current CodeIgniter instance
        $CI =& get_instance();
        $CI->load->helper('url');
        $user = $CI->session->userdata('_login_data');

        if (!isset($user)) { 
            redirect( base_url('login') ) ;
            die();
        }
        
    }
}

if ( !function_exists('user') ) {
    function user($index=null)
    {
            $CI =& get_instance();
            $user = json_decode($CI->session->userdata('_login_data'), TRUE);

            
            if($user)
            {
                if( $index )
                {
                    return isset($user[$index]) ? $user[$index] : null;
                }else{
                    return $user;
                }
                
            }else {
                return null;
            }
    }
}

if ( !function_exists('setFlashMsg') ) {
    function setFlashMsg( $msg, $status = 'success')
    {
        
        // Get current CodeIgniter instance
        $CI =& get_instance();
        $CI->load->helper('url');
        $CI->session->set_flashdata('_message', $msg);
        $CI->session->set_flashdata('_status', $status);

    }
}

if ( !function_exists('cache') ) {
    function cache($key, $data, $cache_time = null )
    {
        $ci =& get_instance();
        $ci->load->driver('cache');
        $time = $cache_time ? $cache_time : 14400;

        $cache = $ci->cache->file->get($key);
        if( !$cache )
        {
            $ci->cache->file->save($key, $data, $time );
            $cache = $ci->cache->file->get($key);
        }

        return $cache;

    }
}

/**
 * $dateString = '202204040600';
 */
function parserDatetime($dateString)
{
    $Y = substr($dateString, 0, 4);
    $M = substr($dateString, 4,2);
    $D = substr($dateString, 6,2);
    $H = substr($dateString, 8,2);
    $i = substr($dateString, 10,2);
    $s = "00";

    $new = $Y.'-'.$M. '-'. $D . ' '. $H. ':'.$i.':'.$s;
    return date("d M Y H:i", strtotime($new));
}

function parserWheather($code)
{
    $w = "";
    switch($code)
    {
        case 0:
            $w = 'Cerah';
            break;
        case 1:
            $w = 'Cerah Berawan';
            break;
        case 2:
            $w = 'Cerah Berawan';
            break;
        case 3:
            $w = 'Berawan';
            break;
        case 4:
            $w = 'Berawan Tebal';
            break;
        case 5:
            $w = 'Udara Kabur';
            break;
        case 10:
            $w = 'Asap';
            break;
        case 45:
            $w = 'Kabut';
            break;
        case 60:
            $w = 'Hujan Ringan';
            break;
        case 61:
            $w = 'Hujan Sedang';
            break;
        case 63:
            $w = 'Hujan Lebat';
            break;
        case 80:
            $w = 'Hujan Lokal';
            break;
        case 95:
            $w = 'Hujan Petir';
            break;          
        case 97:
            $w = 'Hujan Petir';
            break;
    }
    return $w;
}

function parserWheatherIcon($code)
{
    $w = "";
    switch($code)
    {
        case 0:
            $w = 'clear';
            break;
        case 1:
            $w = 'partly-cloudy';
            break;
        case 2:
            $w = 'partly-cloudy';
            break;
        case 3:
            $w = 'cloudly';
            break;
        case 4:
            $w = 'overcast';
            break;
        case 5:
            $w = 'haze';
            break;
        case 10:
            $w = 'smoke';
            break;
        case 45:
            $w = 'fog';
            break;
        case 60:
            $w = 'light-rain';
            break;
        case 61:
            $w = 'rain';
            break;
        case 63:
            $w = 'heavy-rain';
            break;
        case 80:
            $w = 'isolated-shower';
            break;
        case 95:
            $w = 'thunderstorm';
            break;          
        case 97:
            $w = 'thunderstorm';
            break;
    }
    return $w;
}

function parserWindDirection($code)
{
    $w = "";
    switch($code)
    {
        case 'N':
            $w = 'Utara';
            break;
        case 'NNE':
            $w = 'Utara Timur Laut';
            break;
        case 'NE':
            $w = 'Timur Laut';
            break;
        case 'ENE':
            $w = 'Timur-Timur Laut';
            break;
        case 'E':
            $w = 'Timur';
            break;
        case 'ESE':
            $w = 'Timur-Tenggara';
            break;
        case 'SE':
            $w = 'Tenggara';
            break;
        case 'SSE':
            $w = 'Tenggara-Selatan';
            break;
        case 'S':
            $w = 'Selatan';
            break;
        case 'SSW':
            $w = 'Selatan-Barat Daya';
            break;
        case 'SW':
            $w = 'Barat daya';
            break;
        case 'WSW':
            $w = 'Barat-Barat Daya';
            break;
        case 'W':
            $w = 'Barat';
            break;          
        case 'WNW':
            $w = 'Barat-Barat Laut';
            break;
        case 'NW':
            $w = 'Barat Laut';
            break;
        case 'NNW':
            $w = 'Utara-Barat Laut';
            break;
    }
    return $w;
}