<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\PenerbitModel;
use App\Models\PenulisModel;
use App\Models\RakModel;
use CodeIgniter\HTTP\ResponseInterface;

class Buku extends BaseController
{
    public function __construct()
    {
        $this->bukumodel = new BukuModel();
    }

    public function index()
    {
        $keyword = $this->request->getPost('keyword');
        $bukuData = $this->bukumodel->getBuku($keyword);
        $peminjaman = model('PeminjamanModel');

        foreach ($bukuData as &$buku) {
            $jumlahDipinjam = $peminjaman
            ->where('id_buku', $buku['id_buku'])
            ->where('status_pinjam', 'dipinjam')
            ->countAllResults();

            $buku['jml_dipinjam'] = $jumlahDipinjam;
            $buku['jml_tersedia'] = $buku['jumlah'] - $jumlahDipinjam;
        }


        $data = [
            'judul' => 'Buku',
            'menu' => 'masterbuku',
            'submenu' => 'buku',
            'buku' => $bukuData,
            'pager' => $this->bukumodel->pager,
            'keyword' => $keyword,
        ];

        return view('admin/buku', $data);
    }


    public function store()
    {
        // Validasi data
        $validation = $this->validate([
            'judul_buku' => 'required',
            'isbn' => 'required',
            'tahun' => 'required|numeric',
            'bahasa' => 'required',
            'jumlah' => 'required|numeric',
            'id_kategori' => 'required',
            'id_penerbit' => 'required',
            'id_penulis' => 'required',
            'id_rak' => 'required',
            'deskripsi' => 'required',
            'cover' => [
                'rules' => 'uploaded[cover]|max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/gif,image/png]',
                'errors' => [
                    'uploaded' => 'Cover buku wajib diupload.',
                    'max_size' => 'Ukuran file terlalu besar, maksimal 1MB.',
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in'  => 'Format file harus JPG, JPEG, PNG, atau GIF.',
                ]
            ],
        ]);

        if (!$validation) {
            // Jika validasi gagal, kembalikan ke form dengan pesan error
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('isEdit', false); // Menyimpan informasi bahwa ini adalah edit
            return redirect()->back()->withInput(); 
        }

        // Ambil data dari form
        $data = [
            'judul_buku' => $this->request->getPost('judul_buku'),
            'isbn' => $this->request->getPost('isbn'),
            'tahun' => $this->request->getPost('tahun'),
            'bahasa' => $this->request->getPost('bahasa'),
            'jumlah' => $this->request->getPost('jumlah'),
            'jml_tersedia' => $this->request->getPost('jumlah'),
            'jml_dipinjam' => '0',
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_penerbit' => $this->request->getPost('id_penerbit'),
            'id_penulis' => $this->request->getPost('id_penulis'),
            'deskripsi' => $this->request->getPost('deskripsi'),
            'id_rak' => $this->request->getPost('id_rak'),
        ];

        // Proses upload cover
        $fileCover = $this->request->getFile('cover');
        if ($fileCover && $fileCover->isValid() && !$fileCover->hasMoved()) {
            // Generate nama file acak menggunakan getRandomName
            $namaCover = $fileCover->getRandomName();

            // Tentukan direktori simpan dan pindahkan file
            $fileCover->move('assets/cover/', $namaCover);
            $data['cover'] = $namaCover; // Simpan nama file baru yang sudah digenerate
        }

        // Simpan data buku ke database
        $this->bukumodel->insert($data);
        $id_buku = $this->bukumodel->insertID();  // Dapatkan ID buku yang baru disimpan

        // Buat kode buku (misalnya: BK-2024-0001)
        $kode_buku = 'BK-' . $data['tahun'] . '-' . str_pad($id_buku, 4, '0', STR_PAD_LEFT);

        // Update kode_buku untuk buku yang baru disimpan
        $this->bukumodel->update($id_buku, ['kode_buku' => $kode_buku]);

        // Set flashdata dan redirect
        session()->setFlashdata('pesan', 'Data buku berhasil ditambahkan.');
        return redirect()->to('/buku'); // Redirect kembali ke halaman index
    }

    public function update()
    {

        $id_buku = $this->request->getPost('id_buku');
        
        // Validasi data
        $validation = $this->validate([
            'judul_buku' => 'required',
            'isbn' => 'required',
            'tahun' => 'required|numeric',
            'bahasa' => 'required',
            'jumlah' => 'required|numeric',
            'id_kategori' => 'required',
            'id_penerbit' => 'required',
            'id_penulis' => 'required',
            'deskripsi' => 'required',
            'id_rak' => 'required',
            'cover' => [
                'rules' => 'uploaded[cover]|max_size[cover,1024]|is_image[cover]|mime_in[cover,image/jpg,image/jpeg,image/gif,image/png]',
                'errors' => [
                    'uploaded' => 'Cover buku wajib diupload.',
                    'max_size' => 'Ukuran file terlalu besar, maksimal 1MB.',
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in'  => 'Format file harus JPG, JPEG, PNG, atau GIF.',
                ]
            ],
        ]);

        if (!$validation) {
            // Jika validasi gagal, kembalikan ke form dengan pesan error
            session()->setFlashdata('errors', $this->validator->getErrors());
            session()->setFlashdata('isEdit', true); // Menyimpan informasi bahwa ini adalah edit
            session()->setFlashdata('id_buku', $id_buku); // Simpan ID anggota
            return redirect()->back()->withInput(); // Kembali dengan input sebelumnya
        }

        $data = [
            'judul_buku' => $this->request->getPost('judul_buku'),
            'isbn' => $this->request->getPost('isbn'),
            'tahun' => $this->request->getPost('tahun'),
            'bahasa' => $this->request->getPost('bahasa'),
            'jumlah' => $this->request->getPost('jumlah'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'id_penerbit' => $this->request->getPost('id_penerbit'),
            'id_penulis' => $this->request->getPost('id_penulis'),
            'id_rak' => $this->request->getPost('id_rak'),
            'deskripsi' => $this->request->getPost('deskripsi'),
        ];

        

        if ($this->request->getFile('cover')->isValid()) {
            $fileCover = $this->request->getFile('cover');
            $newName = $fileCover->getRandomName();
            $fileCover->move('assets/cover/', $newName);
            $data['cover'] = $newName; // Menyimpan nama file baru
        }

        // Update data buku ke database
        $this->bukumodel->update($id_buku, $data);

        // Set flashdata dan redirect
        session()->setFlashdata('pesan', 'Data buku berhasil diperbarui.');
        return redirect()->to('/buku');
    }

    public function Delete($id_buku)
    {
        $this->bukumodel->delete($id_buku);

        session()->setFlashdata('pesan', 'Data Berhasil dihapus');

        return redirect()->to('buku');
    }






}
