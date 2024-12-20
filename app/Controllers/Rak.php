<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RakModel;
use CodeIgniter\HTTP\ResponseInterface;

class Rak extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->rakModel = new RakModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Rak',
            'menu' => 'masterbuku',
            'submenu' => 'rak',
            'rak' => $this->rakModel->orderBy('nama_rak', 'ASC')->paginate(7),
            'pager' => $this->rakModel->pager,
        ];

        return view('admin/rak',$data);
    }

    public function Add()
    {
        $data = [
            'nama_rak' => $this->request->getPost('nama_rak'),
            'lantai_rak' => $this->request->getPost('lantai_rak')
        ];
        $this->rakModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('Rak');
    }

    public function Edit($id_rak)
    {


        $this->rakModel->update($id_rak, [
            'nama_rak' => $this->request->getPost('nama_rak'),
            'lantai_rak' => $this->request->getPost('lantai_rak')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil diedit');

        return redirect()->to('Rak');
    }

    public function Delete($id_rak)
    {
        $this->rakModel->delete($id_rak);

        session()->setFlashdata('pesan', 'Data Berhasil dihapus');

        return redirect()->to('Rak');
    }

}
