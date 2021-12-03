<?php

namespace App\Models;

use App\Entities\StatusPembayaranEntity;
use CodeIgniter\Model;

class StatusPembayaranModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'status_pembayaran';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = StatusPembayaranEntity::class;
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['pemesanan_id', 'status'];

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

    public function getByPemesanan($id_pemesanan)
    {
        $builder = $this->table($this->table);
        $builder = $builder->where('pemesanan_id', $id_pemesanan);
        return $builder;
    }
}
