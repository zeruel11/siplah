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

  public function test_index_logged_in_admin()
  {
    $this->request->setCallable(
      function ($CI) {
        $CI->session->logged_in = array(
          'uid'=>'1',
          'userLevel'=>'1',
          'namaLengkap'=>'w sakti');
      }
    );
    $output = $this->request('GET', 'beranda/index');
    $expected = 'class="d-inline-block align-center" width="35" height="35">Selamat datang Admin w sakti';
    $this->assertContains($expected, $output);
  }

  public function test_index_logged_in_pegawai()
  {
    $this->request->setCallable(
      function ($CI) {
        $CI->session->logged_in = array(
          'uid'=>'1',
          'userLevel'=>'2',
          'namaLengkap'=>'w sakti');
      }
    );
    $output = $this->request('GET', 'beranda/index');
    $expected = 'class="d-inline-block align-center" width="35" height="35">Selamat datang Pegawai w sakti';
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

    $this->assertRedirect('beranda', 200);
  }

  public function test_keluar()
  {
    $this->request->setCallable(
      function ($CI) {
        $CI->session->logged_in = 'true';
      }
    );
    $output = $this->request('GET', 'logout');
    $expected = null;
    $this->assertEquals($expected, $output);
    $this->assertRedirect('beranda', 302);
  }

}
