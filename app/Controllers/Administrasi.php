<?php
namespace App\Controllers;

use App\Models\AkunAdmin_MDL;
use App\Models\AkunPengguna_MDL;
use App\Models\Hotel_MDL;

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

	public function edit_data_hotel($id_hotel=null)
	{
		if (session()->get('id_akunAdmin') != null) {
			$detailHotel = $this->HotelMDL_->get_hotelDetailsById($id_hotel);
			if($detailHotel==null){
				session()->setFlashdata('notif', 'toastr.error("Data hotel tidak ditemukan", "Gagal!");');
				return redirect()->to(base_url('administrasi/semua_hotel'));
			}else{
				$dataHotel = ['detailHotel'=>$detailHotel];
				// dd($dataHotel);
				return view('admin_views/screen_editDataHotel',$dataHotel);
			}

			
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

	
}
