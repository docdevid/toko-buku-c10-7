<?php

namespace App\Models;

use App\Entities\DetailPemesananEntity;
use CodeIgniter\Model;

class DetailPemesananModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'detail_pemesanan';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = DetailPemesananEntity::class;
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'pemesanan_id',
        'buku_id',
        'harga',
        'sub_total',
        'qty',
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

    public function get($id_pemesanan)
    {
        $builder = $this->select('detail_pemesanan.*,
        buku.judul judul');
        $builder = $builder->table($this->table);
        $builder = $builder->join('buku', 'buku.id = detail_pemesanan.buku_id', 'left');
        $builder = $builder->join('pemesanan', 'pemesanan.id = detail_pemesanan.pemesanan_id', 'left');
        $builder = $builder->where('pemesanan_id', $id_pemesanan);
        return $builder;
    }
}
