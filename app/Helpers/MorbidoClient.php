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
        $this->url = env('ML_ENGINE_ENDPOINT');
    }

    public function doRequest($method, $path, $body = [])
    {
        try {
            $response = $this->client->request($method, $this->url . $path, $body);  

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $e) {
            return $e;
        }
    }

}
