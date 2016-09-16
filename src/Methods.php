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

    public function search($uri, $query, $data = []) {
        $data['q'] = $query;

        return $this->get($uri, $data);
    }

    public function byMunicipalities($uri, $municipalities, $data = []) {
        $municipalities = implode('|', $municipalities);

        $data['kommunekode'] = $municipalities;

        return $this->get($uri, $data);
    }

    public function byMunicipality($uri, $municipality, $data = []) {
        return $this->byMunicipalities($uri, [$municipality], $data);
    }

    public function inCircle($uri, $latitude, $longitude, $radius, $data = []) {
        $circle = implode(',', compact('longitude', 'latitude', 'radius'));

        $data['cirkel'] = $circle;

        return $this->get($uri, $data);
    }

}