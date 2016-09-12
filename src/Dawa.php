<?php
/**
 * Author: Nicolaj Egelund <nicomanden@gmail.com>
 * Date: 12/09/2016
 * Time: 14.06
 */

namespace Nicoeg\Dawa;

use GuzzleHttp\Client;

class Dawa {
    private $client;

    private $base = "https://dawa.aws.dk";

    public function __construct() {
        $this->client = new Client(['base_uri' => $this->base]);
    }

    public function get($uri, $data = []) {
        return $this->request('get', $uri, $data);
    }

    public function request($method, $uri, $data) {
        $result = $this->client->request($method, $uri, ['query' => $data]);

        $body = $result->getBody()->getContents();

        return json_decode($body);
    }
}