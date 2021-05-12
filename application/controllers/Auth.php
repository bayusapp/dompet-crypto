<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Auth extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    require APPPATH . 'libraries/phpmailer/src/Exception.php';
    require APPPATH . 'libraries/phpmailer/src/PHPMailer.php';
    require APPPATH . 'libraries/phpmailer/src/SMTP.php';
  }

  public function index()
  {
    view('auth/index');
  }

  public function login()
  {
    set_rules('username', 'Username', 'required|trim');
    if (validation_run() == true) {
      $username = input('username');
      $password = input('password');
      $cek_user = $this->auth->cekUser($username)->row();
      if (password_verify($password, $cek_user->user_password)) {
        $session  = array(
          'login' => true,
          'user_id' => $cek_user->user_id
        );
        set_userdata($session);
        redirect('dashboard');
      } else {
        set_flashdata('msg', '<div class="alert alert-danger">Username/Password salah</div>');
        redirect();
      }
    } else {
      redirect();
    }
  }

  public function registrasi()
  {
    view('auth/registrasi');
  }

  public function daftar()
  {
    set_rules('nama', 'Nama', 'required|trim');
    if (validation_run() == true) {
      $nama = input('nama');
      $username = input('username');
      $password = password_hash(input('password'), PASSWORD_DEFAULT);
      $input    = array(
        'user_username' => $username,
        'user_password' => $password,
        'user_name'     => $nama
      );
      $this->auth->insertData('users', $input);
      set_flashdata('msg', '<div class="alert alert-success">Akun Anda sudah terdaftar</div>');
      redirect();
    } else {
      redirect('auth/registrasi');
    }
  }

  // private function kirimEmail($nama, $email, $username, $password)
  // {
  //   $response = false;
  //   $mail             = new PHPMailer();
  //   $mail->isSMTP();
  //   $mail->Host       = 'bayusapp.com';
  //   $mail->SMTPAuth   = true;
  //   $mail->Username   = 'dompet-crypto@bayusapp.com';
  //   $mail->Password   = 'Bayu.1996';
  //   $mail->SMTPSecure = 'ssl';
  //   $mail->Port       = 465;
  //   $mail->setFrom('dompet-crypto@bayusapp.com', 'Dompet Crypto');
  //   // $mail->addReplyTo('simlabfit@bayusapp.com', '');
  //   $mail->addAddress($email);
  //   $mail->Subject    = 'Selamat Datang di Dompet Crypto Bayu SAPP';
  //   $mail->isHTML(true);
  //   $data['nama']     = $nama;
  //   $data['username'] = $username;
  //   $data['password'] = $password;
  //   $isi = view('auth/kirim_email', $data, true);
  //   $mailContent  = $isi;
  //   $mail->Body = $mailContent;
  //   if (!$mail->send()) {
  //     echo 'Message could not be sent.<br>';
  //     echo 'Mailer Error: ' . $mail->ErrorInfo;
  //   } else {
  //     echo 'Message has been sent';
  //   }
  // }

  public function logout()
  {
    $this->session->sess_destroy();
    redirect();
  }
}
