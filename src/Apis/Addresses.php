<?php
/**
 * Author: Nicolaj Egelund <nicomanden@gmail.com>
 * Date: 13/09/2016
 * Time: 11.03
 */

namespace Nicoeg\Dawa\Apis;


trait Addresses {
    /**
     * returns address array
     * @param array $data
     * @return mixed
     */
    public function addresses($data = []) {
        return $this->get('adresser', $data);
    }

    /**
     * Returns addresses which overlaps a given circle
     * @param $latitude
     * @param $longitude
     * @param $radius
     * @param array $data
     * @return mixed
     */
    public function addressesInCircle($latitude, $longitude, $radius, $data = []) {
        $circle = implode(',', compact('longitude', 'latitude', 'radius'));

        $data['cirkel'] = $circle;

        return $this->addresses($data);
    }
}