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

}
