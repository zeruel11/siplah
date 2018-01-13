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

/**
 * test with mock for non empty model - unused for now
 * @return bool assertTrue
 */
	// public function test_get_list_gedung_empty()
	// {
	// 	// Create mock objects for CI_DB_pdo_result and CI_DB_pdo_sqlite_driver
	// 	$return = [
	// 		0 => (array) ['idGedung' => '7', 'kodeGedung' => '11', 'namaGedung' => 'fasor', 'luasGedung' => '22', 'jumlahLantai' => '1', 'x' => '26', 'y' => '24', 'label' => 'a1'],
	// 		1 => (array) ['idGedung' => '8', 'kodeGedung' => '9', 'namaGedung' => 'asrama', 'luasGedung' => '35', 'jumlahLantai' => '2', 'x' => '33', 'y' => '15', 'label' => 'trial2']
	// 		// 2 => (array) ['id' => '3', 'name' => 'DVD'],
	// 	];
	// 	$db_result = $this->getMockBuilder('CI_DB_pdo_result')
	// 	->disableOriginalConstructor()
	// 	->getMock();
	// 	$db_result->method('result_array')->willReturn($return);
	// 	$db = $this->getMockBuilder('CI_DB_pdo_mysql_driver')
	// 	->disableOriginalConstructor()
	// 	->getMock();
	// 	$db->method('get')->willReturn($db_result);

	// 	// Verify invocations
	// 	$this->verifyInvokedOnce(
	// 		$db_result,
	// 		'result_array',
	// 		[]
	// 	);
	// 	$this->verifyInvokedOnce(
	// 		$db,
	// 		'select',
	// 		['idGedung, kodeGedung, namaGedung, luasGedung, jumlahLantai, x, y, label']
	// 	);
	// 	$this->verifyInvokedOnce(
	// 		$db,
	// 		'from',
	// 		['gedung']
	// 	);
	// 	$this->verifyInvokedOnce(
	// 		$db,
	// 		'join',
	// 		['koordinat', 'koordinat.idKoord = gedung.koordGedung', 'left']
	// 	);
	// 	$this->verifyInvokedOnce(
	// 		$db,
	// 		'get',
	// 		[]
	// 	);
	// 	// Replace property db with mock object
	// 	$this->obj->db = $db;
	// 	// $expected = [
	// 	// 	1 => 'Book',
	// 	// 	2 => 'CD',
	// 	// 	3 => 'DVD',
	// 	// ];
	// 	$actual = $this->obj->getListGedung();
	// 	$g=0;
	// 	foreach ($actual as $key) {
	// 		$this->assertArrayHasKey('namaGedung', $actual[$g]);
	// 		$g++;
	// 	}
	// }
/**
 * test if gedung empty with mock data
 * @return bool assertTrue
 */
	public function test_get_list_gedung_empty()
	{
		// Create mock objects for CI_DB_pdo_result and CI_DB_pdo_sqlite_driver
		$return = [];
		$db_result = $this->getMockBuilder('CI_DB_pdo_result')
		->disableOriginalConstructor()
		->getMock();
		$db_result->method('result_array')->willReturn($return);
		$db = $this->getMockBuilder('CI_DB_pdo_mysql_driver')
		->disableOriginalConstructor()
		->getMock();
		$db->method('get')->willReturn($db_result);

		// Verify invocations
		$this->verifyNeverInvoked(
			$db_result,
			'result_array',
			[]
		);
		$this->verifyInvokedOnce(
			$db,
			'select',
			['idGedung, kodeGedung, namaGedung, luasGedung, jumlahLantai, x, y, label']
		);
		$this->verifyInvokedOnce(
			$db,
			'from',
			['gedung']
		);
		$this->verifyInvokedOnce(
			$db,
			'join',
			['koordinat', 'koordinat.idKoord = gedung.koordGedung', 'left']
		);
		$this->verifyInvokedOnce(
			$db,
			'get',
			[]
		);

		// Replace property db with mock object
		$this->obj->db = $db;
		$expected = null;
		$list = $this->obj->getListGedung();
		// foreach ($list as $category) {
		// 	$this->assertEquals($expected[$category->id], $category->name);
		// }
		$this->assertEquals($expected, $list);
	}

}
