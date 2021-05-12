<?php

class M_Auth extends CI_Model
{

  function insertData($tabel, $input)
  {
    $this->db->insert($tabel, $input);
  }

  function cekUser($username)
  {
    return $this->db->get_where('users', array('user_username' => $username));
  }
}
