<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Entities\DetailPemesananEntity;
use App\Entities\PemesananEntity;
use App\Models\BukuModel;
use App\Models\DetailPemesananModel;
use App\Models\PemesananModel;

class PemesananController extends BaseController
{
    public function __construct()
    {
        $this->BukuModel = new BukuModel();
        $this->PemesananModel = new PemesananModel();
        $this->PemesananEntity = new PemesananEntity();
        $this->DetailPemesananModel = new DetailPemesananModel();
        $this->DetailPemesananEntity = new DetailPemesananEntity();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        return view('admin/pemesanan/index', [
            'title' => 'Pemesanan',
            'pemesanans' => $this->PemesananModel->get($this->request->getGet('search'))->paginate(10),
            'pager' => $this->PemesananModel->pager,
        ]);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        return view('admin/pemesanan/show', [
            'title' => getAppName(),
            'pemesanan' => $this->PemesananModel->getByID($id)->first(),
            'detail_pemesanans' => $this->DetailPemesananModel->get($id)->find(),
        ]);
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $cart_items = $this->session->get('cart_items');
        $bukus = $this->BukuModel
            ->select('buku.*, kategori.kategori kategori,penerbit.penerbit penerbit')
            ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
            ->join('penerbit', 'penerbit.id = buku.penerbit_id', 'left')
            ->find(array_values(array_unique($cart_items)));


        $total = array_sum(array_column($bukus, 'harga'));
        $qty = 0;
        $sub_total = 0;
        $total = 0;
        $data_batch = array();
        // dd($bukus);


        if ($this->validation->run($this->request->getPost(), 'createPemesanan')) {
            $this->PemesananEntity->fill($this->request->getPost());
            $pemesanan_id = $this->PemesananModel->insert($this->PemesananEntity);
            foreach ($bukus as $buku) :
                $qty = array_count_values(session()->get('cart_items'))[$buku->id];
                array_push($data_batch, [
                    'pemesanan_id' => $pemesanan_id,
                    'buku_id' => $buku->id,
                    'harga' => $buku->harga,
                    'sub_total' => $qty * $buku->harga,
                    'qty' => $qty,
                ]);
            endforeach;
            $this->DetailPemesananModel->insertBatch($data_batch);
            unset($_SESSION['cart_items']);
            return redirect()->to('member/pemesanan/' . $pemesanan_id)->with('create_success', alert('success', 'Data berhasil disimpan', 'Berhasil'));
        } else {
            return redirect()->back()->withInput()->with('validation', $this->validation->getErrors());
        }
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }
}
