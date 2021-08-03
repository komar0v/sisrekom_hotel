<?php

namespace App\Models;

use CodeIgniter\Model;

class Vector_MDL extends Model
{

    protected $table = 'user_vector_profile';
    protected $primaryKey = 'vector_profile_id';

    protected $allowedFields = [
        'vector_profile_id','user_id', 'hotel_rating', 'hotel_impression', 'primary_facility', 'secondary_facility', 'indx_htl_room_price', 'is_hotel_new',
        'avail_resto', 'avail_swpool', 'avail_ac', 'avail_gym', 'avail_spa'
    ];

    public function getVector_profile_idbyUserId($userID){
        return $this->db->table($this->table)->where('user_id',$userID)->get()->getRowArray();
    }
}
