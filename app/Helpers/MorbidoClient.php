<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;

class MorbidoClient {

    public $client;

    private $url;

    public function __construct()
    {
        $this->client = new Client();
        $this->url = 'http://localhost:5000';
    }

    public function doRequest($method, $path, $body = [])
    {
        try {
            $response = $this->client->request($method, $this->url . $path, $body);   
            
            return json_decode($response->getBody());
        } catch (RequestException $e) {
            return $e->getResponse();
        }
    }

}
