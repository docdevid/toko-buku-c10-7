<?php

namespace App\Models;

use App\Entities\AmalUsahaEntity;
use CodeIgniter\Model;

class AmalUsahaModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'amal_usaha';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = AmalUsahaEntity::class;
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['nama', 'node_id', 'jenis_usaha_id', 'fasilitas', 'kegiatan', 'jam_operasional', 'alamat', 'keterangan', 'gambar', 'coordinate'];

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
        $builder->select('amal_usaha.*, jenis_usaha.nama as jenis_usaha_nama');
        $builder->join('jenis_usaha', 'jenis_usaha.id = ' . $this->table . '.jenis_usaha_id');
        if ($keyword) $builder->like(['amal_usaha.nama' => $keyword]);
        return $builder;
    }

    public function getByID($id)
    {
        $builder = $this->table($this->table);
        $builder->select('amal_usaha.*, jenis_usaha.nama as jenis_usaha_nama');
        $builder->join('jenis_usaha', 'jenis_usaha.id = ' . $this->table . '.jenis_usaha_id');
        $builder->where($this->table . '.id', $id);
        return $builder;
    }
    public function getByJenisUsaha($jenisUsaha)
    {
        $builder = $this->table($this->table);
        $builder->select('amal_usaha.*, jenis_usaha.nama as jenis_usaha_nama,jenis_usaha.slug as jenis_usaha_slug');
        $builder->join('jenis_usaha', 'jenis_usaha.id = ' . $this->table . '.jenis_usaha_id');
        if ($jenisUsaha) $builder->where(['jenis_usaha.slug' => $jenisUsaha]);
        return $builder;
    }
}
