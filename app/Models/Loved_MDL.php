<?php

namespace App\Models;

use CodeIgniter\Model;

class Loved_MDL extends Model
{
    
    protected $table = 'tbl_loved';
    protected $primaryKey = 'loved_id';

    protected $allowedFields = ['loved_id','id_user_loved','id_hotel'];

    
}