<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\KelasModel;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->userModel = new UsersModel();
        $this->anggotamodel = new AnggotaModel();
        $this->kelasmodel = new KelasModel();
    }

    public function index()
    {
        $data['judul'] = 'Login';

        return view('auth/login',$data);
    }
    public function logUser()
    {
        $data['judul'] = 'Login User';

        return view('auth/login_user',$data);
    }

    public function cekLoginUser()
    {
        if ($this->validate([
            'emailOrUsername' => [
                'label' => 'Email atau Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong!'
                  ]
                ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                  ]
                ],
        ])) { 
            // jika input valid
            // mengambil input dari ketikan pengguna
            $emailOrUsername = $this->request->getPost('emailOrUsername');
            $password = $this->request->getPost('password');

            // cek login || memanggil metode LoginUser dari model UserModel
            $cek_login = $this->userModel->LoginUser($emailOrUsername,$password);

            if ($cek_login['pesan'] == 'success') {
                $user = $cek_login['user'];
                // set session data
                session()->set([
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'level' => ($user['level'] == 0) ? 'admin' : 'anggota',
                ]);
                return redirect()->to(base_url('Admin'));
            } else if ($cek_login['pesan'] == 'invalid_password') {
                // password salah
                session()->setFlashdata('pesan', 'Password Salah !');
                return redirect()->to(base_url('Auth/logUser'))->withInput();
            } elseif ($cek_login['pesan'] == 'user_not_found') {
                // jika email atau username salah
                session()->setFlashdata('pesan','Email atau Username tidak ditemukan');
                return redirect()->to(base_url('Auth/logUser'))->withInput();
            }
        } else {
            // jika input tidak valid
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url('Auth/logUser'))->withInput();
        }
    }

    public function logAnggota()
    {
        $data['judul'] = 'Login Anggota';

        return view('auth/login_anggota',$data);
    }

    public function logout()
    {
        // Hapus semua data sesi
        session()->destroy();
        // Arahkan ke halaman login
        return redirect()->to(base_url('/'));
    }

    public function register()
    {
        $data = [
            'judul' => 'Register Anggota',
            'kelas' => $this->kelasmodel->findAll(),
        ];

        return view('auth/register',$data);
    }

    public function daftar()
    {
        if ($this->validate([
            'id_kelas' => [
                'label' => 'Kelas',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Belum dipilih !',
                    ]
                ],
            'nim' => [
                'label' => 'Nim',
                'rules' => 'required|is_unique[anggota.nim]',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                    'is_unique' => '{field} Sudah Terdaftar !'
                ]
            ],
            'nama_mahasiswa' => [
                'label' => 'Nama Mahasiswa',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[anggota.email]',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                    'valid_email' => 'Format {field} tidak valid!',
                    'is_unique' => '{field} Sudah Terdaftar !'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                    'min_length' => '{field} minimal 6 karakter!',
                ]
            ],
            'ulangi_password' => [
                'label' => 'Ulangi Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} harus diisi!',
                    'matches' => 'Password tidak cocok!',
                ]
            ],
        ])) {

            $dataanggota = [
                'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa'),
                'nim' => $this->request->getPost('nim'),
                'id_kelas' => $this->request->getPost('id_kelas'), // Asumsi 'kelas' adalah id_kelas
                'jenis_kelamin' => $this->request->getPost('jenis_kelamin'), // Jika ada di form
                'no_hp' => $this->request->getPost('no_hp'), // Jika ada di form
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ];

            $dataUser = [
                'username' => $this->request->getPost('nama_mahasiswa'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'level' => 1, // Atur level anggota
            ];

            $this->anggotamodel->insert($dataanggota);
            $this->userModel->insert($dataUser);

            // Set flashdata dan redirect
            session()->setFlashdata('pesan', 'Registrasi berhasil, silakan login.');
            return redirect()->to('Auth/register')->withInput(); // Redirect kembali ke halaman index

        } else {
            // jika input tidak valid
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url('Auth/register'))->withInput();
        }
    }

    public function CekLogAnggota()
    {
        if ($this->validate([
            'nim' => [
                'label' => 'Nim',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong!'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Masih Kosong !',
                ]
            ],
        ])) {
            // jika input valid
            // mengambil input dari ketikan pengguna
            $nim = $this->request->getPost('nim');
            $password = $this->request->getPost('password');

            // cek login || memanggil metode LoginAnggota dari model Anggota
            $cek_login = $this->anggotamodel->LoginAnggota($nim, $password);

            if ($cek_login['pesan'] == 'success') {
                $user = $cek_login['user'];
                // set session data
                session()->set([
                    'id_anggota' => $user['id_anggota'],
                    'nama_mahasiswa' => $user['nama_mahasiswa'],
                    'nim' => $user['nim'],
                    'level' => ($user['level'] == 1) ? 'anggota' : 'admin',
                ]);
                return redirect()->to(base_url('DashboardAnggota'));
            } else if ($cek_login['pesan'] == 'invalid_password') {
                // password salah
                session()->setFlashdata('pesan', 'Password Salah !');
                return redirect()->to(base_url('Auth/logAnggota'))->withInput();
            } elseif ($cek_login['pesan'] == 'user_not_found') {
                // jika email atau username salah
                session()->setFlashdata('pesan', 'Nim tidak ditemukan');
                return redirect()->to(base_url('Auth/logAnggota'))->withInput();
            }
        } else {
            // jika input tidak valid
            session()->setFlashdata('errors', $this->validator->getErrors());
            return redirect()->to(base_url('Auth/logAnggota'))->withInput();
        }
    }

    public function logoutAnggota()
    {
        // Hapus semua data sesi
        session()->destroy();
        // Arahkan ke halaman login
        return redirect()->to(base_url('/'));
    }
}
