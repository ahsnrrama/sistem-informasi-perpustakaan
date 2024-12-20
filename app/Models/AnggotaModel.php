<?php

namespace App\Models;

use CodeIgniter\Model;

class AnggotaModel extends Model
{
    protected $table            = 'anggota';
    protected $primaryKey       = 'id_anggota';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama_mahasiswa', 'alamat', 'foto', 'nim', 'id_kelas', 'jenis_kelamin', 'no_hp', 'email', 'password','verifikasi'];

    public function LoginAnggota($nim, $password)
    {
        // Cari pengguna berdasarkan nim
        $user = $this->select('anggota.*, users.level')
            ->join('users', 'users.email = anggota.email')
            ->where('anggota.nim', $nim)
            ->get()
            ->getRowArray();


        // Jika pengguna ditemukan, verifikasi password
        if ($user) {
            if (password_verify($password, $user['password'])) {
                // jika password benar dan pengguna ditemukan
                return ['pesan' => 'success', 'user' => $user];
            } else {
                // jika password salah
                return ['pesan' => 'invalid_password'];
            }
        } else {
            // jika pengguna tidak ditemukan
            return ['pesan' => 'user_not_found'];
        }
    }

    // Fungsi untuk mengambil data anggota beserta nama kelasnya
    public function getAnggotaWithKelas($id_anggota)
    {
        return $this->select('anggota.*, kelas.nama_kelas')
        ->join('kelas', 'kelas.id_kelas = anggota.id_kelas')
        ->where('anggota.id_anggota', $id_anggota)
            ->first();
    }

    public function Searching($keyword = null)
    {
        $builder = $this->table($this->table)
                        ->orderBy('nim', 'ASC')
                        ->select('anggota.*, kelas.nama_kelas')
                        ->join('kelas', 'kelas.id_kelas = anggota.id_kelas');
        if ($keyword) {
            $builder->like('nama_mahasiswa', $keyword);
        }
        return $builder->paginate(5);
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
