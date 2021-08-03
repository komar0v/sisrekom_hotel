<?php

namespace App\Controllers;

use App\Models\Loved_MDL;
use App\Models\Vector_MDL;

class Rekomen_Engine extends BaseController
{
    public function __construct()
    {
        helper('url');
        $this->Loved_ = new Loved_MDL();
        $this->Vector_ = new Vector_MDL();
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

    function get_user_loved_hotel()
    {
        $lovedHotels = $this->Loved_->get_lovedHotelsbyUser(session()->get('id_akunPengguna'));

        dd($lovedHotels);
    }

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

            $this->Vector_->update($getVecProID_only,$VectorData);
            echo ('200');
        } else {
            echo ('500');
        }
    }
}
