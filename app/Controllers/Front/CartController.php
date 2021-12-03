<?php

namespace App\Controllers\Front;

use App\Controllers\BaseController;
use App\Models\BukuModel;
use App\Models\UserModel;

class CartController extends BaseController
{
    public function __construct()
    {
        $this->BukuModel = new BukuModel();
        $this->UserModel = new UserModel();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        $cart_items = $this->session->get('cart_items');
        if ($cart_items == null) return redirect()->back()->with('error', alert('danger', 'Belum ada item yang dimasukan'));
        $member_id = $this->session->has('userdata') ? $this->session->get('userdata')->id : 0;
        return view('front/cart/index', [
            'title' => getAppName(),
            'bukus' => $this->BukuModel
                ->select('buku.*, kategori.kategori kategori,penerbit.penerbit penerbit')
                ->join('kategori', 'kategori.id = buku.kategori_id', 'left')
                ->join('penerbit', 'penerbit.id = buku.penerbit_id', 'left')
                ->find(array_values(array_unique($cart_items))),
            'user' => $this->UserModel->find($member_id),
            'validation' => $this->validation
        ]);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new($id = null)
    {
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        $buku_id = $this->request->getPost('buku_id');
        $session = $this->session;
        if ($session->has('cart_items')) {
            $session->push('cart_items', [
                $buku_id,
            ]);
        } else {
            $session->set('cart_items', [
                $buku_id
            ]);
        }
        return redirect()->back()->with('cart_create_success', alert('success', 'Data berhasil ditambahkan ke keranjang belanja'));
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
