<?php

class Users extends CI_Controller
{

  var $data;

  public function __construct()
  {
    parent::__construct();
    if (userdata('login') != true) {
      redirect();
    }
    $this->data = array('profil' => $this->u->profilAkun(userdata('user_id'))->row());
  }

  public function Dashboard()
  {
    $data = $this->data;
    $data['crypto']             = $this->u->getCryptocurrency()->result();
    $data['beli']               = $this->u->getBeli(userdata('user_id'))->result();
    $data['estimasiAset']       = $this->estimasiNilaiAset();
    $data['modal']              = $this->modal();
    $data['estimasiKeuntungan'] = $this->estimasiKeuntungan();
    $data['estimasiKerugian']   = $this->estimasiKerugian();
    view('users/dashboard', $data);
  }

  public function beli()
  {
    set_rules('tanggal', 'Tanggal', 'required|trim');
    if (validation_run() == true) {
      $tanggal          = input('tanggal');
      $cryptocurrency   = input('cyptocurrency');
      $harga_beli       = input('harga_beli');
      $modal            = input('modal');
      $jumlah_crypto    = $modal / $harga_beli;
      $input            = array(
        'id_crypto'         => $cryptocurrency,
        'tanggal_transaksi' => $tanggal,
        'harga_beli_crypto' => $harga_beli,
        'modal_beli'        => $modal,
        'jumlah_crypto'     => $jumlah_crypto,
        'sisa'              => $jumlah_crypto,
        'user_id'           => userdata('user_id')
      );
      $this->u->insertData('beli', $input);
      set_flashdata('msg', '<div class="alert alert-success">Transaksi sukses disimpan</div>');
      redirect('dashboard');
    }
  }

  public function jual()
  {
    set_rules('tanggal', 'Tanggal', 'required|trim');
    if (validation_run() == true) {
      $tanggal        = input('tanggal');
      $sumber         = input('sumber');
      $harga_jual     = input('harga_jual');
      $dijual         = input('dijual');
      $ambilData      = $this->u->getDataBeli($sumber)->row();
      $input          = array(
        'id_crypto'         => $ambilData->no,
        'id_beli'           => $sumber,
        'tanggal_jual'      => $tanggal,
        'jumlah_crypto'     => $dijual,
        'harga_jual'        => $harga_jual,
        'harga_beli'        => $ambilData->harga_beli_crypto,
        'rupiah_saat_jual'  => $dijual * $harga_jual,
        'rupiah_saat_beli'  => $dijual * $ambilData->harga_beli_crypto,
        'hasil'             => ($dijual * $harga_jual) - ($dijual * $ambilData->harga_beli_crypto),
        'user_id'           => userdata('user_id')
      );
      $this->u->insertData('jual', $input);
      $sisa           = $ambilData->sisa - $dijual;
      $update         = array('sisa' => $sisa);
      $this->u->updateData('beli', $update, 'id_beli', $sumber);
      set_flashdata('msg', '<div class="alert alert-success">Transaksi sukses disimpan</div>');
      redirect('dashboard');
    }
  }

  public function estimasiNilaiAset()
  {
    $json       = file_get_contents("https://indodax.com/api/summaries");
    $obj        = json_decode($json, TRUE);
    $beli       = $this->u->getBeli(userdata('user_id'))->result();
    $nilaiAset  = 0;
    foreach ($beli as $b) {
      $kode = strtolower(str_replace('/', '_', $b->kode));
      $nilaiAset  = $nilaiAset + ($obj['tickers'][$kode]['last'] * $b->sisa);
    }
    return $nilaiAset;
  }

  public function modal()
  {
    $beli       = $this->u->getBeli(userdata('user_id'))->result();
    $nilaiAset  = 0;
    foreach ($beli as $b) {
      $nilaiAset  = $nilaiAset + ($b->sisa * $b->harga_beli_crypto);
    }
    return $nilaiAset;
  }

  public function estimasiKeuntungan()
  {
    $json       = file_get_contents("https://indodax.com/api/summaries");
    $obj        = json_decode($json, TRUE);
    $beli       = $this->u->getBeli(userdata('user_id'))->result();
    $nilaiAset  = 0;
    foreach ($beli as $b) {
      $kode = strtolower(str_replace('/', '_', $b->kode));
      $hargaSekarang  = $obj['tickers'][$kode]['last'];
      if ($hargaSekarang > $b->harga_beli_crypto) {
        $nilaiAset = $nilaiAset + (($hargaSekarang * $b->sisa) - ($b->harga_beli_crypto * $b->sisa));
      }
    }
    return $nilaiAset;
  }

  public function estimasiKerugian()
  {
    $json       = file_get_contents("https://indodax.com/api/summaries");
    $obj        = json_decode($json, TRUE);
    $beli       = $this->u->getBeli(userdata('user_id'))->result();
    $nilaiAset  = 0;
    foreach ($beli as $b) {
      $kode = strtolower(str_replace('/', '_', $b->kode));
      $hargaSekarang  = $obj['tickers'][$kode]['last'];
      if ($hargaSekarang < $b->harga_beli_crypto) {
        $nilaiAset = $nilaiAset + (($hargaSekarang * $b->sisa) - ($b->harga_beli_crypto * $b->sisa));
      }
    }
    return ($nilaiAset * -1);
  }

  public function HistoryJual()
  {
    $data = $this->data;
    $data['total']  = $this->totalHistoryJual();
    view('users/HistoryJual', $data);
  }

