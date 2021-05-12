<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>INSPINIA | Login 2</title>
  <link href="<?= base_url('assets/') ?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>font-awesome/css/font-awesome.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>css/animate.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>css/style.css" rel="stylesheet">
  <style>
    body {
      background: url('<?= base_url('assets/'); ?>img/23904.jpg') no-repeat center center fixed;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
  </style>
</head>

<body class="gray-bg">

  <div class="loginColumns animated fadeInDown">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <div class="ibox-content">
          <form class="m-t" role="form" method="post" action="<?= base_url('auth/daftar') ?>">
            <div class="form-group">
              <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required="">
            </div>
            <!-- <div class="form-group">
              <input type="text" name="email" class="form-control" placeholder="Email" required="">
            </div> -->
            <div class="form-group">
              <input type="text" name="username" class="form-control" placeholder="Username" required="">
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control" placeholder="Password" required="">
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Register</button>
            <p class="text-muted text-center">
              <small>Sudah memiliki akun?</small>
            </p>
            <a class="btn btn-sm btn-white btn-block" href="<?= base_url() ?>">Login</a>
          </form>
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

</body>

</html>