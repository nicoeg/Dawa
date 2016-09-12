<?php

/**
 * Author: Nicolaj Egelund <nicomanden@gmail.com>
 * Date: 12/09/2016
 * Time: 15.00
 */

namespace Nicoeg\Dawa\Apis;


use Illuminate\Support\Collection;

trait Zipcodes {
    /**
     * Returns zipcode collection
     * @param $data
     * @return Collection
     */
    public function zipcodes($data) {
        return $this->get('postnumre', $data);
    }

    /**
     * Returns a zipcode
     * @param $zipcode
     * @param array $data
     * @return object
     */
    public function zipcode($zipcode, $data = []) {
        return $this->get('postnumre/' . $zipcode, $data);
    }

    /**
     * Returns zipcodes for a given query
     * @param $query
     * @param array $data
     * @return Collection
     */
    public function zipcodeSearch($query, $data = []) {
        $data['q'] = $query;

        return $this->zipcodes($data);
    }

    /**
     * Returns a zipcode for a given name
     * @param $name
     * @param array $data
     * @return object
     */
    public function zipcodeByName($name, $data = []) {
        $data['navn'] = $name;

        return $this->zipcodes($data)->first();
    }

    /**
     * Returns zipcodes for a list of municipalities
     * @param $municipalities
     * @param array $data
     * @return Collection
     */
    public function zipcodesByMunicipalities($municipalities, $data = []) {
        $municipalities = implode('|', $municipalities);

        $data['kommunekode'] = $municipalities;

        return $this->zipcodes($data);
    }

    /**
     * Returns zipcodes for a municipality
     * @param $municipality
     * @param array $data
     * @return Collection
     */
    public function zipcodesByMunicipality($municipality, $data = []) {
        return $this->zipcodesByMunicipalities([$municipality], $data);
    }

    /**
     * Returns zipcodes which overlaps a given circle
     * @param $latitude
     * @param $longitude
     * @param string|integer $radius in meters
     * @param array $data
     * @return Collection
     */
    public function zipcodesInCircle($latitude, $longitude, $radius, $data = []) {
        $circle = implode(',', compact('longitude', 'latitude', 'radius'));

        $data['cirkel'] = $circle;

        return $this->zipcodes($data);
    }

    /**
     * TODO: Fix this ples
     * Returns zipcodes which overlaps a given polygon
     * @param array $polygon List of coordinates (Latitude first) eg. [[55.0, 10.00], [55.3, 10.4]]
     * @param array $data
     * @return Collection
     */
    public function zipcodesInPolygon($polygon, $data = []) {
        $string = "[[";

        foreach ($polygon as $pos) {
            $string .= "[" . $pos[1] . "][" . $pos[0] . "]";
        }

        $string .= "]]";

        $data["polygon"] = $string;

        return $this->zipcodes($data);
    }
}