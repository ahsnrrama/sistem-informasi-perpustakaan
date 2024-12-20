<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\PeminjamanModel;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardAnggota extends BaseController
{
    public function __construct()
    {
        $this->anggotamodel = new AnggotaModel();
        $this->peminjamanmodel = new PeminjamanModel();
    }

    public function index()
    {
        // Ambil id anggota dari session
        $id_anggota = session()->get('id_anggota');

        // Jika tidak ada id anggota di session, redirect ke halaman login
        if (!$id_anggota) {
            return redirect()->to(base_url('auth/logAnggota'));
        }

        // Ambil data anggota berdasarkan id
        $anggota = $this->anggotamodel->getAnggotaWithKelas($id_anggota);

        if (!$anggota) {
            // Jika anggota tidak ditemukan, beri pesan error atau redirect
            return redirect()->to(base_url('auth/logAnggota'))->with('error', 'Profil tidak ditemukan');
        }
        $notifikasi = $this->peminjamanmodel->getPendingPeminjaman($id_anggota);
        $data = [
            'judul' => 'Profile Anggota',
            'menu' => 'dashboard',
            'submenu' => '',
            'anggota' => $anggota,
            'pendingPeminjaman' => $notifikasi,
        ];

        return view('anggota/index', $data);
    }
}
