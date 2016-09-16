<?php

use Nicoeg\Dawa\Dawa;
use PHPUnit\Framework\TestCase;

class MethodsTest extends TestCase {
    public function testGeneral() {
        $dawa = new Dawa;

        $result = $dawa->zipcodes(['nr' => '5250']);

        $this->assertEquals(1, count($result));
        $this->assertEquals("Odense SV", $result[0]->navn);

        $result = $dawa->addresses(['q' => 'Vindegade 130', 'postnr' => '5000']);

        $this->assertEquals(1, count($result));
        $this->assertEquals("Vindegade 130, 5000 Odense C", $result[0]->adressebetegnelse);
    }

    public function testSingular() {
        $dawa = new Dawa;

        $result = $dawa->zipcode('5250');

        $this->assertEquals("Odense SV", $result->navn);

        $result = $dawa->address('0a3f50b4-f649-32b8-e044-0003ba298018');

        $this->assertEquals("Vindegade 130, 5000 Odense C", $result->adressebetegnelse);
    }

    public function testByName() {
        $dawa = new Dawa;

        $result = $dawa->zipcodeByName('Odense SV');

        $this->assertEquals("5250", $result->nr);
    }

    public function testSearch() {
        $dawa = new Dawa;

        $result = $dawa->zipcodeSearch("Odense");

        $this->assertEquals(9, count($result));
    }

    public function testMinicipalities() {
        $dawa = new Dawa;

        $result = $dawa->zipcodeByMunicipalities(['0461']);

        $this->assertEquals("5000", $result[0]->nr);

        $result = $dawa->zipcodeByMunicipality('0461');

        $this->assertEquals("5000", $result[0]->nr);
    }

    public function testInCircle() {
        $dawa = new Dawa;

        $result = $dawa->zipcodesInCircle("55.245589", "10.469713", "100");

        $this->assertEquals(1, count($result));
    }

    public function testPagination() {
        $dawa = new Dawa;

        $result = $dawa->paginate(2, 1)->zipcodeSearch("Odense");

        $this->assertEquals(2, count($result));
        $this->assertEquals("Odense C", $result[0]->navn);

        $result = $dawa->paginate(2, 2)->zipcodeSearch("Odense");

        $this->assertEquals(2, count($result));
        $this->assertEquals("Odense SØ", $result[0]->navn);
    }
}