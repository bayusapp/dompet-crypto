<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>INSPINIA | Data Tables</title>

  <link href="<?= base_url('assets/') ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>font-awesome/css/font-awesome.css" rel="stylesheet">

  <link href="<?= base_url('assets/') ?>css/plugins/dataTables/datatables.min.css" rel="stylesheet">

  <link href="<?= base_url('assets/') ?>css/animate.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>css/style.css" rel="stylesheet">

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
            <a href="<?= base_url('Dashboard') ?>"><i class="fa fa-tachometer"></i> <span class="nav-label">Dashboard</span></a>
          </li>
          <li>
            <a href="<?= base_url('HistoryJual') ?>"><i class="fa fa-money"></i> <span class="nav-label">History Jual</span></a>
          </li>
        </ul>

      </div>
    </nav>
    <div id="page-wrapper" class="gray-bg">
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
      <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
          <div class="col-lg-12">
            <h3>Total: Rp <?= number_format($total, 0, ",", ".") ?></h3>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <div class="ibox ">
              <div class="ibox-content">
                <div class="table-responsive">
                  <table class="table table-striped table-bordered table-hover dataTables-example">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Market</th>
                        <th>Tanggal Jual</th>
                        <th>Harga Jual</th>
                        <th>Harga Beli</th>
                        <th>Jumlah Koin</th>
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

  <script src="<?= base_url('assets/') ?>js/plugins/dataTables/datatables.min.js"></script>
  <script src="<?= base_url('assets/') ?>js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>

  <!-- Custom and plugin javascript -->
  <script src="<?= base_url('assets/') ?>js/inspinia.js"></script>
  <script src="<?= base_url('assets/') ?>js/plugins/pace/pace.min.js"></script>

  <!-- Page-Level Scripts -->
  <script>
    $(document).ready(function() {
      $('.dataTables-example').DataTable({
        pageLength: 25,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [],
        "ajax": "<?= base_url('ajaxHistoryJual') ?>",
        "columns": [{
          'data': 'no'
        }, {
          'data': 'cryptocurrency',
        }, {
          'data': 'tanggal_jual'
        }, {
          'data': 'harga_jual'
        }, {
          'data': 'harga_beli'
        }, {
          'data': 'koin'
        }, {
          'data': 'persentase'
        }, {
          'data': 'rupiah'
        }]
      });
    });
  </script>

</body>

</html>