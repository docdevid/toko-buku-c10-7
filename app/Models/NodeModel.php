<?php

namespace App\Models;

use App\Entities\NodeEntity;
use CodeIgniter\Model;

class NodeModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'node';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = NodeEntity::class;
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['name', 'coordinate'];

    // Dates
    protected $useTimestamps        = true;
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
        $keyword = $keyword ?: null;
        $query = $this->table('node');
        $query->select('node.*,amal_usaha.id as amal_usaha_id,amal_usaha.node_id as amal_usaha_node_id,amal_usaha.gambar as amal_usaha_gambar,amal_usaha.keterangan as amal_usaha_keterangan,jenis_usaha.color as jenis_usaha_color');
        $query->join('amal_usaha', 'amal_usaha.node_id = ' . $this->table . '.id', 'left');
        $query->join('jenis_usaha', 'jenis_usaha.id = amal_usaha.jenis_usaha_id', 'left');
        if ($keyword) $query = $query->like('name', $keyword);
        return $query;
    }
}
