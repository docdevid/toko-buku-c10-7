<?php

namespace App\Models;

use App\Entities\BarangEntity;
use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'barang';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = BarangEntity::class;
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'kategori_id',
        'judul',
        'lokasi',
        'deskripsi',
        'gambar',
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
        $builder = $this->table($this->table);
        // $builder->select('amal_usaha.*, jenis_usaha.nama as jenis_usaha_nama');
        // $builder->join('jenis_usaha', 'jenis_usaha.id = ' . $this->table . '.jenis_usaha_id');
        if ($keyword) $builder->like(['barang.barang' => $keyword]);
        return $builder;
    }
}
