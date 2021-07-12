<?php

namespace App\Controllers;

use App\Models\Loved_MDL;

class Rekomen_Engine extends BaseController
{
    public function __construct()
    {
        helper('url');
        $this->Loved_ = new Loved_MDL();
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
                "loved_id"=> $loved_id,
                "id_hotel" => $this->request->getVar("hotel_id"),
                "id_user_loved" => $this->request->getVar("user_id"),
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
        }else{
            echo ('500');
        }
    }
}
