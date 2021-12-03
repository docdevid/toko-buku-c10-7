<?php

namespace App\Models;

use App\Entities\PemesananEntity;
use CodeIgniter\Model;

class PemesananModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'pemesanan';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = PemesananEntity::class;
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'user_id',
        'nama_lengkap',
        'no_hp',
        'email',
        'alamat',
    ];

    // Dates
    protected $useTimestamps        = false;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    public function get($keyword = null)
    {
        $builder = $this->select('pemesanan.*,status_pembayaran.status status_pembayaran_status');
        $builder = $builder->table($this->table);
        $builder = $builder->join('user', 'user.id = pemesanan.user_id', 'left');
        $builder = $builder->join('status_pembayaran', 'status_pembayaran.pemesanan_id = pemesanan.id', 'left');
        if ($keyword) $builder->like(['pemesanan.id' => $keyword]);
        return $builder;
    }

    public function getByID($id)
    {
        $builder = $this->select('pemesanan.*,status_pembayaran.status status_pembayaran_status');
        $builder = $builder->table($this->table);
        $builder = $builder->join('status_pembayaran', 'status_pembayaran.pemesanan_id = pemesanan.id', 'left');
        $builder->where(['pemesanan.id' => $id]);
        return $builder;
    }

    public function getByUser($keyword, $user_id)
    {
        $builder = $this->select('pemesanan.*,status_pembayaran.status status_pembayaran_status');
        $builder = $builder->table($this->table);
        $builder = $builder->join('user', 'user.id = pemesanan.user_id', 'left');
        $builder = $builder->join('status_pembayaran', 'status_pembayaran.pemesanan_id = pemesanan.id', 'left');
        $builder = $builder->where('user_id', $user_id);
        if ($keyword) $builder->like(['pemesanan.id' => $keyword]);
        return $builder;
    }
    public function getByUserAndID($id, $user_id)
    {
        $builder = $this->select('pemesanan.*,status_pembayaran.status status_pembayaran_status');
        $builder = $builder->table($this->table);
        $builder = $builder->join('status_pembayaran', 'status_pembayaran.pemesanan_id = pemesanan.id', 'left');
        $builder = $builder->where('user_id', $user_id);
        $builder->where(['pemesanan.id' => $id]);
        return $builder;
    }
}
