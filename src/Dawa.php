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

    private $perpage = 0;
    private $page = 0;

    public function __construct($perpage = 0, $page = 1) {
        $this->client = new Client(['base_uri' => $this->base]);

        if ($perpage > 0)
            $this->paginate($perpage, $page);
    }

    /**
     * Paginate request
     * @param int $perpage items per page
     * @param int $page page number
     * @return $this
     */
    public function paginate($perpage, $page = 1) {
        $this->perpage = $perpage;
        $this->page = $page;

        return $this;
    }

    /**
     * Create a basic get request
     * @param string $uri Entry point
     * @param array $data GET parameters
     * @return object
     */
    public function get($uri, $data = []) {
        if ($this->perpage > 0) {
            $data['per_side'] = $this->perpage;
            $data['side'] = $this->page;
        }

        $response = $this->client->get($uri, ['query' => $data]);

        return $this->decodeResponse($response);
    }

    /**
     * Decodes a Guzzle response' body
     * @param $result
     * @return array
     */
    public function decodeResponse($result) {
        $body = $result->getBody();
        $decoded = json_decode($body);

        return $decoded;
    }
}