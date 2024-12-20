<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KelasModel;
use CodeIgniter\HTTP\ResponseInterface;

class Kelas extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->KelasModel = new KelasModel();
    }

    public function index()
    {
        $data = [
            'judul' => 'Kelas',
            'menu' => 'masteranggota',
            'submenu' => 'kelas',
            'kelas' => $this->KelasModel->orderBy('nama_kelas', 'ASC')->paginate(7),
            'pager' => $this->KelasModel->pager,
        ];

        return view('admin/kelas',$data);
    }

    public function Add()
    {
        $data = [
            'nama_kelas' => $this->request->getPost('nama_kelas'),
        ];
        $this->KelasModel->insert($data);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('kelas');
    }

    public function Edit($id_kelas)
    {


        $this->KelasModel->update($id_kelas, [
            'nama_kelas' => $this->request->getPost('nama_kelas'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil diedit');

        return redirect()->to('kelas');
    }

    public function Delete($id_kelas)
    {
        $this->KelasModel->delete($id_kelas);

        session()->setFlashdata('pesan', 'Data Berhasil dihapus');

        return redirect()->to('kelas');
    }

}
