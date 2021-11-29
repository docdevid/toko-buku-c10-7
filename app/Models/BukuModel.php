<?php

namespace App\Models;

use App\Entities\BukuEntity;
use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'buku';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = BukuEntity::class;
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'penerbit_id',
        'kategori_id',
        'judul',
        'penulis',
        'berat',
        'dimensi',
        'bahasa',
        'cover',
        'ISBN',
        'deskripsi',
        'harga',
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
        $builder = $this->select('buku.*,kategori.kategori as kategori,penerbit.penerbit as penerbit');
        $builder = $builder->table($this->table);
        $builder = $builder->join('kategori', 'kategori.id = buku.kategori_id', 'left');
        $builder = $builder->join('penerbit', 'penerbit.id = buku.penerbit_id', 'left');
        if ($keyword) $builder->like(['judul' => $keyword]);
        return $builder;
    }
}
