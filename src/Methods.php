<?php
/**
 * Author: Nicolaj Egelund <nicomanden@gmail.com>
 * Date: 16/09/2016
 * Time: 12.21
 */

namespace Nicoeg\Dawa;


trait Methods {
    public function general($uri, $data = []) {
        return $this->get($uri, $data);
    }

    public function singular($uri, $name, $data = []) {
        return $this->get($uri . "/" . $name, $data);
    }

    public function byName($uri, $name, $data = []) {
        $data['navn'] = $name;

        $result = $this->get($uri, $data);

        if (!empty($result))
            return $result[0];

        return null;
    }

    public function inCircle($uri, $latitude, $longitude, $radius, $data = []) {
        $circle = implode(',', compact('longitude', 'latitude', 'radius'));

        $data['cirkel'] = $circle;

        return $this->get($uri, $data);
    }

}