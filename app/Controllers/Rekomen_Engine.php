<?php

namespace App\Controllers;

use App\Models\Loved_MDL;
use App\Models\Vector_MDL;
use App\Controllers\Cosine_Sim;
use App\Models\Hotel_MDL;

class Rekomen_Engine extends BaseController
{
    public function __construct()
    {
        helper('url');
        $this->Loved_ = new Loved_MDL();
        $this->Vector_ = new Vector_MDL();
        $this->Hotel_ = new Hotel_MDL();
    }

    public function index()
    {
        echo ('200');
    }

    public function add_to_loved()
    {
        $alpha_num = '123456789abcdevwxyz';
        $charactersLength = strlen($alpha_num);
        $randomString = '';
        for ($i = 0; $i < 8; $i++) {
            $randomString .= $alpha_num[rand(0, $charactersLength - 1)];
        }

        $loved_id = $randomString;

        if ($this->request->getMethod() == "post") {
            $loved_htl = new Loved_MDL();

            $data = [
                "loved_id" => $loved_id,
                "id_hotel" => $this->request->getVar("hotel_id"),
                "id_user_loved" => session()->get('id_akunPengguna')
            ];

            if ($loved_htl->insert($data)) {

                $response = [
                    'success' => true,
                    'msg' => "200",
                ];
            } else {
                $response = [
                    'success' => true,
                    'msg' => "500",
                ];
            }

            return $this->response->setJSON($response);
        } else {
            echo ('500');
        }
    }

    // function get_user_loved_hotel()
    // {
    //     $dataHotels = $this->Loved_->get_lovedHotelsbyUser(session()->get('id_akunPengguna'));

    //     // dd($dataHotels);
    // }

    function makeVector()
    {

        if (session()->get('id_akunPengguna') != null) {
            

            $userId = session()->get('id_akunPengguna');

            $vecHoImpres = $this->Loved_->getVec_hotelImpression($userId);
            $vecHoRating = $this->Loved_->getVec_hotelRating($userId);
            $vecPrimFac = $this->Loved_->getVec_primFac($userId);
            $vecSecoFac = $this->Loved_->getVec_SecoFac($userId);
            $vecIdxHarga = $this->Loved_->getVec_IdxHarga($userId);
            $vecIsHtlNew = $this->Loved_->getVec_isHotelNew($userId);
            $vecIsAvRsto = $this->Loved_->getVec_availResto($userId);
            $vecAvSwPool = $this->Loved_->getVec_availSwpool($userId);
            $vecAvSwAc = $this->Loved_->getVec_availAc($userId);
            $vecAvSwGym = $this->Loved_->getVec_availGym($userId);
            $vecAvSwSpa = $this->Loved_->getVec_availSpa($userId);

            $htlRtgIndx = round($vecHoRating['hotel_rating']);
            $vector_profile_id = $this->Vector_->getVector_profile_idbyUserId($userId);
            $getVecProID_only = $vector_profile_id['vector_profile_id'];
            $VectorData = [
                "hotel_rating" => $htlRtgIndx,
                "hotel_impression" => $vecHoImpres['hotel_impression'],
                "primary_facility" => $vecPrimFac['primary_facility'],
                "secondary_facility" => $vecSecoFac['secondary_facility'],
                "indx_htl_room_price" => $vecIdxHarga['indx_htl_room_price'],
                "is_hotel_new" => $vecIsHtlNew['is_hotel_new'],
                "avail_resto" => $vecIsAvRsto['avail_resto'],
                "avail_swpool" => $vecAvSwPool['avail_swpool'],
                "avail_ac" => $vecAvSwAc['avail_ac'],
                "avail_gym" => $vecAvSwGym['avail_gym'],
                "avail_spa" => $vecAvSwSpa['avail_spa'],
            ];
            // dd($VectorData);

            $this->Vector_->update($getVecProID_only,$VectorData);
            // echo ('200');
        } else {
            echo ('500');
        }
    }

