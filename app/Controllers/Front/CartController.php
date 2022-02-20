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
        $this->cart = \Config\Services::cart();
    }
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    public function index()
    {
        if (count($this->cart->contents()) == 0) return redirect()->back()->with('error', alert('danger', 'Belum ada item yang dimasukan'));
        $member_id = $this->session->has('userdata') ? $this->session->get('userdata')->id : 0;
        return view('front/cart/index', [
            'title' => getAppName(),
            'user' => $this->UserModel->find($member_id),
            'bukus' => $this->cart->contents(),
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
        $book = $this->BukuModel->find($this->request->getPost('buku_id'));
        $this->cart->insert(array(
            'id' => $this->request->getPost('buku_id'),
            'qty' => 1,
            'price' => $book->harga,
            'name' => $book->judul,
            'options' => array($book)
        ));
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
        $this->cart->update(array(
            'rowid' => $this->request->getPost('rowid'),
            'qty' => $this->request->getPost('qty'),
        ));
        return redirect()->back()->with('cart_create_success', alert('success', 'Data berhasil diperbarui'));
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($rowid = null)
    {
        $this->cart->remove($rowid);
        if (count($this->cart->contents()) == 0) return redirect('home')->with('error', alert('danger', 'Belum ada item yang dimasukan'));
        return redirect()->back()->with('cart_create_success', alert('success', 'Data berhasil diperbarui'));
    }
}
