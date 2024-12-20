<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\BukuModel;
use App\Models\PeminjamanModel;
use CodeIgniter\HTTP\ResponseInterface;

class Peminjaman extends BaseController
{

    public function __construct()
    {
        $this->anggotamodel = new AnggotaModel();
        $this->peminjamanmodel = new PeminjamanModel();
        $this->bukumodel = new BukuModel();
    }

    public function index()
    {
        //
    }

    public function pengajuan(){

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
        $peminjaman = $this->peminjamanmodel->pengajuanBuku($id_anggota);
        $listbuku = $this->bukumodel->getAllBuku();
        $pager = $this->peminjamanmodel->pager;
        $data = [
            'judul' => 'Pengajuan peminjaman buku',
            'menu' => 'peminjaman',
            'submenu' => 'pengajuan',
            'anggota' => $anggota,
            'peminjaman' => $peminjaman,
            'listbuku' => $listbuku,
            'pager' => $pager,

        ];

        return view('anggota/pengajuan', $data);
        
    }

    public function Add()
    {
        // Validasi input
        if (!$this->validate([
            'id_buku' => 'required',
            'lama_pinjam' => 'required|integer',
        ])) {
            // Ambil data dari form jika ada error
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }
        

            // Ambil data dari form
            $id_anggota = session()->get('id_anggota');
            $tgl = date('YmdHi');
            $no_pinjam = $tgl . '-' . '00' . $id_anggota;
        $lama_pinjam = $this->request->getPost('lama_pinjam');
        $tgl_pengajuan = date('Y-m-d H:i:s');
        $tgl_pinjam = $this->request->getPost('tgl_pinjam'); // Tanggal pinjam bisa diatur sesuai kebutuhan
        $tgl_harus_kembali = date('Y-m-d H:i:s', strtotime("+$lama_pinjam days", strtotime($tgl_pinjam)));

        $data = [
            'id_buku' => $this->request->getPost('id_buku'),
            'id_anggota' => session()->get('id_anggota'),
            'qty' => 1,
            'no_pinjam' => $no_pinjam,
            'tgl_pengajuan' => $tgl_pengajuan, // Tanggal pengajuan (sekarang)
            'tgl_pinjam' => $tgl_pinjam, // Tanggal pinjam
            'lama_pinjam' => $lama_pinjam,
            'tgl_harus_kembali' => $tgl_harus_kembali, // Tanggal harus kembali
            'status_pinjam' => 'diproses', // Status awal
        ];

        // Simpan data ke database
        $this->peminjamanmodel->insert($data);

        // Redirect atau kembali ke halaman yang diinginkan dengan pesan sukses
        return redirect()->to(base_url('peminjaman/pengajuan'))->with('pesan', 'Pengajuan berhasil dibuat.');
    }
    public function Delete($id_pinjam)
    {
        // Cek apakah id_peminjaman valid
        if (!$id_pinjam) {
            return redirect()->to(base_url('peminjaman/pengajuan'))->with('error', 'ID peminjaman tidak valid.');
        }

        // Hapus data peminjaman dari database
        $this->peminjamanmodel->delete($id_pinjam);

        // Redirect ke halaman peminjaman dengan pesan sukses
        return redirect()->to(base_url('peminjaman/pengajuan'))->with('pesan', 'Peminjaman berhasil dihapus.');
    }

    public function pengajuanDiterima()
    {
        $id_anggota = session()->get('id_anggota');
        // Ambil data anggota berdasarkan id
        $anggota = $this->anggotamodel->getAnggotaWithKelas($id_anggota);
        $peminjaman = $this->peminjamanmodel->pengajuanBukuDiterima($id_anggota);
        $pager = $this->peminjamanmodel->pager;
        $data = [
            'judul' => 'Pengajuan peminjaman buku Diterima',
            'menu' => 'peminjaman',
            'submenu' => 'diterima',
            'anggota' => $anggota,
            'peminjaman' => $peminjaman,
            'pager' => $pager,

        ];


        return view('anggota/pengajuanditerima', $data);
    }

    public function pengajuanDitolak()
    {
        $id_anggota = session()->get('id_anggota');
        // Ambil data anggota berdasarkan id
        $anggota = $this->anggotamodel->getAnggotaWithKelas($id_anggota);
        $peminjaman = $this->peminjamanmodel->pengajuanBukuDitolak($id_anggota);
        $pager = $this->peminjamanmodel->pager;
        $data = [
            'judul' => 'Pengajuan peminjaman buku Ditolak',
            'menu' => 'peminjaman',
            'submenu' => 'ditolak',
            'anggota' => $anggota,
            'peminjaman' => $peminjaman,
            'pager' => $pager,

        ];


        return view('anggota/pengajuanditolak', $data);
    }

    public function pengajuanDipinjam()
    {
        $id_anggota = session()->get('id_anggota');
        // Ambil data anggota berdasarkan id
        $anggota = $this->anggotamodel->getAnggotaWithKelas($id_anggota);
        $peminjaman = $this->peminjamanmodel->pengajuanBukuDipinjam($id_anggota);
        $pager = $this->peminjamanmodel->pager;
        $data = [
            'judul' => 'Buku Dipinjam',
            'menu' => 'peminjaman',
            'submenu' => 'dipinjam',
            'anggota' => $anggota,
            'peminjaman' => $peminjaman,
            'pager' => $pager,

        ];


        return view('anggota/pengajuandipinjam', $data);
    }

    public function pengembalianBuku()
    {
        $id_anggota = session()->get('id_anggota');
        // Ambil data anggota berdasarkan id
        $anggota = $this->anggotamodel->getAnggotaWithKelas($id_anggota);
        $peminjaman = $this->peminjamanmodel->pengembalianBukuAnggota($id_anggota);
        $pager = $this->peminjamanmodel->pager;
        $data = [
            'judul' => 'Pengembalian Buku',
            'menu' => 'pengembalian',
            'submenu' => 'dikembalikan',
            'anggota' => $anggota,
            'peminjaman' => $peminjaman,
            'pager' => $pager,

        ];


        return view('anggota/pengembalianbuku', $data);
    }

    public function denda()
    {
        $id_anggota = session()->get('id_anggota');
        // Ambil data anggota berdasarkan id
        $anggota = $this->anggotamodel->getAnggotaWithKelas($id_anggota);
        $peminjaman = $this->peminjamanmodel->DendaAnggota($id_anggota);
        $pager = $this->peminjamanmodel->pager;
        $data = [
            'judul' => 'Denda Peminjaman',
            'menu' => 'pengembalian',
            'submenu' => 'denda',
            'anggota' => $anggota,
            'peminjaman' => $peminjaman,
            'pager' => $pager,

        ];


        return view('anggota/denda', $data);
    }
    


}
