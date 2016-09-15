<?php

use Nicoeg\Dawa\Dawa;
use PHPUnit\Framework\TestCase;

class AddressesTest extends TestCase {
    public function testAddresses() {
        $dawa = new Dawa;

        $addresses = $dawa->addresses(['q' => 'Vestergade 93']);

        $this->assertGreaterThanOrEqual(1, count($addresses));
    }

    public function testPagination() {
        $dawa = new Dawa;

        $addresses = (new Dawa(2, 1))->addressesInCircle("55.245589", "10.469713", "100");

        $this->assertEquals('Hallingager 2, 5750 Ringe', $addresses[0]->adressebetegnelse);
        $this->assertEquals(2, count($addresses));

        $addresses = $dawa->paginate(2, 2)->addressesInCircle("55.245589", "10.469713", "100");
        
        $this->assertEquals('Hallingager 12, 5750 Ringe', $addresses[0]->adressebetegnelse);
        $this->assertEquals(2, count($addresses));
    }

    public function testAddressesInCircle() {
        $dawa = new Dawa;

        $addresses = $dawa->addressesInCircle("55.245589", "10.469713", "100");

        $this->assertGreaterThanOrEqual(1, count($addresses));
    }
}