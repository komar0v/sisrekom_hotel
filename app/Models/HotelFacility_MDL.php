<?php

namespace App\Models;

use CodeIgniter\Model;

class HotelFacility_MDL extends Model
{
    
    protected $table = 'tbl_fasilitas_hotel';
    protected $primaryKey = 'id_hotel';

    protected $allowedFields = ['id_hotel','avail_spa','avail_ac','avail_swpool','avail_resto','avail_gym'];

    
}