<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunPengguna_MDL extends Model
{
    
    protected $table = 'tbl_akun_pengguna';
    protected $primaryKey = 'id_akun';

    protected $allowedFields = ['id_akun','nama_akun','email_akun','pswd_akun','asal_akun','level_akun','tanggal_waktu_daftar'];

    public function cek_akun($email_akun,$pass_akun){
        return $this->db->table($this->table)
        ->where(array('email_akun'=>$email_akun, 'pswd_akun'=>$pass_akun))->get()->getRowArray();
    }

    public function get_detail_akun($idAkun){
        return $this->db->table($this->table)
        ->where(array('id_akun'=>$idAkun))->get()->getRowArray();
    }

    public function count_users(){
        return $this->db->table($this->table)->countAll();
    }

    public function admin_get5latestuser(){
        return $this->db->table($this->table)->orderBy('tanggal_waktu_daftar','DESC')->get(5)->getResultArray();
    }

    public function cek_emailPengguna($email_akun){
        return $this->db->table($this->table)->where(array('email_akun'=>$email_akun))->countAllResults();
        
    }

    
}