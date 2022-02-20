<?php

namespace App\Controllers\Front\Member;

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
        $this->cart = \Config\Services::cart();
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
        return view('front/member/pemesanan/index', [
            'title' => 'Pemesanan',
            'pemesanans' => $this->PemesananModel->getByUser($this->request->getGet('search'), $this->session->userdata->id)->paginate(10),
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
        return view('front/member/pemesanan/show', [
            'title' => getAppName(),
            'pemesanan' => $this->PemesananModel->getByUserAndID($id, $this->session->userdata->id)->first(),
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
        $cart_items = $this->cart->contents();
        $ids = array_values(array_column($cart_items, 'id'));

        $data_batch = array();
        if ($this->validation->run($this->request->getPost(), 'createPemesanan')) {
            $this->PemesananEntity->fill($this->request->getPost());
            $pemesanan_id = $this->PemesananModel->insert($this->PemesananEntity);
            foreach ($this->cart->contents() as $buku) :
                array_push($data_batch, [
                    'pemesanan_id' => $pemesanan_id,
                    'buku_id' => $buku['id'],
                    'harga' => $buku['price'],
                    'sub_total' => $buku['subtotal'],
                    'qty' => $buku['qty'],
                ]);
            endforeach;
            $this->DetailPemesananModel->insertBatch($data_batch);
            $this->cart->destroy();
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
