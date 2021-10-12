<?php namespace App\Controllers;

use App\Models\AkunPengguna_MDL;
use App\Models\Hotel_MDL;
use App\Models\Vector_MDL;
use App\Models\Loved_MDL;
use App\Controllers\Rekomen_Engine;

class Pengguna extends BaseController
{
	public function __construct()
    {
		helper('form');
		helper('date');
		$this->Akun_ = new AkunPengguna_MDL();
        $this->Hotel_ = new Hotel_MDL();
		$this->Vector_ = new Vector_MDL();
		$this->Loved_ = new Loved_MDL();
		$this->RekomenEngine_ = new Rekomen_Engine();
    }

	public function login()
	{
		$data=[
			'judulHalaman'=>'Login'
		];
		if (session()->get('email_akunPengguna')!=null){
			return redirect()->to(base_url('pengguna'));
		}else{
			return view('pengguna_views/screen_loginPengguna',$data);
		}
		
		
	}

	public function index()
	{
		$userid = session()->get('id_akunPengguna');
		$RandomHotel = $this->Hotel_->get_randomHotel($userid);
		$data=[
			'judulHalaman'=>'Dashboard',
			'detailHotel'=>$RandomHotel,
		];

		if (session()->get('email_akunPengguna')!=null){
			return view('pengguna_views/screen_homePengguna',$data);
			// dd($data);
		}else{
			return redirect()->to(base_url('pengguna/login'));
		}
		
	}

	public function daftar_baru(){
		$data=[
			'judulHalaman'=>'Daftar Baru',
		];
		return view('pengguna_views/screen_daftarPenggunaBaru',$data);
	}

	public function profil_saya()
	{
		if (session()->get('email_akunPengguna')!=null){
			$cek_akun = $this->Akun_->get_detail_akun(session()->get('id_akunPengguna'));
			
			$data=[
				'judulHalaman'=>'Profil',
				'namaAkunPengguna'=>$cek_akun['nama_akun'],
				'emailAkunPengguna'=>$cek_akun['email_akun']
			];

			return view('pengguna_views/screen_detailprofilPengguna',$data);
		}else{
			return redirect()->to(base_url('pengguna/login'));
		}
		
	}

	public function detail_hotel($id_hotel){
		
		if (session()->get('email_akunPengguna')!=null){
			$detailHotel=$this->Hotel_->get_hotelDetailsById($id_hotel);
			$data=[
				'judulHalaman'=>$detailHotel['hotel_name'],
				'detailHotel'=>$detailHotel,
			];

			return view('pengguna_views/screen_detailHotel',$data);
		}else{
			return redirect()->to(base_url('pengguna/login'));
		}
	}

	public function rekomendasi_hotel()
	{
		if (session()->get('email_akunPengguna')!=null){
			// $userLovedHotel = $this->Loved_->get_lovedHotelsbyUser(session()->get('id_akunPengguna'));

			$banyaknyaUserLovedHotel = $this->Loved_->get_banyaknyaHotelLovedbyUser(session()->get('id_akunPengguna'));
			// dd($banyaknyaUserLovedHotel);
			if($banyaknyaUserLovedHotel<5){
				
				session()->setFlashdata('notif', 'toastr.info("Pilih minimal 5 hotel<br> Data saat ini : '.$banyaknyaUserLovedHotel.'", "Data belum cukup");');
				return redirect()->to(base_url('pengguna'));
			}else{
				$this->RekomenEngine_->makeVector();

				$hasilRekomendasi = $this->RekomenEngine_->buat_rekomendasi_dariLoved();

				foreach($hasilRekomendasi as $rekomen){
					$dataHotel_Rekomendasi[] = [
						'dataHotel'=>$this->Hotel_->find($rekomen['id_hotel']),
						'nilai_similar'=>$rekomen['similaritas'],
					];
					$data=[
						'judulHalaman'=>'Rekomendasi Hotel',
						'dataHotelRekom'=>$dataHotel_Rekomendasi
					];
				}
				
				// dd($data);
				return view('pengguna_views/screen_rekomendasiHotelPengguna',$data);
			}
		}else{
			return redirect()->to(base_url('pengguna/login'));
		}
	}

