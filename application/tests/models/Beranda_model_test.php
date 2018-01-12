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

  public function test_get_data_gedung_valid()
  {
    $actual = $this->obj->getDataGedung(7);
    $this->assertInternalType('array', $actual);
    $this->assertEquals(1,count($actual));

    $expected = ['idGedung'=>'7',
    'namaGedung'=>'fasor',
    'luasGedung'=>'22',
    'jumlahLantai'=>'1'];
    
    $this->assertEquals($expected,$actual[0]);

    ////////////////////////////////////////////////////////////////////
    // leftover method from using object array instead of array array //
    ////////////////////////////////////////////////////////////////////
    // $expectedIndex = ['idGedung', 'namaGedung', 'luasGedung', 'jumlahLantai'];
    // $expectedValue = ['7','fasor','22','1'];
    // for ($g=0; $g < count($expectedIndex); $g++) {
      // $this->assertAttributeSame($expectedValue[$g], $expectedIndex[$g], $actual[0]);
    // }
  }

  public function test_get_data_gedung_invalid()
  {
    $actual = $this->obj->getDataGedung(1);

    $this->assertNull($actual);
  }

  public function test_get_list_gedung_valid()
  {
    $actual = $this->obj->getListGedung();
    $this->assertInternalType('array', $actual);

    $g=0;
    foreach ($actual as $key) {
     $this->assertArrayHasKey('namaGedung', $actual[$g]);
     $g++;
    }
  }

  // public function test_invalid_get_data_gedung($value='')
  // {
  //   # code...
  // }

}
