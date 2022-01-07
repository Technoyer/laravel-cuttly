<?php
/**
 * CuttlyServer class.. connecting api and make the api functions from here...
 * By: Technoyer Solutions Ltd
 * Author: Mohamed Gomaa <technoyer@gmail.com>
 * Company URL: www.technoyer.com
 */
namespace Technoyer\Cuttly;

use Technoyer\Cuttly\Exceptions\InvalidDataException;


 class CuttlyServer
 {
     //Cuttly API Url
    public $api_url;

    //Cuttly API Key
    public $api_key;

    public function __construct($api_key)
    {
        $this->api_key = $api_key;
        $this->api_url = "https://cutt.ly/api/api.php?key=".$this->api_key;
    }

    public function short($url, $tag=false)
    {
        //check if the URL is valid link
        if( false===filter_var($url, FILTER_VALIDATE_URL) )
        {
            throw new InvalidDataException('You have entered invalid URL, The correct URL like this: http(s)://example(.com,.net..)');
        }

        $data["short"] = urlencode($url);
        if( $tag )
        {
            $data["name"] = $tag;
        }

        $api_url = $this->api_url."&".http_build_query($data);

        dd($api_url);
    }

 }
?>