	public function rekomendasi_hotel_all()
	{
		if (session()->get('email_akunPengguna')!=null){
			// $userLovedHotel = $this->Loved_->get_lovedHotelsbyUser(session()->get('id_akunPengguna'));

			$banyaknyaUserLovedHotel = $this->Loved_->get_banyaknyaHotelLovedbyUser(session()->get('id_akunPengguna'));
			// dd($banyaknyaUserLovedHotel);
			if($banyaknyaUserLovedHotel<5){
				
				session()->setFlashdata('notif', 'toastr.info("Pilih minimal 5 hotel<br> Data saat ini : '.$banyaknyaUserLovedHotel.'", "Data belum cukup");');
				return redirect()->to(base_url('pengguna'));
			}else{
				$this->RekomenEngine_->makeVector();

				$hasilRekomendasi = $this->RekomenEngine_->buat_rekomendasi_dariSemuaHotel();

				foreach($hasilRekomendasi as $rekomen){
					$dataHotel_Rekomendasi[] = [
						'dataHotel'=>$this->Hotel_->find($rekomen['id_hotel']),
						'nilai_similar'=>$rekomen['similaritas'],
					];
					$data=[
						'judulHalaman'=>'Rekomendasi Hotel',
						'dataHotelRekom'=>$dataHotel_Rekomendasi
					];
				}
				
				// dd($data);
				return view('pengguna_views/screen_rekomendasiHotelPengguna',$data);
			}
		}else{
			return redirect()->to(base_url('pengguna/login'));
		}
	}
	//----------------------------------------------------------------------------------------------------------------

	public function reset_rekomendasi(){
		if (session()->get('email_akunPengguna')!=null){
			$this->Loved_->delete_loved_hotelByUser(session()->get('id_akunPengguna'));
			session()->setFlashdata('notif', 'toastr.success("Rekomendasi direset", "Berhasil");');
			return redirect()->to(base_url('pengguna'));
		}else{
			return redirect()->to(base_url('pengguna/login'));
		}
	}

	public function updatePasswordPengguna(){
		if (session()->get('email_akunPengguna') != null){
			$validator = $this->validate([
				'passwordAkunPengguna' => [
					'rules'  => 'required'
				]
			]);
			if($validator==TRUE){
				$passAkun = $this->request->getPost('passwordAkunPengguna');
				$hashed_pass = hash('sha256', $passAkun);

				$data=[
					'pswd_akun'   => $hashed_pass,
				];
				$this->Akun_->update(session()->get('id_akunPengguna'),$data);
				session()->destroy();
				session()->setFlashdata('notif', 'toastr.error("Silahkan login kembali", "Password berhasil diubah!");');
				return redirect()->to(base_url('pengguna/login'));
			}else{
				session()->setFlashdata('notif', 'toastr.error("Kesalahan", "Gagal!");');
				return redirect()->to(base_url('pengguna/profil_saya'));
			}
			
		}else{
			return redirect()->to(base_url('pengguna'));
		}
	}

	public function updateAkunPengguna(){
		if (session()->get('email_akunPengguna') != null) {
			$idAkun = session()->get('id_akunPengguna');
			$emailAkun = $this->request->getPost('emailAkunPengguna');
			$namaAkun = $this->request->getPost('namaAkunPengguna');
			$cek_akun = $this->Akun_->get_detail_akun($idAkun);

			$validator = $this->validate([
				'namaAkunPengguna' => [
					'rules'  => 'required|alpha_space'
				],
				'emailAkunPengguna' => [
					'rules'  => 'required|valid_email'
				],
			]);

			if($validator==TRUE){
				if($emailAkun!=$cek_akun['email_akun']){
					$data = [
						'email_akun'=>$emailAkun,
						'nama_akun'=>$namaAkun,
					];
					session()->set('email_akunPengguna', $emailAkun);
					session()->set('nama_akunPengguna', $namaAkun);
					$this->Akun_->update($idAkun,$data);
					session()->setFlashdata('notif', 'toastr.success("Halo,' . $namaAkun. ' ", "Nama/email akun berhasil diubah!");');
					return redirect()->to(base_url('pengguna'));
				}else{
					$data = [
						'nama_akun'=>$namaAkun,
					];
					$this->Akun_->update($idAkun,$data);
					session()->set('nama_akunAdmin', $namaAkun);
					session()->setFlashdata('notif', 'toastr.success("Halo,' . $namaAkun. ' ", "Nama akun berhasil diubah!");');
					return redirect()->to(base_url('pengguna'));
				}
				
			}else{
				session()->setFlashdata('notif', 'toastr.error("Kesalahan", "Gagal!");');
				return redirect()->to(base_url('pengguna/profil_saya'));
			}

		}else{
			return redirect()->to(base_url('pengguna'));
		}
	}

	public function keluar(){
        session()->destroy();
        return redirect()->to(base_url('pengguna'));
    }

