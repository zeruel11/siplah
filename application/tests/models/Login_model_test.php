<?php
/**
* 
*/
class Login_model_test extends TestCase
{
	
	public function setUp()
    {
        $this->obj = $this->newModel('Login_model');
    }

	public function test_login_valid()
	{
		$actual = $this->obj->login('admin', '13the.zero');
		$this->assertInternalType('array', $actual);
		$this->assertEquals(1, count($actual));

		$expectedIndex = ['user_level', 'namaLengkap'];
		$expectedValue = ['1', 'w sakti'];

		for ($g=0; $g < count($expectedIndex); $g++) {
		$this->assertAttributeSame($expectedValue[$g], $expectedIndex[$g], $actual[0]);
		}
	}

	// public function test_valid_get_list_gedung()
 //  {
 //    $actual = $this->obj->getListGedung();
 //    $this->assertInternalType('array', $actual);

 //    $g=0;
 //    foreach ($actual as $key) {
 //     $this->assertArrayHasKey('namaGedung', $actual[$g]);
 //     $g++;
 //    }
 //  }
}