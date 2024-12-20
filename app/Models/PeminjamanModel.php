<?php

namespace App\Models;

use App\Controllers\Peminjaman;
use CodeIgniter\Model;

class PeminjamanModel extends Model
{
    protected $table            = 'peminjaman';
    protected $primaryKey       = 'id_pinjam';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_buku', 'id_anggota', 'no_pinjam', 'tgl_pengajuan', 'tgl_pinjam', 'lama_pinjam', 'tgl_kembali', 'tgl_harus_kembali', 'tgl_bts_ambil', 'keterlambatan', 'denda', 'status_pinjam', 'qty', 'ket'];


    // ----------------- Bagian Anggota --------------------------------


    public function getPendingPeminjaman($id_anggota)
    {
        $tanggalSekarang = date('Y-m-d H:i:s');

        return $this->db->table('peminjaman')
        ->where('status_pinjam', 'diterima')
        ->where('tgl_bts_ambil <=', date('Y-m-d H:i:s', strtotime('+2 days')))
        ->where('tgl_bts_ambil >', $tanggalSekarang)
        ->where('id_anggota', $id_anggota)
        ->get()
        ->getResultArray();
    }


    public function pengajuanBuku($id_anggota)
    {
        // Membangun query
        return $this->select('peminjaman.*, buku.*, kategori.nama_kategori, penerbit.nama_penerbit, penulis.nama_penulis, rak_buku.nama_rak, rak_buku.lantai_rak')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('rak_buku', 'rak_buku.id_rak = buku.id_rak', 'left')
            ->where('id_anggota', $id_anggota)
            ->where('status_pinjam', 'diproses')
            ->paginate(5); // Memanggil paginate di sini
    }

    public function pengajuanBukuDiterima($id_anggota)
    {
        // Membangun query
        return $this->select('peminjaman.*, buku.*, kategori.nama_kategori, penerbit.nama_penerbit, penulis.nama_penulis, rak_buku.nama_rak, rak_buku.lantai_rak')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('rak_buku', 'rak_buku.id_rak = buku.id_rak', 'left')
            ->where('id_anggota', $id_anggota)
            ->where('status_pinjam', 'diterima')
            ->paginate(5); // Memanggil paginate di sini
    }

    public function pengajuanBukuDipinjam($id_anggota)
    {
        // Membangun query
        return $this->select('peminjaman.*, buku.*, kategori.nama_kategori, penerbit.nama_penerbit, penulis.nama_penulis, rak_buku.nama_rak, rak_buku.lantai_rak')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('rak_buku', 'rak_buku.id_rak = buku.id_rak', 'left')
            ->where('id_anggota', $id_anggota)
            ->where('status_pinjam', 'dipinjam')
            ->paginate(5); // Memanggil paginate di sini
    }

    public function pengajuanBukuDitolak($id_anggota)
    {
        // Membangun query
        return $this->select('peminjaman.*, buku.*, kategori.nama_kategori, penerbit.nama_penerbit, penulis.nama_penulis, rak_buku.nama_rak, rak_buku.lantai_rak')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('rak_buku', 'rak_buku.id_rak = buku.id_rak', 'left')
            ->where('id_anggota', $id_anggota)
            ->where('status_pinjam', 'ditolak')
            ->paginate(5); // Memanggil paginate di sini
    }

