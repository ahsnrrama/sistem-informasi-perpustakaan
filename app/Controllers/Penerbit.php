<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PenerbitModel;
use CodeIgniter\HTTP\ResponseInterface;

class Penerbit extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->penerbitModel = new PenerbitModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Penerbit',
            'menu' => 'masterbuku',
            'submenu' => 'penerbit',
            'penerbit' => $this->penerbitModel->orderBy('nama_penerbit', 'ASC')->paginate(7),
            'pager' => $this->penerbitModel->pager,
        ];

        return view('admin/penerbit', $data);
    }

    public function Add()
    {
        $data = [
            'nama_penerbit' => $this->request->getPost('nama_penerbit'),
        ];
        $this->penerbitModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('Penerbit');
    }

    public function Edit($id_penerbit)
    {


        $this->penerbitModel->update($id_penerbit, [
            'nama_penerbit' => $this->request->getPost('nama_penerbit'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil diedit');

        return redirect()->to('Penerbit');
    }

    public function Delete($id_penerbit)
    {
        $this->penerbitModel->delete($id_penerbit);

        session()->setFlashdata('pesan', 'Data Berhasil dihapus');

        return redirect()->to('Penerbit');
    }
}
