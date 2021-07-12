<?php

namespace App\Controllers;

use App\Models\Hotel_MDL_datatables;
use CodeIgniter\Config\Services;
use App\Models\Hotel_MDL;

class Hotel extends BaseController
{
    public function __construct()
	{
		$this->HotelMDL_ = new Hotel_MDL();
	}

	//===================================================================================================================================
	public function api_getNamaAlamatHotel()
	{
		$request = Services::request();
		$datamodel = new Hotel_MDL_datatables($request);
		$lists = $datamodel->get_datatables();
		$data = [];
		$no = $request->getPost("start");
		foreach ($lists as $list) {
			$no++;
			$row = [];

			$detail_button = '<a href=' . base_url('administrasi/edit_data_hotel') . '/' . $list->id_hotel . ' type="button" class="btn btn-primary"><i class="fas fa-pencil-alt"></i> Edit Data</a>';

			$row[] = $no;
			$row[] = $list->hotel_name;
			$row[] = $list->hotel_location;
			$row[] = $detail_button;
			$data[] = $row;
		}
		$output = [
			"draw" => $request->getPost('draw'),
			"recordsTotal" => $datamodel->count_all(),
			"recordsFiltered" => $datamodel->count_filtered(),
			"data" => $data
		];
		echo json_encode($output);
	}

