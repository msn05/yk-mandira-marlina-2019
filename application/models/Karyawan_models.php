<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Karyawan_models extends CI_Model
{

	function Data()
	{
		$this->db->select('a.status_users,a.id_akses,a.id_level,a.login,a.logout,a.password,b.nama_level,b.id_level,c.id_akses as Nomor,c.nomor_wa,c.nomor_telephone,c.nama_lengkap,c.status_akun_pengguna');
		$this->db->from('db_akses a');
		$this->db->join('db_level b','b.id_level = a.id_level');
		$this->db->join('db_data_akses c','c.id_akses = a.id_akses','left');
		$this->db->where('c.status_akun_pengguna',1);
		$query = $this->db->get();
		return $query;	
	}
}