    function getVectorProfile()
    {

        if (session()->get('id_akunPengguna') != null) {
            

            $userId = session()->get('id_akunPengguna');

            $vecHoImpres = $this->Loved_->getVec_hotelImpression($userId);
            $vecHoRating = $this->Loved_->getVec_hotelRating($userId);
            $vecPrimFac = $this->Loved_->getVec_primFac($userId);
            $vecSecoFac = $this->Loved_->getVec_SecoFac($userId);
            $vecIdxHarga = $this->Loved_->getVec_IdxHarga($userId);
            $vecIsHtlNew = $this->Loved_->getVec_isHotelNew($userId);
            $vecIsAvRsto = $this->Loved_->getVec_availResto($userId);
            $vecAvSwPool = $this->Loved_->getVec_availSwpool($userId);
            $vecAvSwAc = $this->Loved_->getVec_availAc($userId);
            $vecAvSwGym = $this->Loved_->getVec_availGym($userId);
            $vecAvSwSpa = $this->Loved_->getVec_availSpa($userId);

            $htlRtgIndx = $vecHoRating['hotel_rating'];
            $vector_profile_id = $this->Vector_->getVector_profile_idbyUserId($userId);
            $getVecProID_only = $vector_profile_id['vector_profile_id'];
            $VectorData = [
                "hotel_rating" => $htlRtgIndx,
                "hotel_impression" => $vecHoImpres['hotel_impression'],
                "primary_facility" => $vecPrimFac['primary_facility'],
                "secondary_facility" => $vecSecoFac['secondary_facility'],
                "indx_htl_room_price" => $vecIdxHarga['indx_htl_room_price'],
                "is_hotel_new" => $vecIsHtlNew['is_hotel_new'],
                "avail_resto" => $vecIsAvRsto['avail_resto'],
                "avail_swpool" => $vecAvSwPool['avail_swpool'],
                "avail_ac" => $vecAvSwAc['avail_ac'],
                "avail_gym" => $vecAvSwGym['avail_gym'],
                "avail_spa" => $vecAvSwSpa['avail_spa'],
            ];
            return $VectorData;

            // $this->Vector_->update($getVecProID_only,$VectorData);
            // echo ('200');
        } else {
            echo ('500');
        }
    }

    public function buat_rekomendasi_dariLoved(){
        $userId = session()->get('id_akunPengguna');

        $vector_fromDB=$this->Vector_->getVector_profile_idbyUserId_contentHotelOnly($userId);

        //hotel_rating, hotel_impression, primary_facility, secondary_facility, indx_htl_room_price, is_hotel_new, avail_resto, avail_swpool, avail_ac, avail_gym, avail_spa

        $dataHotels = $this->Loved_->get_lovedHotelsbyUser_contentHotelOnly(session()->get('id_akunPengguna'));

        foreach ($dataHotels as $contentdataHotels){
            $data_vec = [
                'data' => [doubleval($contentdataHotels['hotel_rating']), (int) $contentdataHotels['hotel_impression'], (int) $contentdataHotels['primary_facility'], (int) $contentdataHotels['secondary_facility'], (int) $contentdataHotels['indx_htl_room_price'], (int) $contentdataHotels['is_hotel_new'], (int) $contentdataHotels['avail_resto'], (int) $contentdataHotels['avail_swpool'], (int) $contentdataHotels['avail_ac'], (int) $contentdataHotels['avail_gym'], (int) $contentdataHotels['avail_spa']],
                'vector' => [(int) $vector_fromDB['hotel_rating'], (int) $vector_fromDB['hotel_impression'], (int) $vector_fromDB['primary_facility'], (int) $vector_fromDB['secondary_facility'], (int) $vector_fromDB['indx_htl_room_price'], (int) $vector_fromDB['is_hotel_new'], (int) $vector_fromDB['avail_resto'], (int) $vector_fromDB['avail_swpool'], (int) $vector_fromDB['avail_ac'], (int) $vector_fromDB['avail_gym'], (int) $vector_fromDB['avail_spa']],
            ];

            $similaritas = Cosine_Sim::calc($data_vec['data'], $data_vec['vector']);

            $TMP_idHotel_sim[]=[
                'id_hotel'=>$contentdataHotels['id_hotel'],
                'similaritas'=>$similaritas
            ];
            array_push($TMP_idHotel_sim);
        }

        // dd($data_vec);
        
        return $TMP_idHotel_sim;
    }

