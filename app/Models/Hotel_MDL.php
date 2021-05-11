<?php

namespace App\Models;

use CodeIgniter\Model;

class Hotel_MDL extends Model
{
    
    protected $table = 'tbl_data_hotel';
    protected $primaryKey = 'id_hotel';

    protected $allowedFields = ['id_hotel','hotel_name','hotel_location',
    'hotel_rating','hotel_impression','reviewed_by_users','primary_facility',
    'secondary_facility','hotel_room_price','is_hotel_new','avail_resto','avail_swpool','avail_ac','avail_gym','avail_spa','hotel_photo_url'];

    

    
}