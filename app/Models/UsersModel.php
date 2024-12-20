<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id_user';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username','email','password','foto','level'];

    public function LoginUser($emailOrUsername, $password)
    {
        // Cari pengguna berdasarkan email atau username
        $user = $this->db->table($this->table)
            ->where('email', $emailOrUsername)
            ->orWhere('username', $emailOrUsername)
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
