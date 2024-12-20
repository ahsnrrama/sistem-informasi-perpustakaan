<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AnggotaModel;
use App\Models\BukuModel;
use App\Models\KategoriModel;
use App\Models\PeminjamanModel;
use App\Models\RakModel;
use CodeIgniter\HTTP\ResponseInterface;

class Admin extends BaseController
{
    public function __construct()
    {
        $this->peminjamanmodel = new PeminjamanModel();
        $this->bukumodel = new BukuModel();
        $this->kategorimodel = new KategoriModel();
        $this->rakmodel = new RakModel();
        $this->anggotamodel = new AnggotaModel();
    }

    public function index()
    {
        $stokBuku = $this->bukumodel->selectSum('jumlah')->first();
        $data = [
            'judul' => 'Dashboard Admin',
            'menu' => 'Dashboard',
            'submenu' => 'Dashboard',
            'stokBuku' => $stokBuku['jumlah'],
            'Books' => $this->bukumodel->countAllResults(),
            'Members' => $this->anggotamodel->countAllResults(),
            'Loans' => $this->peminjamanmodel->countAllResults(), // Bisa pakai countAllResults() langsung
            'Racks' => $this->rakmodel->countAllResults(),
            'Categories' => $this->kategorimodel->countAllResults(),
        ];

        return view('admin/index',$data);
    }

    public function pengajuanMasuk()
    {

        $this->peminjamanmodel->updateStatusPeminjaman();
        // Cari peminjaman yang belum diverifikasi dan statusnya masih diproses
        $notifikasiPeminjaman = $this->peminjamanmodel->notifikasi();
        $data = [
            'judul' => 'Pengajuan Masuk',
            'menu' => 'peminjaman',
            'submenu' => 'pengajuanMasuk',
            'peminjaman' => $this->peminjamanmodel->pengajuanMasuk(),
            'notifikasi' => $notifikasiPeminjaman,
            
        ];

        // Mengatur flashdata dengan pemberitahuan spesifik
        if (!empty($notifikasiPeminjaman)) {
            $pesanNotifikasi = '<strong>Pemberitahuan:</strong> Ada ' . count($notifikasiPeminjaman) . ' peminjaman yang perlu diverifikasi dalam waktu kurang dari 24 jam:<br>';
            session()->setFlashdata('notifikasi', $pesanNotifikasi);
        } else {
            session()->setFlashdata('notifikasi', '<strong>Pemberitahuan:</strong> Tidak ada peminjaman yang perlu diverifikasi.');
        }


        return view('admin/pengajuanmasuk', $data);
    }

    public function TolakBuku($id_pinjam)
    {
        $this->peminjamanmodel->update($id_pinjam,
        [
            'ket' => $this->request->getPost('ket'),
            'status_pinjam' => 'ditolak',
        ]);

        session()->setFlashdata('ditolak', 'Pengajuan Peminjaman Buku Ditolak !!');

        return redirect()->to('admin/pengajuanmasuk');
    }

    public function TerimaBuku($id_pinjam)
    {
        $batasWaktuAmbil = date('Y-m-d H:i:s', strtotime('+2 days'));// Batas 2 hari untuk pengambilan

        $this->peminjamanmodel->update(
            $id_pinjam,[
                'status_pinjam' => 'diterima',
                'tgl_bts_ambil' => $batasWaktuAmbil,
            ]
        );

        session()->setFlashdata('pesan', 'Pengajuan Peminjaman Buku Diterima ');

        return redirect()->to('admin/pengajuanmasuk');
    }

    public function pengajuanDiterima()
    {
        $this->peminjamanmodel->updateStatusPeminjamanTidakDiambil();//update status
        $data = [
            'judul' => 'Pengajuan Diterima',
            'menu' => 'peminjaman',
            'submenu' => 'diterima',
            'peminjaman' => $this->peminjamanmodel->pengajuanDiterima(),

        ];


        return view('admin/pengajuanditerima', $data);
    }

    public function pinjamBuku($id_pinjam)
    {
        $this->peminjamanmodel->update(
            $id_pinjam,
            [
                'status_pinjam' => 'dipinjam',
            ]
        );

        session()->setFlashdata('pesan', 'Buku berhasil Dipinjam ');

        return redirect()->to('admin/pengajuanditerima');
    }

    public function pengajuanDitolak()
    {
        $data = [
            'judul' => 'Pengajuan Ditolak',
            'menu' => 'peminjaman',
            'submenu' => 'ditolak',
            'peminjaman' => $this->peminjamanmodel->pengajuanDitolak(),

        ];


        return view('admin/pengajuanditolak', $data);
    }

    public function pengajuanDipinjam()
    {
        $data = [
            'judul' => 'Buku Dipinjam',
            'menu' => 'peminjaman',
            'submenu' => 'dipinjam',
            'peminjaman' => $this->peminjamanmodel->pengajuanDipinjam(),

        ];


            return view('admin/pengajuandipinjam', $data);
    }

    public function KembalikanBuku($id_pinjam)
    {
        $dataPinjam = $this->peminjamanmodel->find($id_pinjam);

        // Ambil tanggal hari ini sebagai tanggal pengembalian
        $tanggalKembali = date('Y-m-d');

        // Tentukan status berdasarkan tanggal pengembalian
        $statusBaru = strtotime($tanggalKembali) > strtotime($dataPinjam['tgl_harus_kembali']) ? 'terlambat' : 'tepat';

        // Update status peminjaman dan tanggal pengembalian
        $this->peminjamanmodel->update(
            $id_pinjam,
            [
                'status_pinjam' => $statusBaru,
                'tgl_kembali' => $tanggalKembali, // Simpan tanggal pengembalian
            ]
        );

        session()->setFlashdata('pesan', 'Pengajuan Pengembalian Buku Diterima ');

        return redirect()->to('admin/pengajuandipinjam');
    }

    public function pengembalianBuku()
    {
        $data = [
            'judul' => 'Pengembalian Buku',
            'menu' => 'pengembalian',
            'submenu' => 'dikembalikan',
            'peminjaman' => $this->peminjamanmodel->pengembalianBuku(),

        ];


        return view('admin/pengembalianbuku', $data);
    }

   
    public function denda()
    {
        // Ambil data denda untuk semua peminjaman
        $peminjaman = $this->peminjamanmodel->getDenda();

        // Hitung denda untuk setiap peminjaman
        foreach ($peminjaman as &$item) {
            foreach ($item['buku'] as &$buku) {
                $denda = $this->peminjamanmodel->hitungDenda($buku['id_pinjam']);
                $buku['keterlambatan'] = $denda['keterlambatan'];
                $buku['denda'] = $denda['denda'];
            }
        }

        $data = [
            'judul' => 'Denda Buku',
            'menu' => 'pengembalian',
            'submenu' => 'denda',
            'peminjaman' => $peminjaman

        ];

        // Kirim data ke view
        return view('admin/denda', $data);
    }

}
