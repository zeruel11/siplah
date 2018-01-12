<?php

/**
 *
 */
class Beranda_model_test extends TestCase
{

  public function setUp()
    {
        $this->obj = $this->newModel('Beranda_model');
    }

  public function test_valid_get_data_gedung()
  {
    $actual = $this->obj->getDataGedung(7);
    $this->assertInternalType('array', $actual);
    $this->assertEquals(1,count($actual));

    $expectedIndex = ['idGedung', 'namaGedung', 'luasGedung', 'jumlahLantai'];
    $expectedValue = ['7','fasor','22','1'];
    for ($g=0; $g < count($expectedIndex); $g++) {
      $this->assertAttributeSame($expectedValue[$g], $expectedIndex[$g], $actual[0]);
    }

  }

  public function test_invalid_get_data_gedung()
  {
    $actual = $this->obj->getDataGedung(1);

    $this->assertNull($actual);
  }
}
