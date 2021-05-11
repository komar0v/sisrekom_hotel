<?php

namespace App\Controllers;

use App\Models\AkunAdmin_MDL;
use App\Models\AkunPengguna_MDL;
use App\Models\Hotel_MDL;
use App\Models\Hotel_MDL_datatables;
use CodeIgniter\Config\Services;

class Administrasi extends BaseController
{

	public function __construct()
	{
		helper('form');
		helper('date');
		$this->Akun_ = new AkunAdmin_MDL(); //memanggil model "Akun_MDL" dan direpresentasi menjadi "Akun_"
		$this->AkunPengguna_ = new AkunPengguna_MDL();
		$this->HotelMDL_ = new Hotel_MDL();
	}

	public function login()
	{
		if (session()->get('id_akunAdmin') != null) {
			return redirect()->to(base_url('administrasi'));
		} else {
			return view('admin_views/screen_loginAdmin');
		}
	}

	public function index()
	{
		if (session()->get('id_akunAdmin') != null) {
			$data = [
				'jumlah_user_terdaftar' => $this->AkunPengguna_->count_users(),
				'detail_5_pengguna_baru' => $this->AkunPengguna_->admin_get5latestuser(),
				'jumlah_hotel_terdaftar' => $this->HotelMDL_->countAllResults(),
			];

			return view('admin_views/screen_homeAdmin', $data);
		} else {
			return redirect()->to(base_url('administrasi/login'));
		}
	}

	public function account_settings()
	{
		if (session()->get('id_akunAdmin') != null) {
			$cek_akun = $this->Akun_->get_detail_akun(session()->get('id_akunAdmin'));
			$data = [
				'namaAkun' => $cek_akun['nama_akun'],
				'emailAkun' => $cek_akun['email_akun']
			];
			return view('admin_views/screen_pengaturanAkunAdmin', $data);
		} else {
			return redirect()->to(base_url('administrasi/login'));
		}
	}

	public function semua_pengguna()
	{
		if (session()->get('id_akunAdmin') != null) {
			$data = [
				'semuaPengguna' => $this->AkunPengguna_->findAll(),
			];

			return view('admin_views/screen_lihatSemuaPengguna', $data);
		} else {
			return redirect()->to(base_url('administrasi/login'));
		}
	}

	public function menu_tambah_hotel()
	{
		if (session()->get('id_akunAdmin') != null) {

			return view('admin_views/screen_menuAddHotel');
		} else {
			return redirect()->to(base_url('administrasi/login'));
		}
	}

	public function add_hotel()
	{
		if (session()->get('id_akunAdmin') != null) {

			return view('admin_views/screen_addHotel');
		} else {
			return redirect()->to(base_url('administrasi/login'));
		}
	}

	public function import_hotel()
	{
		if (session()->get('id_akunAdmin') != null) {

			return view('admin_views/screen_impotDataHotel');
		} else {
			return redirect()->to(base_url('administrasi/login'));
		}
	}

	public function semua_hotel()
	{
		if (session()->get('id_akunAdmin') != null) {

			return view('admin_views/screen_lihatSemuaHotel');
		} else {
			return redirect()->to(base_url('administrasi/login'));
		}
	}

	public function edit_data_hotel()
	{
		if (session()->get('id_akunAdmin') != null) {

			return view('admin_views/screen_lihatSemuaHotel');
		} else {
			return redirect()->to(base_url('administrasi/login'));
		}
	}

	//---------------------------------------------------------------------------------------------

	//fungsi untuk logout sesi admin
	public function keluar()
	{
		session()->destroy(); //menghapus semua sesi admin yg tersimpan
		return redirect()->to(base_url('administrasi')); //mengalihkan ke fungsi index Administrasi
	}

