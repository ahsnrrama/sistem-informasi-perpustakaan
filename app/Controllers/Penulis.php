<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenulisModel;
use CodeIgniter\HTTP\ResponseInterface;

class Penulis extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->penulisModel = new PenulisModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Penulis',
            'menu' => 'masterbuku',
            'submenu' => 'penulis',
            'penulis' => $this->penulisModel->orderBy('nama_penulis', 'ASC')->paginate(7),
            'pager' => $this->penulisModel->pager,
        ];

        return view('admin/penulis', $data);
    }

    public function Add()
    {
        $data = [
            'nama_penulis' => $this->request->getPost('nama_penulis'),
        ];
        $this->penulisModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('Penulis');
    }

    public function Edit($id_penulis)
    {


        $this->penulisModel->update($id_penulis, [
            'nama_penulis' => $this->request->getPost('nama_penulis'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil diedit');

        return redirect()->to('Penulis');
    }

    public function Delete($id_penulis)
    {
        $this->penulisModel->delete($id_penulis);

        session()->setFlashdata('pesan', 'Data Berhasil dihapus');

        return redirect()->to('Penulis');
    }
}
