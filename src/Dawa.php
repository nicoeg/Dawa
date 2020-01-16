<?php
/**
 * Author: Nicolaj Egelund <nicomanden@gmail.com>
 * Date: 12/09/2016
 * Time: 14.06
 */

namespace Nicoeg\Dawa;

use GuzzleHttp\Client;

/**
 * Zipcodes
 * @method array zipcodes($data = [])
 * @method object zipcode($zipcode, $data = [])
 * @method array zipcodeSearch($query, $data = [])
 * @method object zipcodeByName($name, $data = [])
 * @method array zipcodesByMunicipalities($municipalities, $data = [])
 * @method array zipcodesByMunicipality($municipality, $data = [])
 * @method array zipcodesInCircle($latitude, $longitude, $radius, $data = [])
 *
 * Addresses
 * @method array addresses($data = [])
 * @method object address($id, $data = [])
 * @method array addressSearch($query, $data = [])
 * @method array addressesByMunicipalities($municipalities, $data = [])
 * @method array addressesByMunicipality($municipality, $data = [])
 * @method array addressesInCircle($latitude, $longitude, $radius, $data = [])
 *
 * AccessAddresses
 * @method array accessAddresses($data = [])
 * @method object accessAddress($id, $data = [])
 * @method array accessAddressSearch($query, $data = [])
 * @method array accessAddressesByMunicipalities($municipalities, $data = [])
 * @method array accessAddressesByMunicipality($municipality, $data = [])
 * @method array accessAddressesInCircle($latitude, $longitude, $radius, $data = [])
 *
 * Streets
 * @method array streets($data = [])
 * @method object street($street, $data = [])
 * @method array streetSearch($query, $data = [])
 * @method object streetByName($name, $data = [])
 * @method array streetsByMunicipalities($municipalities, $data = [])
 * @method array streetsByMunicipality($municipality, $data = [])
 * @method array streetsInCircle($latitude, $longitude, $radius, $data = [])
 *
 * Municipalities
 * @method array municipalities($data = [])
 * @method object municipality($id, $data = [])
 * @method array municipalitySearch($query, $data = [])
 * @method object municipalityByName($name, $data = [])
 * @method array municipalityInCircle($latitude, $longitude, $radius, $data = [])
 * 
 * Regions
 * @method array regions($data = [])
 * @method object region($id, $data = [])
 * @method array regionSearch($query, $data = [])
 * @method object regionByName($name, $data = [])
 * 
 * Provinces
 * @method array provinces($data = [])
 * @method object province($id, $data = [])
 * @method array provinceSearch($query, $data = [])
 * @method object provinceByName($name, $data = [])
 */

class Dawa {
    use Methods;

    private $client;

    private $apis;
    private $base = "https://dawa.aws.dk";

    private $perpage = 0;
    private $page = 0;

    public function __construct() {
        $this->client = new Client(['base_uri' => $this->base]);

        $this->apis = include __DIR__ . '/apis.php';
    }

    /**
     * Paginate request
     * @param int $perpage items per page
     * @param int $page page number
     * @return Dawa $this
     */
    public function paginate($perpage, $page = 1) {
        $this->perpage = $perpage;
        $this->page = $page;

        return $this;
    }

    /**
     * Checks if method exists in api list then calls method with arguments
     * @param string $method
     * @param array $arguments
     * @throws \Exception
     */
    public function __call($method, $arguments) {
        foreach ($this->apis as $key => $api) {
            // Remove entrypoint from method call
            $function = lcfirst(str_replace($key, '', $method));

            // If it is a basic api call
            if ($function == "")
                $function = "general";

            // If it is a singular call like: zipcode("5250")
            if ($function == $api['singular']) {
                $method = $key;
                $function = "singular";
            }

            // If is a singular method call like: zipcodeByName("Odense SV")
            if (strpos($function, $api['singular']) !== false) {
                $method = $key;
                $function = lcfirst(str_replace($api['singular'], '', $function));
            }

            // Check if entrypoint exists and if has the called method
            if (strpos($method, $key) !== false && in_array($function, $api['methods'])) {
                // Add the uri to parameter list
                array_unshift($arguments, $api['uri']);

                return $this->$function(...$arguments);
            }
        }
        
        throw new \Exception("Call to undefined method " . $method);
    }

    /**
     * Create a basic get request
     * @param string $uri Entry point
     * @param array $data GET parameters
     * @return array|object
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
     * @return array|object
     */
    public function decodeResponse($result) {
        $body = $result->getBody();
        $decoded = json_decode($body);

        return $decoded;
    }
}