    public function pengembalianBukuAnggota($id_anggota)
    {
        // Membangun query
        return $this->select('peminjaman.*, 
        buku.*, 
        kategori.nama_kategori, 
        penerbit.nama_penerbit, 
        penulis.nama_penulis, 
        rak_buku.nama_rak, 
        rak_buku.lantai_rak,
        denda.keterlambatan, 
        denda.denda,')
        ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
        ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
        ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
        ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
        ->join('rak_buku', 'rak_buku.id_rak = buku.id_rak', 'left')
        ->join('denda', 'denda.id_pinjam = peminjaman.id_pinjam', 'left')
        ->where('id_anggota', $id_anggota)
            ->whereIn('status_pinjam', ['tepat','terlambat'])
            ->paginate(5); // Memanggil paginate di sini
    }

    public function DendaAnggota($id_anggota)
    {
        // Membangun query
        return $this->select('peminjaman.*, 
        buku.*, 
        kategori.nama_kategori, 
        penerbit.nama_penerbit, 
        penulis.nama_penulis, 
        rak_buku.nama_rak, 
        rak_buku.lantai_rak,
        denda.keterlambatan, 
        denda.denda_perhari, 
        denda.denda,')
        ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
        ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
        ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
        ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
        ->join('rak_buku', 'rak_buku.id_rak = buku.id_rak', 'left')
        ->join('denda', 'denda.id_pinjam = peminjaman.id_pinjam', 'left')
        ->where('id_anggota', $id_anggota)
        ->where('status_pinjam', 'terlambat')
            ->paginate(5); // Memanggil paginate di sini
    }

    //-----------------------Bagian admin------------------- 

    public function notifikasi()
    {
        // Cari peminjaman yang belum diverifikasi dan statusnya masih diproses
        $result = $this->db->table('peminjaman')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->select('peminjaman.*, buku.judul_buku, anggota.nama_mahasiswa')
            ->where('status_pinjam', 'diproses')
            ->where('tgl_pengajuan >', date('Y-m-d H:i:s', strtotime('-24 hours')))
            ->get()->getResultArray();

        return $result ?: []; // Kembalikan array kosong jika tidak ada hasil
    }

    public function updateStatusPeminjaman()
    {
        $tanggalLimit = date('Y-m-d H:i:s', strtotime('-24 hours'));

        // Update peminjaman yang lebih dari 24 jam ke status 'ditolak'
        $this->db->table('peminjaman')
            ->where('status_pinjam', 'diproses')
            ->where('tgl_pengajuan <', $tanggalLimit)
            ->update([
                'status_pinjam' => 'ditolak',
                'ket' => 'Melewati batas waktu verifikasi, peminjaman ditolak',
            ]);
    }

    public function updateStatusPeminjamanTidakDiambil()
    {
        $tanggalSekarang = date('Y-m-d H:i:s');

        // Update peminjaman yang melewati batas waktu ambil ke status 'ditolak'
        $this->db->table('peminjaman')
            ->where('status_pinjam', 'diterima') // Hanya untuk pengajuan yang diterima
            ->where('tgl_bts_ambil <', date('Y-m-d 00:00:00', strtotime($tanggalSekarang))) // Tanggal batas waktu berakhir
            ->update([
                'status_pinjam' => 'ditolak',
                'ket' => 'Pengajuan hangus karena tidak diambil dalam batas waktu',
            ]);
    }




    public function pengajuanMasuk()
    {

        $anggotaPinjam = $this->db->table('peminjaman')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
            ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->where('status_pinjam', 'diproses')
            ->selectCount('peminjaman.id_anggota', 'qty')
            ->select('anggota.id_anggota,anggota.nim,anggota.nama_mahasiswa,anggota.foto,kelas.nama_kelas')
            ->groupBy('peminjaman.id_anggota')
            ->get()->getResultArray();

        $bukuPinjam = $this->db->table('peminjaman')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->select('peminjaman.*, buku.judul_buku, buku.cover')
            ->where('status_pinjam', 'diproses')
            ->get()->getResultArray();

        $dataPeminjaman = [];
        foreach ($anggotaPinjam as $anggota) {
            $anggota['buku'] = [];
            foreach ($bukuPinjam as $buku) {
                if ($buku['id_anggota'] == $anggota['id_anggota']) {
                    $anggota['buku'][] = $buku;
                }
            }
            $dataPeminjaman[] = $anggota;
        }
        return $dataPeminjaman;
    }

    public function pengajuanDiterima()
    {
        $anggotaPinjam = $this->db->table('peminjaman')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
            ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->where('status_pinjam', 'diterima')
            ->selectCount('peminjaman.id_anggota', 'qty')
            ->select('anggota.id_anggota,anggota.nim,anggota.nama_mahasiswa,anggota.foto,kelas.nama_kelas')
            ->groupBy('peminjaman.id_anggota')
            ->get()->getResultArray();

        $bukuPinjam = $this->db->table('peminjaman')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->select('peminjaman.*, buku.judul_buku, buku.cover')
            ->where('status_pinjam', 'diterima')
            ->get()->getResultArray();

        $dataPeminjaman = [];
        foreach ($anggotaPinjam as $anggota) {
            $anggota['buku'] = [];
            foreach ($bukuPinjam as $buku) {
                if ($buku['id_anggota'] == $anggota['id_anggota']) {
                    $anggota['buku'][] = $buku;
                }
            }
            $dataPeminjaman[] = $anggota;
        }
        return $dataPeminjaman;
    }

    public function pengajuanDitolak()
    {
        $anggotaPinjam = $this->db->table('peminjaman')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
            ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->where('status_pinjam', 'ditolak')
            ->selectCount('peminjaman.id_anggota', 'qty')
            ->select('anggota.id_anggota,anggota.nim,anggota.nama_mahasiswa,anggota.foto,kelas.nama_kelas')
            ->groupBy('peminjaman.id_anggota')
            ->get()->getResultArray();

        $bukuPinjam = $this->db->table('peminjaman')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->select('peminjaman.*, buku.judul_buku, buku.cover')
            ->where('status_pinjam', 'ditolak')
            ->get()->getResultArray();

        $dataPeminjaman = [];
        foreach ($anggotaPinjam as $anggota) {
            $anggota['buku'] = [];
            foreach ($bukuPinjam as $buku) {
                if ($buku['id_anggota'] == $anggota['id_anggota']) {
                    $anggota['buku'][] = $buku;
                }
            }
            $dataPeminjaman[] = $anggota;
        }
        return $dataPeminjaman;
    }

    public function pengajuanDipinjam()
    {
        $anggotaPinjam = $this->db->table('peminjaman')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
            ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->where('status_pinjam', 'dipinjam')
            ->selectCount('peminjaman.id_anggota', 'qty')
            ->select('anggota.id_anggota,anggota.nim,anggota.nama_mahasiswa,anggota.foto,kelas.nama_kelas')
            ->groupBy('peminjaman.id_anggota')
            ->get()->getResultArray();

        $bukuPinjam = $this->db->table('peminjaman')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('rak_buku', 'rak_buku.id_rak = buku.id_rak', 'left')
            ->select('peminjaman.*, buku.*, peminjaman.id_anggota, kategori.nama_kategori, penerbit.nama_penerbit, penulis.nama_penulis, rak_buku.nama_rak, rak_buku.lantai_rak')
            ->where('status_pinjam', 'dipinjam')
            ->get()->getResultArray();

        $dataPeminjaman = [];
        foreach ($anggotaPinjam as $anggota) {
            $anggota['buku'] = [];
            foreach ($bukuPinjam as $buku) {
                if ($buku['id_anggota'] == $anggota['id_anggota']) {
                    $anggota['buku'][] = $buku;
                }
            }
            $dataPeminjaman[] = $anggota;
        }
        return $dataPeminjaman;
    }

    public function pengembalianBuku()
    {
        $anggotaPinjam = $this->db->table('peminjaman')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
            ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->whereIn('status_pinjam', ['tepat', 'terlambat'])
            ->selectCount('peminjaman.id_anggota', 'qty')
            ->select('anggota.id_anggota,anggota.nim,anggota.nama_mahasiswa,anggota.foto,kelas.nama_kelas')
            ->groupBy('peminjaman.id_anggota')
            ->get()->getResultArray();

        $bukuPinjam = $this->db->table('peminjaman')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('rak_buku', 'rak_buku.id_rak = buku.id_rak', 'left')
            ->join('denda', 'denda.id_pinjam = peminjaman.id_pinjam', 'left')
            ->select('peminjaman.*,
        buku.*,
        peminjaman.id_anggota, 
        kategori.nama_kategori, 
        penerbit.nama_penerbit, 
        penulis.nama_penulis, 
        rak_buku.nama_rak, 
        rak_buku.lantai_rak,
        denda.keterlambatan, 
        denda.denda,
        ')
            ->whereIn('status_pinjam', ['tepat', 'terlambat'])
            ->get()->getResultArray();

        $dataPeminjaman = [];
        foreach ($anggotaPinjam as $anggota) {
            $anggota['buku'] = [];
            foreach ($bukuPinjam as $buku) {
                if ($buku['id_anggota'] == $anggota['id_anggota']) {
                    $anggota['buku'][] = $buku;
                }
            }
            $dataPeminjaman[] = $anggota;
        }
        return $dataPeminjaman;
    }

    public function getDenda()
    {
        $anggotaPinjam = $this->db->table('peminjaman')
            ->join('anggota', 'anggota.id_anggota = peminjaman.id_anggota', 'left')
            ->join('kelas', 'kelas.id_kelas = anggota.id_kelas', 'left')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->where('status_pinjam', 'terlambat')
            ->selectCount('peminjaman.id_anggota', 'qty')
            ->select('anggota.id_anggota,anggota.nim,anggota.nama_mahasiswa,anggota.foto,kelas.nama_kelas')
            ->groupBy('peminjaman.id_anggota')
            ->get()->getResultArray();

        $bukuPinjam = $this->db->table('peminjaman')
            ->join('buku', 'buku.id_buku = peminjaman.id_buku', 'left')
            ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
            ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
            ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
            ->join('rak_buku', 'rak_buku.id_rak = buku.id_rak', 'left')
            ->join('denda', 'denda.id_pinjam = peminjaman.id_pinjam', 'left')
            ->select('peminjaman.*,
            kategori.nama_kategori, 
            penerbit.nama_penerbit, 
            penulis.nama_penulis, 
            rak_buku.nama_rak, 
            rak_buku.lantai_rak,
            buku.*,
            denda.keterlambatan, 
            denda.denda,
            denda.denda_perhari,
            ')
            ->where('status_pinjam', 'terlambat')
            ->get()->getResultArray();

        $dataPeminjaman = [];
        foreach ($anggotaPinjam as $anggota) {
            $anggota['buku'] = [];
            foreach ($bukuPinjam as $buku) {
                if ($buku['id_anggota'] == $anggota['id_anggota']) {
                    $anggota['buku'][] = $buku;
                }
            }
            $dataPeminjaman[] = $anggota;
        }
        return $dataPeminjaman;
    }

    public function hitungDenda($id_pinjam)
    {

        // Cek apakah data denda sudah ada untuk id_pinjam ini
        $Denda = $this->db->table('denda')
            ->where('id_pinjam', $id_pinjam)
            ->get()
            ->getRowArray();

        if ($Denda) {
            // Jika denda sudah ada, kembalikan data yang ada
            return [
                'keterlambatan' => $Denda['keterlambatan'],
                'denda' => $Denda['denda']
            ];
        }

        // Ambil data peminjaman berdasarkan ID
        $peminjaman = $this->db->table('peminjaman')
            ->where('id_pinjam', $id_pinjam)
            ->get()
            ->getRowArray();

        if (!$peminjaman) {
            return false; // Jika peminjaman tidak ditemukan
        }

        // Ambil tanggal kembali dan jatuh tempo
        $tgl_kembali = $peminjaman['tgl_kembali'] ?: date('Y-m-d'); // Jika belum dikembalikan, gunakan tanggal hari ini
        $tgl_harus_kembali = $peminjaman['tgl_harus_kembali'];

        // Hitung jumlah hari keterlambatan
        $keterlambatan = max((strtotime($tgl_kembali) - strtotime($tgl_harus_kembali)) / (60 * 60 * 24), 0);

        // Tarif denda per hari
        $denda_per_hari = 1000; // Contoh Rp 1.000 per hari

        // Hitung total denda
        $total_denda = $keterlambatan * $denda_per_hari;

        // Simpan atau update ke tabel denda
        $this->db->table('denda')->insert([
            'id_pinjam' => $id_pinjam,
            'keterlambatan' => $keterlambatan,
            'denda_perhari' => $denda_per_hari,
            'denda' => $total_denda
        ]);

        return [
            'keterlambatan' => $keterlambatan,
            'denda' => $total_denda
        ];
    }
}
