<?php
/**
 * Author: Nicolaj Egelund <nicomanden@gmail.com>
 * Date: 12/09/2016
 * Time: 14.21
 */

namespace Nicoeg\Dawa;

use Illuminate\Support\ServiceProvider;

class DawaServiceProvider extends ServiceProvider {
    public function register() {
        $this->app->bind('nicoeg-dawa', Dawa::class);
    }
}