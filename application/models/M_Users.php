<?php

class M_Users extends CI_Model
{

  function insertData($tabel, $input)
  {
    $this->db->insert($tabel, $input);
  }

  function updateData($tabel, $data, $where, $nilai)
  {
    $this->db->where($where, $nilai);
    $this->db->update($tabel, $data);
  }

  function profilAkun($id)
  {
    return $this->db->get_where('users', array('user_id' => $id));
  }

  public function getCryptocurrency()
  {
    return $this->db->get('cryptocurrency');
  }

  public function getBeli($id)
  {
    $this->db->select("id_beli, harga_beli_crypto, sisa, kode");
    $this->db->from("beli");
    $this->db->join("cryptocurrency", "beli.id_crypto = cryptocurrency.no");
    $this->db->where("beli.sisa > 0");
    $this->db->where("user_id", $id);
    return $this->db->get();
  }

  public function getDataBeli($id)
  {
    $this->db->select("*");
    $this->db->from("beli");
    $this->db->join("cryptocurrency", "beli.id_crypto = cryptocurrency.no");
    $this->db->where("beli.id_beli", $id);
    return $this->db->get();
  }
}
