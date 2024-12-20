<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\KelasModel;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;

class Anggota extends BaseController
{

    public function __construct()
    {
        $this->usermodel = new UsersModel();
        $this->anggotamodel = new AnggotaModel();
        $this->kelasmodel = new KelasModel();
    }

    public function index()
    {
        $keyword = $this->request->getPost('keyword');
        $dataKelas = $this->kelasmodel->findAll();
        $data = [
            'judul' => 'Anggota',
            'menu' => 'masteranggota',
            'submenu' => 'anggota',
            'anggota' => $this->anggotamodel->Searching($keyword),
            'pager' => $this->anggotamodel->pager,
            'keyword' => $keyword,
            'kelas' => $dataKelas,
        ];


        return view('admin/anggota', $data);
    }

    public function verifikasi($id_anggota)
    {
        $data = [
            'verifikasi' => 1,
        ];

        // Update kolom verifikasi di database menjadi 1
        $this->anggotamodel->update($id_anggota, $data);

        session()->setFlashdata('pesan', 'Anggota berhasil diverifikasi.');
        // Redirect kembali ke halaman yang sesuai dengan pesan sukses
        return redirect()->to('anggota');
    }

    public function store()
    {
        // Validasi input form
        if (!$this->validate([
            'nama_mahasiswa' => 'required',
            'nim' => 'required|numeric|is_unique[anggota.nim]',
            'no_hp' => 'required',
            'id_kelas' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'email' => 'required|valid_email|is_unique[anggota.email]',
            'password' => 'required',
            'foto' => [
                'rules' => 'uploaded[foto]|max_size[foto,1024]|is_image[foto]|mime_in[foto,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Pilih gambar terlebih dahulu.',
                    'max_size' => 'Ukuran gambar terlalu besar.',
                    'is_image' => 'File yang dipilih bukan gambar.',
                    'mime_in' => 'Format gambar harus JPG, JPEG, atau PNG.'
                ]
            ]
        ])) {
            // Jika input tidak valid, simpan error dalam flashdata
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('isEdit', false);
            return redirect()->to(base_url('anggota'))->withInput();
        }
        // Upload gambar
        $fileFoto = $this->request->getFile('foto');
        $namaFoto = $fileFoto->getRandomName();
        $fileFoto->move('assets/foto/', $namaFoto);

        // Simpan data
        $this->anggotamodel->save([
            'nama_mahasiswa' => $this->request->getVar('nama_mahasiswa'),
            'nim' => $this->request->getVar('nim'),
            'no_hp' => $this->request->getVar('no_hp'),
            'id_kelas' => $this->request->getVar('id_kelas'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'alamat' => $this->request->getVar('alamat'),
            'email' => $this->request->getVar('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'foto' => $namaFoto
        ]);

        $dataUser = [
            'username' => $this->request->getPost('nama_mahasiswa'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'level' => 1, // Atur level anggota
        ];
        $this->usermodel->insert($dataUser);

        return redirect()->to('/anggota')->with('pesan', 'Anggota berhasil ditambahkan.');
    }

    public function update()
    {
        // Ambil data dari request
        $id_anggota = $this->request->getPost('id_anggota');
        $data = [
            'nama_mahasiswa' => $this->request->getPost('nama_mahasiswa'),
            'nim' => $this->request->getPost('nim'),
            'no_hp' => $this->request->getPost('no_hp'),
            'id_kelas' => $this->request->getPost('id_kelas'),
            'jenis_kelamin' => $this->request->getPost('jenis_kelamin'),
            'alamat' => $this->request->getPost('alamat'),
            'email' => $this->request->getPost('email'),
            // Jika password tidak diubah, jangan sertakan di sini
            // 'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT), // jika Anda ingin memperbarui password
        ];

        // Validasi data
        if ($this->validate([
            'nama_mahasiswa' => 'required',
            'nim' => 'required|is_unique[anggota.nim,id_anggota,' . $id_anggota . ']', // Cek NIM tidak duplikat
            'no_hp' => 'required',
            'id_kelas' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'email' => 'required|valid_email|is_unique[anggota.email,id_anggota,' . $id_anggota . ']',
            // 'password' => 'permit_empty|min_length[6]', // Jika ingin memvalidasi password
        ])) {
            // Proses upload foto jika ada
            if ($this->request->getFile('foto')->isValid()) {
                $fileFoto = $this->request->getFile('foto');
                $newName = $fileFoto->getRandomName();
                $fileFoto->move('assets/foto/', $newName);
                $data['foto'] = $newName; // Menyimpan nama file baru
            }

            // Update data anggota dengan ID anggota
            $this->anggotamodel->update($id_anggota, $data);
            $dataUser = [
                'username' => $this->request->getPost('nama_mahasiswa'),
                'email' => $this->request->getPost('email'),
            ];
            $this->usermodel->update($dataUser, ['email' => $dataUser['email']]);
            session()->setFlashdata('pesan', 'Data anggota berhasil diperbarui.');
            return redirect()->to('/anggota'); // Ganti dengan URL yang sesuai
        } else {
            // Menyimpan error validasi ke dalam session
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('isEdit', true); // Menyimpan informasi bahwa ini adalah edit
            session()->setFlashdata('id_anggota', $id_anggota); // Simpan ID anggota
            return redirect()->back()->withInput(); // Kembali dengan input sebelumnya
        }
    }

    public function Delete($id_anggota)
    {
        // Cari data anggota berdasarkan ID yang ingin dihapus
        $anggota = $this->anggotamodel->find($id_anggota);

        if ($anggota) {
            // Hapus data anggota
            $this->anggotamodel->delete($id_anggota);

            // Hapus data di tabel users berdasarkan email yang sama
            if (isset($anggota['email'])) {
                $this->usermodel->where('email', $anggota['email'])->delete();
            }

            session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        } else {
            session()->setFlashdata('pesan', 'Data Anggota tidak ditemukan');
        }

        return redirect()->to('anggota');
    }


}
