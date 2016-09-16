<?php
/**
 * Author: Nicolaj Egelund <nicomanden@gmail.com>
 * Date: 12/09/2016
 * Time: 14.06
 */

namespace Nicoeg\Dawa;

use GuzzleHttp\Client;

class Dawa {
    use Methods;

    private $client;

    private $apis;
    private $base = "https://dawa.aws.dk";

    private $perpage = 0;
    private $page = 0;

    public function __construct($perpage = 0, $page = 1) {
        $this->client = new Client(['base_uri' => $this->base]);

        $this->apis = include __DIR__ . '/apis.php';

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

    public function __call($method, $arguments) {
        foreach ($this->apis as $key => $api) {
            // Remove entrypoint from method call
            $function = lcfirst(str_replace($key, '', $method));

            // If is a basic api call
            if ($function == "")
                $function = "general";

            // If is a singular call like: zipcode("5250")
            if ($function == $api['singular']) {
                $method = $key;
                $function = "singular";
            }

            // If is a singular method call like: zipcodeByName("Odense SV")
            if (str_contains($function, $api['singular'])) {
                $method = $key;
                $function = lcfirst(str_replace($api['singular'], '', $function));
            }

            // Check if entrypoint exists and if has the called method
            if (str_contains($method, $key) && in_array($function, $api['methods'])) {
                // Add the uri to parameter list
                array_unshift($arguments, $api['uri']);

                return call_user_func_array(array($this, $function), $arguments);
            }
        }
        
        throw new \Exception("Call to undefined method " . $method);
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