    public function storeHotelDatas_fromFile()
	{
		if (session()->get('id_akunAdmin') != null) {

			$dataValidator = $this->validate([
				'file_import' => [
					'rules'  => 'required'
				],
			]);

			$file = $this->request->getFile('file_import');
			$extension = $file->getClientExtension();

			if ($extension == 'xls') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}

			$spreadsheet = $reader->load($file);
			$sheet = $spreadsheet->getActiveSheet()->toArray();

			//---------------------------------------------------------------

			$htl_impression = '';
			$htl_primaryFclty='';
			$htl_secondaryFclty='';
			$hotel_barukah = '';
			$adaRestokah = '';
			$adaSwPoolkah = '';
			$adaAckah = '';
			$adaGymkah = '';
			$adaSpakah = '';

			foreach ($sheet as $rows => $kolom_excel) {
				if ($rows == 0) {
					continue;
				}

				$alpha_num = '0123456789abcdefghijklmnopqrstuvwxyz';
				$charactersLength = strlen($alpha_num);
				$randomString = '';
				for ($i = 0; $i < 10; $i++) {
					$randomString .= $alpha_num[rand(0, $charactersLength - 1)];
				}

				$hotel_id = $randomString;

				//---------KOLOM HOTEL IMPRESSION
				if(strcasecmp($kolom_excel['3'],'terrible')==0){
					$htl_impression='1';
				}

				if(strcasecmp($kolom_excel['3'],'bad')==0){
					$htl_impression='2';
				}

				if(strcasecmp($kolom_excel['3'],'okay')==0){
					$htl_impression='3';
				}

				if(strcasecmp($kolom_excel['3'],'good')==0){
					$htl_impression='4';
				}

				if(strcasecmp($kolom_excel['3'],'fantastic')==0){
					$htl_impression='5';
				}
				//---------end KOLOM HOTEL IMPRESSION

				if(strcasecmp($kolom_excel['5'],'tiket CLEAN')==0){
					$htl_primaryFclty='1';
				}

				//---------KOLOM SECONDARY FACILITY
				if(strcasecmp($kolom_excel['6'],'Pembatalan Gratis')==0){
					$htl_secondaryFclty='1';
				}
				if(strcasecmp($kolom_excel['6'],'Wifi Gratis')==0){
					$htl_secondaryFclty='2';
				}
				if(strcasecmp($kolom_excel['6'],'Sarapan Gratis')==0){
					$htl_secondaryFclty='3';
				}
				//---------end KOLOM SECONDARY FACILITY

				//---------KOLOM HARGA
				$index_harga_kamar=0;
				$hrg_hotelRoom = str_replace(".", "", $kolom_excel['7']);
			

				if ((100000 <= $hrg_hotelRoom) && ($hrg_hotelRoom <= 200000)) {
					$index_harga_kamar=1;
				}
				else if ((200001 <= $hrg_hotelRoom) && ($hrg_hotelRoom <= 300000)) {
					$index_harga_kamar=2;
				}
				else if ((300001 <= $hrg_hotelRoom) && ($hrg_hotelRoom <= 400000)) {
					$index_harga_kamar=3;
				}
				else if ((400001 <= $hrg_hotelRoom) && ($hrg_hotelRoom <= 500000)) {
					$index_harga_kamar=4;
				}
				else if ((500001 <= $hrg_hotelRoom) && ($hrg_hotelRoom <= 600000)) {
					$index_harga_kamar=5;
				}
				else if ((600001 <= $hrg_hotelRoom) && ($hrg_hotelRoom <= 700000)) {
					$index_harga_kamar=6;
				}
				else if ((700001 <= $hrg_hotelRoom) && ($hrg_hotelRoom <= 800000)) {
					$index_harga_kamar=7;
				}
				else if ((800001 <= $hrg_hotelRoom) && ($hrg_hotelRoom <= 900000)) {
					$index_harga_kamar=8;
				}
				else if ((900001 <= $hrg_hotelRoom) && ($hrg_hotelRoom <= 1000000)) {
					$index_harga_kamar=9;
				}
				else if ($hrg_hotelRoom>1000000) {
					$index_harga_kamar=10;
				}


				//---------end KOLOM HARGA

				//---------KOLOM FASILITAS
				if ($kolom_excel['8'] == 'y') {
					$hotel_barukah = '1';
				} else {
					$hotel_barukah = '0';
				}
	
				if ($kolom_excel['9'] == 'y') {
					$adaRestokah = '1';
				} else {
					$adaRestokah = '0';
				}
	
				if ($kolom_excel['10'] == 'y') {
					$adaSwPoolkah = '1';
				} else {
					$adaSwPoolkah = '0';
				}
	
				if ($kolom_excel['11'] == 'y') {
					$adaAckah = '1';
				} else {
					$adaAckah = '0';
				}
	
				if ($kolom_excel['12'] == 'y') {
					$adaGymkah = '1';
				} else {
					$adaGymkah = '0';
				}
	
				if ($kolom_excel['13'] == 'y') {
					$adaSpakah = '1';
				} else {
					$adaSpakah = '0';
				}
				//---------end KOLOM FASILITAS

				$hotel_datas = [
					'id_hotel' => $hotel_id,
					'hotel_name' => $kolom_excel['0'],
					'hotel_location' => $kolom_excel['1'],
					'hotel_rating' => $kolom_excel['2'],
					'hotel_impression' => $htl_impression,
					'reviewed_by_users' => $kolom_excel['4'],
					'primary_facility' => $htl_primaryFclty,
					'secondary_facility' => $htl_secondaryFclty,
					'hotel_room_price' => $kolom_excel['7'],
					'indx_htl_room_price'=>$index_harga_kamar,
					'is_hotel_new' => $hotel_barukah,
					'avail_resto' => $adaRestokah,
					'avail_swpool' => $adaSwPoolkah,
					'avail_ac' => $adaAckah,
					'avail_gym' => $adaGymkah,
					'avail_spa' => $adaSpakah,
					'hotel_photo_url' => $kolom_excel['14'],
				];
				$this->HotelMDL_->insert($hotel_datas);
			}

			session()->setFlashdata('notif', 'toastr.success("'.$rows.' data Hotel berhasil diimport!", "Berhasil!");');
			return redirect()->to(base_url('administrasi/semua_hotel'));
			
		} else {
			return redirect()->to(base_url('administrasi'));
		}
	}

    public function storeHotelDatas()
	{
		if (session()->get('id_akunAdmin') != null) {

			$dataValidator = $this->validate([
				'hotel_name' => [
					'rules'  => 'required'
				],
				'hotel_location' => [
					'rules'  => 'required'
				],
				'hotel_rating' => [
					'rules'  => 'required'
				],
				'hotel_impression' => [
					'rules'  => 'required'
				],
				'reviewed_by_users' => [
					'rules'  => 'required'
				],
				'primary_facility' => [
					'rules'  => 'required'
				],
				'secondary_facility' => [
					'rules'  => 'required'
				],
				'hotel_room_price' => [
					'rules'  => 'required'
				],
				'hotel_photo_url' => [
					'rules'  => 'required'
				],
			]);

			$alpha_num = '0123456789abcdefghijklmnopqrstuvwxyz';
			$charactersLength = strlen($alpha_num);
			$randomString = '';
			for ($i = 0; $i < 10; $i++) {
				$randomString .= $alpha_num[rand(0, $charactersLength - 1)];
			}

			$hotel_id = $randomString;
			$hotel_barukah = '';
			$adaRestokah = '';
			$adaSwPoolkah = '';
			$adaAckah = '';
			$adaGymkah = '';
			$adaSpakah = '';

			if ($this->request->getPost('isHotelNew') == 'baru') {
				$hotel_barukah = '1';
			} else {
				$hotel_barukah = '0';
			}

			if ($this->request->getPost('avail_resto') == 'ada') {
				$adaRestokah = '1';
			} else {
				$adaRestokah = '0';
			}

			if ($this->request->getPost('avail_swpool') == 'ada') {
				$adaSwPoolkah = '1';
			} else {
				$adaSwPoolkah = '0';
			}

			if ($this->request->getPost('avail_ac') == 'ada') {
				$adaAckah = '1';
			} else {
				$adaAckah = '0';
			}

			if ($this->request->getPost('avail_gym') == 'ada') {
				$adaGymkah = '1';
			} else {
				$adaGymkah = '0';
			}

			if ($this->request->getPost('avail_spa') == 'ada') {
				$adaSpakah = '1';
			} else {
				$adaSpakah = '0';
			}


			$hotel_datas = [
				'id_hotel' => $hotel_id,
				'hotel_name' => $this->request->getPost('hotel_name'),
				'hotel_location' => $this->request->getPost('hotel_location'),
				'hotel_rating' => $this->request->getPost('hotel_rating'),
				'hotel_impression' => $this->request->getPost('hotel_impression'),
				'reviewed_by_users' => $this->request->getPost('reviewed_by_users'),
				'primary_facility' => $this->request->getPost('primary_facility'),
				'secondary_facility' => $this->request->getPost('secondary_facility'),
				'hotel_room_price' => $this->request->getPost('hotel_room_price'),
				'is_hotel_new' => $hotel_barukah,
				'avail_resto' => $adaRestokah,
				'avail_swpool' => $adaSwPoolkah,
				'avail_ac' => $adaAckah,
				'avail_gym' => $adaGymkah,
				'avail_spa' => $adaSpakah,
				'hotel_photo_url' => $this->request->getPost('hotel_photo_url'),
			];

			if ($dataValidator == TRUE) {
				// dd($hotel_datas);
				$this->HotelMDL_->insert($hotel_datas);
				session()->setFlashdata('notif', 'toastr.success("Data Hotel ' . $this->request->getPost('hotel_name') . ' berhasil disimpan", "Berhasil!");');
				return redirect()->to(base_url('administrasi/semua_hotel'));
			} else {
				session()->setFlashdata('notif', 'toastr.error("Periksa kembali kolom isian", "Gagal!");');

				return redirect()->to(base_url('administrasi/add_hotel'));
			}
		} else {
			return redirect()->to(base_url('administrasi'));
		}
	}

	public function storeEditedHotelDatas()
	{
		if (session()->get('id_akunAdmin') != null) {

			$dataValidator = $this->validate([
				'hotel_name' => [
					'rules'  => 'required'
				],
				'hotel_location' => [
					'rules'  => 'required'
				],
				'hotel_rating' => [
					'rules'  => 'required'
				],
				'hotel_impression' => [
					'rules'  => 'required'
				],
				'reviewed_by_users' => [
					'rules'  => 'required'
				],
				'primary_facility' => [
					'rules'  => 'required'
				],
				'secondary_facility' => [
					'rules'  => 'required'
				],
				'hotel_room_price' => [
					'rules'  => 'required'
				],
				'hotel_photo_url' => [
					'rules'  => 'required'
				],
			]);

			if ($this->request->getPost('isHotelNew') == 'baru') {
				$hotel_barukah = '1';
			} else {
				$hotel_barukah = '0';
			}

			if ($this->request->getPost('avail_resto') == 'ada') {
				$adaRestokah = '1';
			} else {
				$adaRestokah = '0';
			}

			if ($this->request->getPost('avail_swpool') == 'ada') {
				$adaSwPoolkah = '1';
			} else {
				$adaSwPoolkah = '0';
			}

			if ($this->request->getPost('avail_ac') == 'ada') {
				$adaAckah = '1';
			} else {
				$adaAckah = '0';
			}

			if ($this->request->getPost('avail_gym') == 'ada') {
				$adaGymkah = '1';
			} else {
				$adaGymkah = '0';
			}

			if ($this->request->getPost('avail_spa') == 'ada') {
				$adaSpakah = '1';
			} else {
				$adaSpakah = '0';
			}

			$id_hotel = $this->request->getPost('hotel_id');

			$hotel_datas = [
				'hotel_name' => $this->request->getPost('hotel_name'),
				'hotel_location' => $this->request->getPost('hotel_location'),
				'hotel_rating' => $this->request->getPost('hotel_rating'),
				'hotel_impression' => $this->request->getPost('hotel_impression'),
				'reviewed_by_users' => $this->request->getPost('reviewed_by_users'),
				'primary_facility' => $this->request->getPost('primary_facility'),
				'secondary_facility' => $this->request->getPost('secondary_facility'),
				'hotel_room_price' => $this->request->getPost('hotel_room_price'),
				'is_hotel_new' => $hotel_barukah,
				'avail_resto' => $adaRestokah,
				'avail_swpool' => $adaSwPoolkah,
				'avail_ac' => $adaAckah,
				'avail_gym' => $adaGymkah,
				'avail_spa' => $adaSpakah,
				'hotel_photo_url' => $this->request->getPost('hotel_photo_url'),
			];

			if ($dataValidator == TRUE) {
				// dd($hotel_datas);
				$this->HotelMDL_->update($id_hotel,$hotel_datas);
				session()->setFlashdata('notif', 'toastr.success("Data Hotel ' . $this->request->getPost('hotel_name') . ' berhasil disimpan", "Berhasil!");');
				return redirect()->to(base_url('administrasi/semua_hotel'));
			} else {
				session()->setFlashdata('notif', 'toastr.error("Periksa kembali kolom isian", "Gagal!");');

				return redirect()->to(base_url('administrasi/edit_data_hotel/'.$id_hotel));
			}
		} else {
			return redirect()->to(base_url('administrasi'));
		}
	}

	public function deleteHotelDatas(){
		if (session()->get('id_akunAdmin') != null) {
			$id_hotel = $this->request->getPost('hotelid');

			if($id_hotel!=null){
				$this->HotelMDL_->delete($id_hotel);
				session()->setFlashdata('notif', 'toastr.success("Hotel sudah dihapus", "Berhasil!");');
				return redirect()->to(base_url('administrasi/semua_hotel'));
			}else{
				session()->setFlashdata('notif', 'toastr.error("UNDEFINED", "Gagal!");');

				return redirect()->to(base_url('administrasi/semua_hotel'));
			}
		} else {
			return redirect()->to(base_url('administrasi'));
		}
	}

}
