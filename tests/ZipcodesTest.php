<?php
/**
 * Author: Nicolaj Egelund <nicomanden@gmail.com>
 * Date: 12/09/2016
 * Time: 16.37
 */

use Nicoeg\Dawa\Dawa;
use PHPUnit\Framework\TestCase;

class ZipcodesTest extends TestCase {
    public function testZipcodes() {
        $dawa = new Dawa;

        $zipcodes = $dawa->zipcodes(['q' => 'Odense']);

        $this->assertGreaterThanOrEqual(1, $zipcodes->count());
    }

    public function testZipcode() {
        $dawa = new Dawa;

        $zipcode = $dawa->zipcode("5750");

        $this->assertEquals("Ringe", $zipcode->navn);
    }

    public function testZipcodeSearch() {
        $dawa = new Dawa;

        $zipcodes = $dawa->zipcodeSearch('Odense');

        $this->assertGreaterThanOrEqual(1, $zipcodes->count());
    }

    public function testZipcodeByName() {
        $dawa = new Dawa;

        $zipcode = $dawa->zipcodeByName("Odense SV");

        $this->assertEquals("Odense SV", $zipcode->navn);
    }

    public function testZipcodesByMunicipalities() {
        $dawa = new Dawa;

        $zipcodes = $dawa->zipcodesByMunicipalities(["0101", "0430"]);

        $this->assertGreaterThanOrEqual(1, $zipcodes->count());

        $zipcodes = $dawa->zipcodesByMunicipality("0101");

        $this->assertGreaterThanOrEqual(1, $zipcodes->count());
    }
}