  public function totalHistoryJual()
  {
    $total = 0;
    $data = $this->db->query("SELECT * FROM jual JOIN cryptocurrency ON jual.id_crypto = cryptocurrency.no WHERE user_id = '" . userdata('user_id') . "'")->result();
    foreach ($data as $d) {
      $total = $total + $d->hasil;
    }
    return $total;
  }

  public function ajaxCrypto()
  {
    $no = 1;
    $hasil = array();
    $tampil = array();
    $json = file_get_contents("https://indodax.com/api/summaries");
    $obj = json_decode($json, TRUE);
    $data = $this->db->query("SELECT * FROM beli JOIN cryptocurrency ON beli.id_crypto = cryptocurrency.no WHERE sisa > 0 AND user_id = '" . userdata('user_id') . "'")->result();
    foreach ($data as $d) {
      $kode = strtolower(str_replace('/', '_', $d->kode));
      $hitung_persentase = round(((($obj['tickers'][$kode]['last'] - $d->harga_beli_crypto) * $d->sisa) / ($d->harga_beli_crypto * $d->sisa)) * 100, 2);
      if ($hitung_persentase > 0) {
        $persen = '<p><span class="label label-primary">' . $hitung_persentase . '%</span></p>';
        $rupiah = '<p><span class="label label-primary">Rp ' . number_format(($obj['tickers'][$kode]['last'] * $d->sisa) - ($d->harga_beli_crypto * $d->sisa), 0, ",", ".") . '</span></p>';
      } elseif ($hitung_persentase < 0) {
        $persen = '<p><span class="label label-danger">' . $hitung_persentase . '%</span></p>';
        $rupiah = '<p><span class="label label-danger">Rp ' . number_format(($obj['tickers'][$kode]['last'] * $d->sisa) - ($d->harga_beli_crypto * $d->sisa), 0, ",", ".") . '</span></p>';
      }
      $hasil[] = array(
        'no'  => $no++,
        'cryptocurrency'  => $obj['tickers'][$kode]['name'] . " (" . $d->kode . ")",
        'tanggal_beli'    => tanggal_indonesia_medium($d->tanggal_transaksi),
        'harga_beli'      => 'Rp ' . number_format($d->harga_beli_crypto, 0, ",", "."),
        'koin'            => number_format($d->sisa, 2, ",", "."),
        'harga_sekarang'  => 'Rp ' . number_format($obj['tickers'][$kode]['last'], 0, ",", "."),
        'persentase'      => $persen,
        'rupiah'          => $rupiah
      );
    }
    $tampil = array('data' => $hasil);
    echo json_encode($tampil);
    //echo $obj->tickers->btc_idr->sell;
  }

  public function ajaxHistoryJual()
  {
    $no = 1;
    $hasil = array();
    $tampil = array();
    $json = file_get_contents("https://indodax.com/api/summaries");
    $obj = json_decode($json, TRUE);
    $data = $this->db->query("SELECT * FROM jual JOIN cryptocurrency ON jual.id_crypto = cryptocurrency.no WHERE user_id = '" . userdata('user_id') . "'")->result();
    foreach ($data as $d) {
      $kode = strtolower(str_replace('/', '_', $d->kode));
      $hitung_persentase = round(((($d->harga_jual - $d->harga_beli) * $d->jumlah_crypto) / ($d->harga_beli * $d->jumlah_crypto)) * 100, 2);
      if ($hitung_persentase > 0) {
        $persen = '<p><span class="label label-primary">' . $hitung_persentase . '%</span></p>';
        $rupiah = '<p><span class="label label-primary">Rp ' . number_format(($d->harga_jual * $d->jumlah_crypto) - ($d->harga_beli * $d->jumlah_crypto), 0, ",", ".") . '</span></p>';
      } elseif ($hitung_persentase < 0) {
        $persen = '<p><span class="label label-danger">' . $hitung_persentase . '%</span></p>';
        $rupiah = '<p><span class="label label-danger">Rp ' . number_format(($d->harga_jual * $d->jumlah_crypto) - ($d->harga_beli * $d->jumlah_crypto), 0, ",", ".") . '</span></p>';
      }
      $hasil[] = array(
        'no'  => $no++,
        'cryptocurrency'  => $obj['tickers'][$kode]['name'] . " (" . $d->kode . ")",
        'tanggal_jual'    => tanggal_indonesia_medium($d->tanggal_jual),
        'harga_jual'      => 'Rp ' . number_format($d->harga_jual, 0, ",", "."),
        'harga_beli'      => 'Rp ' . number_format($d->harga_beli, 0, ",", "."),
        'koin'            => number_format($d->jumlah_crypto, 2, ",", "."),
        'persentase'      => $persen,
        'rupiah'          => $rupiah
      );
    }
    $tampil = array('data' => $hasil);
    echo json_encode($tampil);
  }

  public function ajax()
  {
    $json = file_get_contents("https://indodax.com/api/summaries");
    $obj = json_decode($json, TRUE);
    // print_r($obj);
    echo '<hr>';
    // echo sizeof($obj['tickers']);
    // echo key($obj['tickers']);
    // $key = key($obj['tickers']);
    // echo $obj['tickers'][key($obj['tickers'])]['sell'];
    // for ($i = 0; $i < sizeof($obj['tickers']); $i++) {
    //   echo key($obj['tickers'][$i]);
    // }
    var_dump($obj);
  }
}
