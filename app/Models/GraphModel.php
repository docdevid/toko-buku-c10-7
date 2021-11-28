<?php

namespace App\Models;

use App\Entities\GraphEntity;
use CodeIgniter\Model;

class GraphModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'graph';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = GraphEntity::class;
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = ['start', 'end', 'distance'];

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
        $keyword = $keyword ?: null;
        $query = $this->table($this->table)
            ->select('graph.id as id,n1.id as n1_id,n2.id as n2_id,n1.name startName,n2.name endName,n1.coordinate startCoordinate,n2.coordinate endCoordinate,distance,graph.created_at')
            ->join('node as n1', 'n1.id = ' . $this->table . '.start', 'left')
            ->join('node as n2', 'n2.id = ' . $this->table . '.end', 'left');
        if ($keyword) $query = $query->like('n1.name', $keyword)->orLike('n2.name', $keyword);
        return $query;
    }

    public function getByID($id)
    {
        $query = $this->table($this->table)
            ->select('graph.id as id,
                    n1.name startName,
                    n2.name endName,
                    n1.coordinate as startCoordinate,
                    n2.coordinate as endCoordinate,
                    distance,
                    graph.created_at')
            ->join('node as n1', 'n1.id = ' . $this->table . '.start', 'left')
            ->join('node as n2', 'n2.id = ' . $this->table . '.end', 'left')
            ->where('graph.id', $id);
        return $query;
    }
}
