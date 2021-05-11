<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunAdmin_MDL extends Model
{
    
    protected $table = 'tbl_akun_admin';
    protected $primaryKey = 'id_akun';

    protected $allowedFields = ['nama_akun','email_akun','pswd_akun'];

    public function cek_akun($email_akun,$pass_akun){
        return $this->db->table($this->table)
        ->where(array('email_akun'=>$email_akun, 'pswd_akun'=>$pass_akun))->get()->getRowArray();
    }

    public function get_detail_akun($idAkun){
        return $this->db->table($this->table)
        ->where(array('id_akun'=>$idAkun))->get()->getRowArray();
    }

    
}