    public function buat_rekomendasi_dariSemuaHotel(){
        $userId = session()->get('id_akunPengguna');

        $vector_fromDB=$this->Vector_->getVector_profile_idbyUserId_contentHotelOnly($userId);

        //hotel_rating, hotel_impression, primary_facility, secondary_facility, indx_htl_room_price, is_hotel_new, avail_resto, avail_swpool, avail_ac, avail_gym, avail_spa

        $dataHotels = $this->Hotel_->getContentHotels();

        foreach ($dataHotels as $contentdataHotels){
            $data_vec = [
                'data' => [doubleval($contentdataHotels['hotel_rating']), (int) $contentdataHotels['hotel_impression'], (int) $contentdataHotels['primary_facility'], (int) $contentdataHotels['secondary_facility'], (int) $contentdataHotels['indx_htl_room_price'], (int) $contentdataHotels['is_hotel_new'], (int) $contentdataHotels['avail_resto'], (int) $contentdataHotels['avail_swpool'], (int) $contentdataHotels['avail_ac'], (int) $contentdataHotels['avail_gym'], (int) $contentdataHotels['avail_spa']],
                'vector' => [(int) $vector_fromDB['hotel_rating'], (int) $vector_fromDB['hotel_impression'], (int) $vector_fromDB['primary_facility'], (int) $vector_fromDB['secondary_facility'], (int) $vector_fromDB['indx_htl_room_price'], (int) $vector_fromDB['is_hotel_new'], (int) $vector_fromDB['avail_resto'], (int) $vector_fromDB['avail_swpool'], (int) $vector_fromDB['avail_ac'], (int) $vector_fromDB['avail_gym'], (int) $vector_fromDB['avail_spa']],
            ];

            $similaritas = Cosine_Sim::calc($data_vec['data'], $data_vec['vector']);

            $TMP_idHotel_sim[]=[
                'id_hotel'=>$contentdataHotels['id_hotel'],
                'similaritas'=>$similaritas
            ];
            array_push($TMP_idHotel_sim);
        }
        
        return $TMP_idHotel_sim;
    }

    public function buatRekomendasiForAnUserDariLovedHotels($idUser){
        //FUNGSI INI DIRUN DARI SISI ADMIN
        $userId = $idUser;

        $vector_fromDB=$this->Vector_->getVector_profile_idbyUserId_contentHotelOnly($userId);

        //hotel_rating, hotel_impression, primary_facility, secondary_facility, indx_htl_room_price, is_hotel_new, avail_resto, avail_swpool, avail_ac, avail_gym, avail_spa

        $dataHotels = $this->Loved_->get_lovedHotelsbyUser_contentHotelOnly($idUser);

        foreach ($dataHotels as $contentdataHotels){
            $data_vec = [
                'data' => [doubleval($contentdataHotels['hotel_rating']), (int) $contentdataHotels['hotel_impression'], (int) $contentdataHotels['primary_facility'], (int) $contentdataHotels['secondary_facility'], (int) $contentdataHotels['indx_htl_room_price'], (int) $contentdataHotels['is_hotel_new'], (int) $contentdataHotels['avail_resto'], (int) $contentdataHotels['avail_swpool'], (int) $contentdataHotels['avail_ac'], (int) $contentdataHotels['avail_gym'], (int) $contentdataHotels['avail_spa']],
                'vector' => [(int) $vector_fromDB['hotel_rating'], (int) $vector_fromDB['hotel_impression'], (int) $vector_fromDB['primary_facility'], (int) $vector_fromDB['secondary_facility'], (int) $vector_fromDB['indx_htl_room_price'], (int) $vector_fromDB['is_hotel_new'], (int) $vector_fromDB['avail_resto'], (int) $vector_fromDB['avail_swpool'], (int) $vector_fromDB['avail_ac'], (int) $vector_fromDB['avail_gym'], (int) $vector_fromDB['avail_spa']],
            ];

            $similaritas = Cosine_Sim::calc($data_vec['data'], $data_vec['vector']);

            $TMP_idHotel_sim[]=[
                'id_hotel'=>$contentdataHotels['id_hotel'],
                'similaritas'=>$similaritas
            ];
            array_push($TMP_idHotel_sim);
        }

        // dd($data_vec);
        
        return $TMP_idHotel_sim;
    }
}