	public function validasi_login()
	{
		$validator = $this->validate([
			'e' => [
				'rules'  => 'required'
			],
			'p' => [
				'rules'  => 'required'
			]
		]);

		$email = $this->request->getPost('e');
		$password = $this->request->getPost('p');
		$sha256pwd = hash('sha256', $password);
		$statusakun = 'admin';
		$cek_akun = $this->Akun_->cek_akun($email, $sha256pwd);

		if ($validator == TRUE) {
			if ($cek_akun != null) {
				if (($cek_akun['email_akun'] == $email) && ($cek_akun['pswd_akun'] == $sha256pwd) && ($cek_akun['level_akun'] == $statusakun)) {
					session()->set('email_akunAdmin', $email);
					session()->set('nama_akunAdmin', $cek_akun['nama_akun']);
					session()->set('id_akunAdmin', $cek_akun['id_akun']);
					session()->setFlashdata('notif', 'toastr.success("Halo,' . $cek_akun['nama_akun'] . ' ", "Selamat Datang!");');
					return redirect()->to(base_url('administrasi'));
				} else {
					session()->setFlashdata('notif', 'toastr.error("Username atau password salah", "Gagal!");');
					return redirect()->to(base_url('administrasi/login'));
				}
			} else {
				session()->setFlashdata('notif', 'toastr.error("Username atau password salah", "Gagal!");');
				return redirect()->to(base_url('administrasi/login'));
			}
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

				if ($kolom_excel['8'] == 'y') {
					$hotel_barukah = '1';
				} else {
					$hotel_barukah = '0';
				}
	
				if ($kolom_excel['9'] == 'n') {
					$adaRestokah = '1';
				} else {
					$adaRestokah = '0';
				}
	
				if ($kolom_excel['10'] == 'y') {
					$adaSwPoolkah = '1';
				} else {
					$adaSwPoolkah = '0';
				}
	
				if ($kolom_excel['11'] == 'n') {
					$adaAckah = '1';
				} else {
					$adaAckah = '0';
				}
	
				if ($kolom_excel['12'] == 'y') {
					$adaGymkah = '1';
				} else {
					$adaGymkah = '0';
				}
	
				if ($kolom_excel['13'] == 'n') {
					$adaSpakah = '1';
				} else {
					$adaSpakah = '0';
				}

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

	public function saveAccountSettings()
	{
		if (session()->get('id_akunAdmin') != null) {
			$idAkun = session()->get('id_akunAdmin');
			$emailAkun = $this->request->getPost('emailAkun');
			$namaAkun = $this->request->getPost('namaAkun');
			$cek_akun = $this->Akun_->get_detail_akun($idAkun);

			$validator = $this->validate([
				'namaAkun' => [
					'rules'  => 'required|alpha_space'
				],
			]);

			if ($validator == TRUE) {
				if ($emailAkun != $cek_akun['email_akun']) {
					$data = [
						'email_akun' => $emailAkun,
						'nama_akun' => $namaAkun,
					];
					session()->set('email_akunAdmin', $emailAkun);
					session()->set('nama_akunAdmin', $namaAkun);
					$this->Akun_->update($idAkun, $data);
					session()->setFlashdata('notif', 'toastr.success("Halo,' . $namaAkun . ' ", "Nama dan email akun berhasil diubah!");');
					return redirect()->to(base_url('administrasi'));
				} else {
					$data = [
						'nama_akun' => $namaAkun,
					];
					$this->Akun_->update($idAkun, $data);
					session()->set('nama_akunAdmin', $namaAkun);
					session()->setFlashdata('notif', 'toastr.success("Halo,' . $namaAkun . ' ", "Nama akun berhasil diubah!");');
					return redirect()->to(base_url('administrasi'));
				}
			} else {
				session()->setFlashdata('notif', 'toastr.error("Kesalahan", "Gagal!");');
				return redirect()->to(base_url('administrasi/account_settings'));
			}
		} else {
			return redirect()->to(base_url('administrasi'));
		}
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

			$detail_button = '<a href=' . base_url('administrasi/edit_data_hotel') . '/' . $list->id_hotel . ' type="button" class="btn btn-primary"><i class="m-r-10 mdi mdi-eye"></i> Lihat Detail</a>';

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
}
