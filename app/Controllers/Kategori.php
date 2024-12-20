<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;
use CodeIgniter\HTTP\ResponseInterface;

class Kategori extends BaseController
{

    public function __construct()
    {
        helper('form');
        $this->kategoriModel = new KategoriModel();

    }

    public function index()
    {
        $keyword = $this->request->getPost('keyword');
        $data = [
            'judul' => 'Kategori',
            'menu' => 'masterbuku', 
            'submenu' => 'kategori', 
            'kategori' => $this->kategoriModel->orderBy('nama_kategori', 'ASC')->Searching($keyword),
            'pager' => $this->kategoriModel->pager,
            'keyword' => $keyword,
        ];
        

        return view('admin/kategori',$data);
    }

    public function Add()
    {
        $data['nama_kategori'] = $this->request->getPost('nama_kategori');

        $this->kategoriModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('Kategori');
    }

    public function Edit($id_kategori)
    {
        

        $this->kategoriModel->update($id_kategori, [
            'nama_kategori' => $this->request->getPost('nama_kategori')
        ]);

        session()->setFlashdata('pesan','Data Berhasil diedit');

        return redirect()->to('Kategori');
    }

    public function Delete($id_kategori)
    {
        $this->kategoriModel->delete($id_kategori);

        session()->setFlashdata('pesan', 'Data Berhasil dihapus');

        return redirect()->to('Kategori');
    }
}