	public function validasi_login(){
		$validator = $this->validate([
            'email' => [
            	'rules'  => 'required'
			],
			'password' => [
            	'rules'  => 'required'
            ]
        ]);

		$email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $sha256pwd = hash('sha256', $password);
        $statusakun = 'pengguna';
		$cek_akun = $this->Akun_->cek_akun($email,$sha256pwd);

		if($validator==TRUE){
			if($cek_akun!=null){
				if(($cek_akun['email_akun']==$email) && ($cek_akun['pswd_akun']==$sha256pwd) && ($cek_akun['level_akun']==$statusakun)){
					session()->set('email_akunPengguna',$email);
					session()->set('nama_akunPengguna',$cek_akun['nama_akun']);
					session()->set('id_akunPengguna',$cek_akun['id_akun']);
					session()->setFlashdata('notif','toastr.success("Halo,'.$cek_akun['nama_akun'].' ", "Selamat Datang!");');
					return redirect()->to(base_url('pengguna'));
				}else{
					session()->setFlashdata('notif','toastr.error("Email atau password salah", "Gagal!");');
					return redirect()->to(base_url('pengguna/login'));
				}
			}else{
				session()->setFlashdata('notif','toastr.error("Email atau password salah", "Gagal!");');
				return redirect()->to(base_url('pengguna/login'));
			}
		}else{
			return redirect()->to(base_url('pengguna'));
		}
	}

	public function registerPenggunaBaru(){
		$validator = $this->validate([
            'nama_pengguna' => [
            	'rules'  => 'required|alpha_space'
			],
			'email_pengguna' => [
            	'rules'  => 'required|valid_email|is_unique[tbl_akun_pengguna.email_akun]'
            ],
			'pswd_pengguna' => [
            	'rules'  => 'required'
            ],
			'kota_asal_pengguna' => [
            	'rules'  => 'required'
            ],
        ]);

		$emailAkun = $this->request->getPost('email_pengguna');
		$namaAkun = $this->request->getPost('nama_pengguna');
		$unHashed_pswdAkun = $this->request->getPost('pswd_pengguna');
		$kotaAsalPengguna = $this->request->getPost('kota_asal_pengguna');

		if($validator==TRUE){

			$rand5Number = rand(pow(10, 5-1), pow(10, 5)-1);
			$idAkun = 'USR'.$rand5Number;
			$hashed_pswdAkun = hash('sha256', $unHashed_pswdAkun);
			$dateTimeJoined = date("Y-m-d H:i:s");

			$data = [
				'id_akun'=>$idAkun,
				'nama_akun'=>$namaAkun,
				'email_akun'=>$emailAkun,
				'pswd_akun'=>$hashed_pswdAkun,
				'level_akun'=>'pengguna',
				'asal_akun'=>$kotaAsalPengguna,
				'tanggal_waktu_daftar'=> $dateTimeJoined

			];

			$alpha_num = '123890abcdwxyz';
            $charactersLength = strlen($alpha_num);
            $randomStr = '';
            for ($i = 0; $i < 8; $i++) {
                $randomStr .= $alpha_num[rand(0, $charactersLength - 1)];
            }

            $vector_profile_id = $randomStr;

			$profileVector = [
                "vector_profile_id" => $vector_profile_id,
                "user_id" => $idAkun,
                "hotel_rating" => 0,
                "hotel_impression" => 0,
                "primary_facility" => 0,
                "secondary_facility" => 0,
                "indx_htl_room_price" => 0,
                "is_hotel_new" => 0,
                "avail_resto" => 0,
                "avail_swpool" => 0,
                "avail_ac" => 0,
                "avail_gym" => 0,
                "avail_spa" => 0,
            ];
			$this->Akun_->insert($data);
			$this->Vector_->insert($profileVector);

			session()->setFlashdata('notif','toastr.success("Silahkan login", "Berhasil daftar!");');
			return redirect()->to(base_url('pengguna/login'));
		}else{
			session()->setFlashdata('notif','toastr.error("Email sudah terpakai", "Gagal!");');
			return redirect()->to(base_url('pengguna/daftar_baru'));
		}
	}

	//----------------------------------------- AJAX ------------------------------

	public function api_cekEmailTersedia() {
        $response_='invalid';
        if (isset($_POST['email_Akun'])) {
            $email_pengguna = $_POST['email_Akun'];
            $results = $this->Akun_->cek_emailPengguna($email_pengguna);
            if ($results>0) {
                $response_ = "used";
            } else {
                $response_ = "unused";
            }
        }
        echo $response_;
    }
}
