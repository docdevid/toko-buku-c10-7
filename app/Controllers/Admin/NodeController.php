<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\NodeEntity;
use App\Models\NodeModel;

class NodeController extends BaseController
{
    protected $nodeModel;

    public function __construct()
    {
        $this->nodeModel = new NodeModel();
        $this->nodeEntity = new NodeEntity();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $nodes = $this->nodeModel->get($this->request->getGet('search'));
        if (!$this->request->isAJAX()) {
            return view('admin/node/index', [
                'nodes'         => $nodes->paginate(10),
                'pager'         => $this->nodeModel->pager,
                'title'         => 'Node'
            ]);
        } else {
            echo json_encode($nodes->findAll());
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        $node = $this->nodeModel->find($id);
        if (!$node) {
            return redirect()->to('admin/master/node')->with('get_failed', alert('danger', 'Node tidak ditemukan', 'Error '));
        }
        return view('admin/node/show', [
            'title' => 'Node',
            'validation' => $this->validation,
            'node' => $node
        ]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        $nodes = $this->nodeModel->get($this->request->getGet('search'));
        if (!$this->request->isAJAX()) {
            return view('admin/node/_form', [
                'title'         => 'Node',
                'validation'    => $this->validation
            ]);
        } else {
            echo json_encode($nodes->findAll());
        }
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        if ($this->validation->run($this->request->getPost(), 'createNode')) {
            $this->nodeEntity->fill($this->request->getPost());
            $this->nodeModel->save($this->nodeEntity);
            return redirect('admin/master/node/new')->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
        } else {
            return redirect()->to('admin/master/node/new')->withInput()->with('validation', $this->validation->getErrors());
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $node = $this->nodeModel->find($id);
        if (!$node) {
            return redirect()->to('admin/master/node')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        return view('admin/node/_form', [
            'title'         => 'Perbarui Pengguna',
            'validation'    => $this->validation,
            'node' => $node
        ]);
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        if ($this->validation->run($this->request->getPost(), 'updateNode')) {
            $this->nodeEntity->fill($this->request->getPost());
            $this->nodeModel->save($this->nodeEntity);
            return redirect()->to('admin/master/node')->with('create_success', alert('success', 'Data berhasil diperbarui', 'Berhasil'));
        } else {
            return redirect()->to('admin/master/node/new')->withInput()->with('validation', $this->validation->getErrors());
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $node = $this->nodeModel->find($id);
        if (!$node) {
            return redirect()->to('admin/master/node')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        $this->nodeModel->delete($id);
        return redirect()->to('admin/master/node')->with('delete_success', alert('success', 'Data berhasil dihapus', 'Berhasil'));
    }
}
