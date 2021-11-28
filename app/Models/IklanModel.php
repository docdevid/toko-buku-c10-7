<?php

namespace App\Models;

use App\Entities\IklanEntity;
use CodeIgniter\Model;

class IklanModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'iklan';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = IklanEntity::class;
    protected $useSoftDeletes       = false;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'user_id',
        'kategori_id',
        'judul',
        'lokasi',
        'deskripsi',
        'gambar',
        'status',
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
        $builder = $this->select('iklan.*,kategori.kategori as kategori,user.nama_lengkap');
        $builder = $builder->table($this->table);
        $builder = $builder->join('kategori', 'kategori.id = iklan.kategori_id', 'left');
        $builder = $builder->join('user', 'user.id = iklan.user_id', 'left');
        if ($keyword) $builder->like(['judul' => $keyword]);
        return $builder;
    }
    public function getByKategori($kategori_id = null, $keyword = null)
    {
        $builder = $this->select('iklan.*,kategori.kategori as kategori,user.nama_lengkap');
        $builder = $builder->table($this->table);
        $builder = $builder->join('kategori', 'kategori.id = iklan.kategori_id');
        $builder = $builder->join('user', 'user.id = iklan.user_id', 'left');
        if ($kategori_id) $builder->where(['kategori_id' => $kategori_id]);
        if ($keyword) $builder->like(['judul' => $keyword]);
        return $builder;
    }
    public function getByID($id)
    {
        $builder = $this->select('iklan.*,kategori.kategori as kategori,user.nama_lengkap,user.email as user_email,user.no_hp as user_no_hp');
        $builder = $builder->table($this->table);
        $builder = $builder->join('kategori', 'kategori.id = iklan.kategori_id');
        $builder = $builder->join('user', 'user.id = iklan.user_id', 'left');
        if ($id) $builder->where(['iklan.id' => $id]);
        return $builder;
    }
    public function getUserId($keyword = null, $user_id)
    {
        $builder = $this->select('iklan.*,kategori.kategori as kategori,user.nama_lengkap');
        $builder = $builder->table($this->table);
        $builder = $builder->join('kategori', 'kategori.id = iklan.kategori_id', 'left');
        $builder = $builder->join('user', 'user.id = iklan.user_id', 'left');
        if ($keyword) $builder->like(['judul' => $keyword]);
        $builder->where(['user_id' => $user_id]);
        return $builder;
    }
    public function getByKategoriUserId($kategori_id = null, $keyword = null, $user_id)
    {
        $builder = $this->select('iklan.*,kategori.kategori as kategori,user.nama_lengkap');
        $builder = $builder->table($this->table);
        $builder = $builder->join('kategori', 'kategori.id = iklan.kategori_id');
        $builder = $builder->join('user', 'user.id = iklan.user_id', 'left');
        if ($kategori_id) $builder->where(['kategori_id' => $kategori_id]);
        if ($keyword) $builder->like(['judul' => $keyword]);
        $builder->where(['user_id' => $user_id]);
        return $builder;
    }
}
