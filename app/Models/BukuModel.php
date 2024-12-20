<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table            = 'buku';
    protected $primaryKey       = 'id_buku';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_buku','id_kategori','id_penerbit','id_penulis','id_rak','isbn','tahun','bahasa','halaman','jumlah','cover','judul_buku','deskripsi'];

    public function getBuku($keyword = null)
    {
        // Ambil data buku dengan join
        $builder = $this->table($this->table)
            ->select('buku.*, kategori.nama_kategori, penerbit.nama_penerbit, penulis.nama_penulis, rak_buku.nama_rak, rak_buku.lantai_rak')
            ->join('kategori', 'buku.id_kategori = kategori.id_kategori')
            ->join('penerbit', 'buku.id_penerbit = penerbit.id_penerbit')
            ->join('penulis', 'buku.id_penulis = penulis.id_penulis')
            ->join('rak_buku', 'buku.id_rak = rak_buku.id_rak')
            ->orderBy('judul_buku', 'ASC');

        if ($keyword) {
            $builder->like('judul_buku', $keyword);
        }

        $buku = $builder->paginate(5);

        return $buku;
    }

    public function getBukuById($id)
    {
        return $this->table($this->table)
        ->select('buku.*, kategori.nama_kategori, penerbit.nama_penerbit, penulis.nama_penulis, rak_buku.nama_rak, rak_buku.lantai_rak')
        ->join('kategori', 'buku.id_kategori = kategori.id_kategori')
        ->join('penerbit', 'buku.id_penerbit = penerbit.id_penerbit')
        ->join('penulis', 'buku.id_penulis = penulis.id_penulis')
        ->join('rak_buku', 'buku.id_rak = rak_buku.id_rak')
        ->where('buku.id_buku', $id)
        ->first();
    }
    
    public function getAllBuku()
    {
        return $this->select('buku.*, kategori.nama_kategori, penerbit.nama_penerbit, penulis.nama_penulis, rak_buku.nama_rak, rak_buku.lantai_rak')
        ->join('kategori', 'kategori.id_kategori = buku.id_kategori', 'left')
        ->join('penerbit', 'penerbit.id_penerbit = buku.id_penerbit', 'left')
        ->join('penulis', 'penulis.id_penulis = buku.id_penulis', 'left')
        ->join('rak_buku', 'rak_buku.id_rak = buku.id_rak', 'left')
        ->findAll();
    }


    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
