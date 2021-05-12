<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>INSPINIA | Dashboard</title>

  <link href="<?= base_url('assets/') ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>css/plugins/toastr/toastr.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>css/animate.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>css/style.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>css/plugins/select2/select2.min.css" rel="stylesheet">
  <style>
    .select2-dropdown {
      z-index: 10060 !important;
      /*1051;*/
    }

    .select2 {
      width: 100% !important;
    }
  </style>

</head>

<body>
  <div id="wrapper">
    <nav class="navbar-default navbar-static-side" role="navigation">
      <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
          <li class="nav-header">
            <div class="dropdown profile-element">
              <img alt="image" class="rounded-circle" src="<?= base_url('assets/') ?>img/profile_small.jpg" />
              <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span class="block m-t-xs font-bold"><?= $profil->user_name; ?></span>
              </a>
            </div>
            <div class="logo-element">
              IN+
            </div>
          </li>
          <li>
            <a href="<?= base_url('dashboard') ?>"><i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span></a>
          </li>
        </ul>

      </div>
    </nav>

    <div id="page-wrapper" class="gray-bg dashbard-1">
      <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
          <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
          </div>
          <ul class="nav navbar-top-links navbar-right">
            <li>
              <a href="<?= base_url('auth/logout') ?>">
                <i class="fa fa-sign-out"></i> Log out
              </a>
            </li>
          </ul>
        </nav>
      </div>
      <div class="wrapper wrapper-content">
        <div class="row">
          <div class="col-lg-3">
            <div class="widget style1 lazur-bg">
              <div class="row">
                <div class="col-4">
                  <i class="fa fa-credit-card-alt fa-5x"></i>
                </div>
                <div class="col-8 text-right">
                  <span> Estimasi Nilai Aset </span>
                  <h4 class="font-bold">Rp <?= number_format($estimasiAset, 0, ",", ".") ?></h4>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="widget style1 blue-bg">
              <div class="row">
                <div class="col-4">
                  <i class="fa fa-info-circle fa-5x"></i>
                </div>
                <div class="col-8 text-right">
                  <span> Modal </span>
                  <h4 class="font-bold">Rp <?= number_format($modal, 0, ",", ".") ?></h4>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="widget style1 navy-bg">
              <div class="row">
                <div class="col-4">
                  <i class="fa fa-plus-square fa-5x"></i>
                </div>
                <div class="col-8 text-right">
                  <span> Estimasi Keuntungan </span>
                  <h4 class="font-bold">Rp <?= number_format($estimasiKeuntungan, 0, ",", ".") ?></h4>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="widget style1 red-bg">
              <div class="row">
                <div class="col-4">
                  <i class="fa fa-minus-square fa-5x"></i>
                </div>
                <div class="col-8 text-right">
                  <span> Estimasi Kerugian </span>
                  <h4 class="font-bold">Rp <?= number_format($estimasiKerugian, 0, ", ", ".") ?></h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row" style="margin-bottom: 10px;">
          <div class="col-lg-12">
            <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#beli"><i class="fa fa-plus-square"></i> Beli</button>
            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#jual"><i class="fa fa-minus-square"></i> Jual</button>
            <div class="modal inmodal fade" id="beli" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Beli Cryptocurrency</h4>
                  </div>
                  <form method="post" action="<?= base_url('users/beli') ?>">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="font-bold">Tanggal Beli</label>
                            <input type="date" name="tanggal" placeholder="Tanggal" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="font-bold">Cryptocurrency</label>
                            <select name="cyptocurrency" class="cryptocurrency form-control">
                              <option></option>
                              <?php
                              foreach ($crypto as $c) {
                                echo '<option value="' . $c->no . '">' . $c->kode . '</option>';
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="font-bold">Harga Beli</label>
                            <input type="text" name="harga_beli" placeholder="Harga Beli" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="font-bold">Modal</label>
                            <input type="text" name="modal" placeholder="Modal" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="modal inmodal fade" id="jual" role="dialog" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Jual Cryptocurrency</h4>
                  </div>
                  <form method="post" action="<?= base_url('users/jual') ?>">
                    <div class="modal-body">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="font-bold">Tanggal Jual</label>
                            <input type="date" name="tanggal" placeholder="Tanggal" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="font-bold">Sumber Dana</label>
                            <select name="sumber" class="cryptocurrency form-control">
                              <option></option>
                              <?php
                              foreach ($beli as $b) {
                                echo '<option value="' . $b->id_beli . '">' . $b->kode . ' - Rp ' . number_format($b->harga_beli_crypto, 0, ",", ".") . '</option>';
                              }
                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="font-bold">Harga Jual</label>
                            <input type="text" name="harga_jual" placeholder="Harga Jual" class="form-control">
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="font-bold">Jumlah Crypto Dijual</label>
                            <input type="text" name="dijual" placeholder="Jumlah Crypto Dijual" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-white" data-dismiss="modal">Tutup</button>
                      <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <?php
            if (flashdata('msg')) {
              echo flashdata('msg');
            }
            ?>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox">
              <div class="ibox-content">
                <table class="table table-bordered table-hover dataTables-example" width="100%">
                  <thead>
                    <tr>
                      <th width="7%">No</th>
                      <th>Market</th>
                      <th>Tanggal Beli</th>
                      <th>Harga Beli</th>
                      <th>Koin</th>
                      <th>Harga Sekarang</th>
                      <th>Persentase</th>
                      <th>Untung/Rugi</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer">
        <div class="float-right">
          10GB of <strong>250GB</strong> Free.
        </div>
        <div>
          <strong>Copyright</strong> Example Company &copy; 2014-2018
        </div>
      </div>
    </div>
  </div>

  <!-- Mainly scripts -->
  <script src="<?= base_url('assets/') ?>js/jquery-3.1.1.min.js"></script>
  <script src="<?= base_url('assets/') ?>js/popper.min.js"></script>
  <script src="<?= base_url('assets/') ?>js/bootstrap.js"></script>
  <script src="<?= base_url('assets/') ?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
  <script src="<?= base_url('assets/') ?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
  <!-- Custom and plugin javascript -->
  <script src="<?= base_url('assets/') ?>js/inspinia.js"></script>
  <script src="<?= base_url('assets/') ?>js/plugins/pace/pace.min.js"></script>
  <script src="<?= base_url('assets/') ?>js/plugins/dataTables/datatables.min.js"></script>
  <script src="<?= base_url('assets/') ?>js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/') ?>js/plugins/select2/select2.full.min.js"></script>
  <script>
    window.setTimeout(function() {
      $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
      });
    }, 5000);

    $(document).ready(function() {
      $(".cryptocurrency").select2({
        placeholder: "Pilih Cryptocurrency",
        allowClear: true
      });

      $('.dataTables-example').DataTable({
        pageLength: 100,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
        "ordering": false,
        "ajax": "<?= base_url('Users/ajaxCrypto') ?>",
        "columns": [{
          'data': 'no'
        }, {
          'data': 'cryptocurrency',
        }, {
          'data': 'tanggal_beli'
        }, {
          'data': 'harga_beli'
        }, {
          'data': 'koin'
        }, {
          'data': 'harga_sekarang'
        }, {
          'data': 'persentase'
        }, {
          'data': 'rupiah'
        }]
      });
    });
  </script>
  <!-- <script>
    var reloadData = 30; // dalam detik

    var timer;

    function updateDataAPI() {

      $.ajax({
        url: 'https://indodax.com/api/summaries',
        success: function(data) {
          var row;
          var no = 0;
          var crypto;
          var type;
          $('#cryptoidr').html('<tr><th>No</th><th>Market</th><th>Harga Terakhir</th><th>Harga Beli</th><th>Harga Jual</th><th>Harga Tertinggi (24 jam)</th><th>Harga Terendah (24 jam)</th></tr>')
          for (var key in data.tickers) {
            no = no + 1;
            crypto = key.toUpperCase();
            type = crypto.split("/");
            row = `<tr>
              <td>` + no + `</td>
              <td>` + crypto.replace("_", "/") + `</td>
              <td>Rp ` + formatNumber(data.tickers[key].last) + `</td>
              <td>Rp ` + formatNumber(data.tickers[key].buy) + `</td>
              <td>Rp ` + formatNumber(data.tickers[key].sell) + `</td>
              <td>Rp ` + formatNumber(data.tickers[key].high) + `</td>
              <td>Rp ` + formatNumber(data.tickers[key].low) + `</td>
            </tr>`
            $('#cryptoidr tr:last').after(row);
          }

          clearTimeout(timer)
          $('#timer').html(reloadData)
          setTimeout(updateDataAPI, reloadData * 1000)
          updateTimer()
        },
        error: function(err) {
          alert("Tidak bisa mengambil data API")
        }
      })
    }

    function formatNumber(n) {
      if (n.indexOf('.') > -1)
        return parseFloat(n).toFixed(8);
      else
        return parseInt(n).toLocaleString("id-ID")
    }

    function updateTimer() {
      a = parseInt($('#timer').html())
      $('#timer').html(a - 1)
      if (a > 0)
        timer = setTimeout(updateTimer, 1000)
    }
    updateDataAPI()
  </script> -->
</body>

</html>