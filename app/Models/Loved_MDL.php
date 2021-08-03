<?php

namespace App\Models;

use CodeIgniter\Model;

class Loved_MDL extends Model
{
    
    protected $table = 'tbl_loved';
    protected $primaryKey = 'loved_id';

    protected $allowedFields = ['loved_id','id_user_loved','id_hotel'];

    public function get_lovedHotelsbyUser($id_user){
        //->select('loved_id,id_user_loved,id_hotel,hotel_name,hotel_rating,hotel_impression,primary_facility,secondary_facility,indx_htl_room_price,is_hotel_new,avail_resto,avail_swpool,avail_ac,avail_gym,avail_spa')
        // $query = 'SELECT * FROM `tbl_data_hotel` JOIN `tbl_loved` ON tbl_data_hotel.id_hotel=tbl_loved.id_hotel WHERE id_user_loved='id_user'';
        return $this->db->table('tbl_loved')
        ->join('tbl_data_hotel','tbl_data_hotel.id_hotel=tbl_loved.id_hotel')
        ->where('id_user_loved', $id_user)->get()->getResultArray();
    }

    public function getVec_hotelRating($id_user){
        return $this->db->table('tbl_loved')->select('hotel_rating, COUNT(*) AS sebanyak')
        ->join('tbl_data_hotel','tbl_data_hotel.id_hotel=tbl_loved.id_hotel')
        ->where('id_user_loved', $id_user)->groupBy('hotel_rating')->orderBy('sebanyak','DESC')
        ->get()->getRowArray();
    }

    public function getVec_hotelImpression($id_user){
        return $this->db->table('tbl_loved')->select('hotel_impression, COUNT(*) AS sebanyak')
        ->join('tbl_data_hotel','tbl_data_hotel.id_hotel=tbl_loved.id_hotel')
        ->where('id_user_loved', $id_user)->groupBy('hotel_impression')->orderBy('sebanyak','DESC')
        ->get()->getRowArray();
    }

    public function getVec_primFac($id_user){
        return $this->db->table('tbl_loved')->select('primary_facility, COUNT(*) AS sebanyak')
        ->join('tbl_data_hotel','tbl_data_hotel.id_hotel=tbl_loved.id_hotel')
        ->where('id_user_loved', $id_user)->groupBy('primary_facility')->orderBy('sebanyak','DESC')
        ->get()->getRowArray();
    }

    public function getVec_SecoFac($id_user){
        return $this->db->table('tbl_loved')->select('secondary_facility, COUNT(*) AS sebanyak')
        ->join('tbl_data_hotel','tbl_data_hotel.id_hotel=tbl_loved.id_hotel')
        ->where('id_user_loved', $id_user)->groupBy('secondary_facility')->orderBy('sebanyak','DESC')
        ->get()->getRowArray();
    }

    public function getVec_IdxHarga($id_user){
        return $this->db->table('tbl_loved')->select('indx_htl_room_price, COUNT(*) AS sebanyak')
        ->join('tbl_data_hotel','tbl_data_hotel.id_hotel=tbl_loved.id_hotel')
        ->where('id_user_loved', $id_user)->groupBy('indx_htl_room_price')->orderBy('sebanyak','DESC')
        ->get()->getRowArray();
    }

    public function getVec_isHotelNew($id_user){
        return $this->db->table('tbl_loved')->select('is_hotel_new, COUNT(*) AS sebanyak')
        ->join('tbl_data_hotel','tbl_data_hotel.id_hotel=tbl_loved.id_hotel')
        ->where('id_user_loved', $id_user)->groupBy('is_hotel_new')->orderBy('sebanyak','DESC')
        ->get()->getRowArray();
    }

    public function getVec_availResto($id_user){
        return $this->db->table('tbl_loved')->select('avail_resto, COUNT(*) AS sebanyak')
        ->join('tbl_data_hotel','tbl_data_hotel.id_hotel=tbl_loved.id_hotel')
        ->where('id_user_loved', $id_user)->groupBy('avail_resto')->orderBy('sebanyak','DESC')
        ->get()->getRowArray();
    }
    
    public function getVec_availSwpool($id_user){
        return $this->db->table('tbl_loved')->select('avail_swpool, COUNT(*) AS sebanyak')
        ->join('tbl_data_hotel','tbl_data_hotel.id_hotel=tbl_loved.id_hotel')
        ->where('id_user_loved', $id_user)->groupBy('avail_swpool')->orderBy('sebanyak','DESC')
        ->get()->getRowArray();
    }

    public function getVec_availAc($id_user){
        return $this->db->table('tbl_loved')->select('avail_ac, COUNT(*) AS sebanyak')
        ->join('tbl_data_hotel','tbl_data_hotel.id_hotel=tbl_loved.id_hotel')
        ->where('id_user_loved', $id_user)->groupBy('avail_ac')->orderBy('sebanyak','DESC')
        ->get()->getRowArray();
    }

    public function getVec_availGym($id_user){
        return $this->db->table('tbl_loved')->select('avail_gym, COUNT(*) AS sebanyak')
        ->join('tbl_data_hotel','tbl_data_hotel.id_hotel=tbl_loved.id_hotel')
        ->where('id_user_loved', $id_user)->groupBy('avail_gym')->orderBy('sebanyak','DESC')
        ->get()->getRowArray();
    }

    public function getVec_availSpa($id_user){
        return $this->db->table('tbl_loved')->select('avail_spa, COUNT(*) AS sebanyak')
        ->join('tbl_data_hotel','tbl_data_hotel.id_hotel=tbl_loved.id_hotel')
        ->where('id_user_loved', $id_user)->groupBy('avail_spa')->orderBy('sebanyak','DESC')
        ->get()->getRowArray();
    }

    
}