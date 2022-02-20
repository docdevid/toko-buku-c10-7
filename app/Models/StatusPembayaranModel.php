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

    public function getLaporan()
    {
        $builder = $this->table($this->table);
        $builder->join('detail_pemesanan', "detail_pemesanan.pemesanan_id = $this->table.pemesanan_id", 'left');
        $builder->where("$this->table.status = 'dibayar'");
        $builder->select("YEAR($this->table.created_at) as tahun, MONTH($this->table.created_at) as bulan,sum(detail_pemesanan.qty) total_terjual,count($this->table.id) total_transaksi,sum(detail_pemesanan.sub_total) total_pemasukan");
        $builder->groupBy("YEAR($this->table.created_at), MONTH($this->table.created_at)");
        $builder->orderBy("YEAR($this->table.created_at), MONTH($this->table.created_at)", 'DESC');
        return $builder;
    }
}
