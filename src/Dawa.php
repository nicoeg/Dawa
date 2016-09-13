<?php
/**
 * Author: Nicolaj Egelund <nicomanden@gmail.com>
 * Date: 12/09/2016
 * Time: 14.06
 */

namespace Nicoeg\Dawa;

use GuzzleHttp\Client;
use Nicoeg\Dawa\Apis\Addresses;
use Nicoeg\Dawa\Apis\Zipcodes;

class Dawa {
    use Zipcodes, Addresses;

    private $client;

    private $base = "https://dawa.aws.dk";

    public function __construct() {
        $this->client = new Client(['base_uri' => $this->base]);
    }

    /**
     * Create a basic get request
     * @param string $uri Entry point
     * @param array $data GET parameters
     * @return object
     */
    public function get($uri, $data = []) {
        $response = $this->client->get($uri, ['query' => $data]);

        return $this->decodeResponse($response);
    }

    /**
     * Decodes a Guzzle response' body
     * @param $result
     * @return Collection
     */
    public function decodeResponse($result) {
        $body = $result->getBody();
        $decoded = json_decode($body);

        return $decoded;
    }
}