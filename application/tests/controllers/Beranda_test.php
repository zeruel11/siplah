<?php
/**
 *
 */
class Beranda_test extends TestCase
{

  public function test_index()
  {
    $output = $this->request('GET', 'beranda/index');
    $expected = '<title>SIPLAH ITS</title>';

    $this->assertContains($expected, $output);
  }

  public function test_index_logged_in()
  {
    $this->request->setCallable(
      function ($CI) {
        $CI->session->logged_in = 'true';
      }
    );
    $output = $this->request('GET', 'beranda/index');
    $expected = '<title>SIPLAH ITS - Pengguna: ';
    $this->assertContains($expected, $output);
  }

  public function test_valid_detail_gedung()
  {
    $output = $this->request('GET', 'gedung/7');
    $expected = '<h4 class="card-text">Gedung';

    $this->assertContains($expected, $output);
  }

  public function test_invalid_detail_gedung()
  {
    $output = $this->request('GET', 'gedung/1');
    $expected = '<h4 class="card-text">Gedung tidak ditemukan</h4>';

    $this->assertContains($expected, $output);
  }

  public function test_masuk()
  {
    $output = $this->request('GET', 'login');
    $expected = '<title>SIPLAH - Login</title>';

    $this->assertContains($expected, $output);
  }

  public function test_masuk_logged_in()
  {
    $this->request->setCallable(
      function ($CI) {
        $CI->session->logged_in = 'true';
      }
    );
    $output = $this->request('GET', 'login');

    $this->assertRedirect('beranda');
  }

  public function test_keluar()
  {
    $this->request('GET', 'logout');
    $this->assertRedirect('beranda');
  }

}
