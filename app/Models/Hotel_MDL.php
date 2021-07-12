<?php

namespace App\Models;

use CodeIgniter\Model;

class Hotel_MDL extends Model
{
    
    protected $table = 'tbl_data_hotel';
    protected $primaryKey = 'id_hotel';

    protected $allowedFields = ['id_hotel','hotel_name','hotel_location',
    'hotel_rating','hotel_impression','reviewed_by_users','primary_facility',
    'secondary_facility','hotel_room_price','indx_htl_room_price','is_hotel_new','avail_resto','avail_swpool','avail_ac','avail_gym','avail_spa','hotel_photo_url'];

    public function get_hotelDetailsById($id_hotel){
        if($id_hotel === false){
            return $this->table($this->table)->get()->getResultArray();
        } else {
            return $this->table($this->table)->where('id_hotel', $id_hotel)->get()->getRowArray();
        }
    }

    public function get_randomHotel($id_user){
        $wherenotin = 'id_hotel NOT IN (SELECT id_hotel FROM tbl_loved WHERE id_user_loved=\''.$id_user.'\')';
        return $this->db->table($this->table)->where($wherenotin)->orderBy('hotel_name','RANDOM')->get(1)->getResultArray();
        //SELECT * FROM `tbl_data_hotel` WHERE id_hotel NOT IN (SELECT id_hotel FROM tbl_loved WHERE id_user_loved='userid') ORDER BY RAND() LIMIT 1
    }

    //KUERI UNTUK AMBIL HOTEL APA AJA YANG DILOVE
    //SELECT * FROM `tbl_data_hotel` a INNER JOIN `tbl_loved` b ON b.id_hotel=a.id_hotel WHERE id_user_loved='userid'

    
}