<?php

use Nicoeg\Dawa\Dawa;
use PHPUnit\Framework\TestCase;

class AddressesTest extends TestCase {
    public function testAddresses() {
        $dawa = new Dawa;

        $addresses = $dawa->addresses(['q' => 'Vestergade 93']);

        $this->assertGreaterThanOrEqual(1, count($addresses));
    }

    public function testAddressesInCircle() {
        $dawa = new Dawa;

        $addresses = $dawa->addressesInCircle("55.245589", "10.469713", "100");

        $this->assertGreaterThanOrEqual(1, count($addresses));
    }
}