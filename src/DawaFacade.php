<?php
/**
 * Author: Nicolaj Egelund <nicomanden@gmail.com>
 * Date: 12/09/2016
 * Time: 14.25
 */

namespace Nicoeg\Dawa;


use Illuminate\Support\Facades\Facade;

class DawaFacade extends Facade {
    protected static function getFacadeAccessor() {
        return 'nicoeg-dawa';
    }
}