<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\GraphEntity;
use App\Models\GraphModel;
use App\Models\NodeModel;

class GraphController extends BaseController
{
    public function __construct()
    {
        $this->graphEntity = new GraphEntity();
        $this->graphModel = new GraphModel();
        $this->nodeModel = new NodeModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $graphs = $this->graphModel->get($this->request->getGet('search'));
        if (!$this->request->isAJAX()) {
            return view('admin/graph/index', [
                'graphs'         => $graphs->paginate(10),
                'pager'         => $this->graphModel->pager,
                'title'         => 'Graph'
            ]);
        } else {
            echo json_encode($graphs->findAll());
        }
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        return view('admin/graph/show', [
            'title' => 'Graph',
            'graph' => $this->graphModel->getByID($id)->first()
        ]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {

        $graphs = $this->graphModel->get($this->request->getGet('search'));
        $nodes = $this->nodeModel->get($this->request->getGet('search'));
        if (!$this->request->isAJAX()) {
            return view('admin/graph/_form', [
                'title'         => 'Graph',
                'validation'    => $this->validation,
                'nodes'         => $nodes->find(),
            ]);
        } else {
            echo json_encode($graphs->findAll(), $nodes->find());
        }
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        if ($this->validation->run($this->request->getPost(), 'createGraph')) {
            $this->graphEntity->fill($this->request->getPost());
            $this->graphModel->save($this->graphEntity);
            return redirect()->to('admin/master/graph/new')->with('create_success', alert('success', 'Data berhasil ditambahkan', 'Success'));
        } else {
            return redirect()->to('admin/master/graph/new')->withInput()->with('validation', $this->validation->getErrors());
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        $graph = $this->graphModel->find($id);
        if (!$graph) {
            return redirect()->to('admin/master/graph')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        $nodes = $this->nodeModel->get($this->request->getGet('search'));
        if (!$this->request->isAJAX()) {
            return view('admin/graph/_form', [
                'title'         => 'Graph',
                'validation'    => $this->validation,
                'nodes'         => $nodes->find(),
                'graph'         => $graph,
            ]);
        } else {
            echo json_encode($nodes->findAll());
        }
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        if ($this->validation->run($this->request->getPost(), 'updateGraph')) {
            $this->graphEntity->fill($this->request->getPost());
            $this->graphModel->save($this->graphEntity);
            return redirect()->to('admin/master/graph')->with('update_success', alert('success', 'Data berhasil diubah', 'Success'));
        } else {

            dd($this->validation->getErrors());
            return redirect()->to('admin/master/graph/' . $id . '/edit')->withInput()->with('validation', $this->validation->getErrors());
        }
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        $graph = $this->graphModel->find($id);
        if (!$graph) {
            return redirect()->to('admin/master/graph')->with('get_failed', alert('danger', 'Pengguna tidak ditemukan', 'Error '));
        }
        $this->graphModel->delete($id);
        return redirect()->to('admin/master/graph')->with('delete_success', alert('success', 'Data berhasil dihapus', 'Berhasil'));
    }
}
