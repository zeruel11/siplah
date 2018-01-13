<?php
/**
*
*/
class Ver_login_test extends TestCase
{

	public function test_index_valid_cred()
	{
		$creds = ['username'=>'admin', 'password'=>'13the.zero'];
		$method = ['Ver_login', 'index'];
		$output = $this->request(
			'POST',
			$method,
			$creds
		);

		$this->assertRedirect('beranda', 200);

	}

	public function test_index_invalid_cred()
	{
		$creds = ['username'=>'zeruel', 'password'=>'13the.zero'];
		$method = ['Ver_login', 'index'];
		$output = $this->request(
			'POST',
			$method,
			$creds
		);

		$this->assertRedirect('beranda/masuk', 200);

	}

	// public function test_set_userdata()
	// {
	// 	$output = $this->request('GET', 'sessions/set_userdata');
	// 	$expected = 'set_userdata';
	// 	$this->assertEquals($expected, $output);
	// }

	// public function test_logged_in()
	// {
	// 	$this->request->setCallable(
	// 		function ($CI) {
	// 			$CI->session->logged_in = 'true';
	// 		}
	// 	);
	// 	$output = $this->request('GET', 'sessions/logged_in');
	// 	$expected = 'true';
	// 	$this->assertEquals($expected, $output);
	// }
}
