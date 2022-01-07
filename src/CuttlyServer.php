<?php
/**
 * CuttlyServer class.. connecting api and make the api functions from here...
 * By: Technoyer Solutions Ltd
 * Author: Mohamed Gomaa <technoyer@gmail.com>
 * Company URL: www.technoyer.com
 */
namespace Technoyer\Cuttly;

use Illuminate\Support\Facades\Http;
use Technoyer\Cuttly\Exceptions\InvalidDataException;
use Technoyer\Cuttly\Exceptions\AccessDeniedException;
use Technoyer\Cuttly\Exceptions\InvalidResponseException;

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

        $data["short"] = ($url);
        if( $tag )
        {
            $data["name"] = $tag;
        }

        
        $api_url = $this->api_url."&".http_build_query($data);
        
        $response = Http::get($api_url);
        //Server response status code
        $response_status = $response->status();

        if( $response_status!=200 )
        {
            throw new InvalidResponseException('Can not connect to the server, Status Code: '.$response_status);
        }

        //retrieve response body
        $body = json_decode($response->body());
        
        //API response body - retrieve status in order to handling errors
        $status = $body->url->status;

        if( $status!='7' )
        {
            switch ($status){
                case '1':
                    throw new InvalidResponseException('the shortened link comes from the domain that shortens the link, i.e. the link has already been shortened');
                    break;
                case '2':
                    throw new InvalidResponseException('the entered link is not a link');
                    break;
                case '3':
                    throw new InvalidResponseException('the preferred link name is already taken (tag taken)');
                    break;
                case '4':
                    throw new AccessDeniedException('Invalid API Key, Please check https://cutt.ly/edit');
                    break;
                case '5':
                    throw new AccessDeniedException('the link has not passed the validation. Includes invalid characters');
                    break;
                case '6':
                    throw new AccessDeniedException('The link provided is from a blocked domain');
                    break;
            }
        }

        //return short link if the status code is: 7
        return $body->url->shortLink;
    }

 }
?>