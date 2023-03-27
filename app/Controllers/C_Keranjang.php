<?php

namespace App\Controllers;

use App\Models\M_Barang;

class C_Keranjang extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new M_Barang();
    }

    public function index()
    {
        $data['items'] = array_values(session('cart'));
        $data['total'] = $this->total();
        return view('v_cart', $data);
    }

    public function buy($id)
    {
        $barang = $this->model->barang_get($id);
        if ($barang['stok'] <= 0) {
            session()->setFlashdata('error', 'Maaf, stok barang habis');
            return redirect()->to(site_url('barang'));
        }
        $item = array(
            'id_barang' => $barang['id_barang'],
            'nama_barang' => $barang['nama_barang'],
            'stok' => $barang['stok'],
            'harga_barang' => $barang['harga_barang'],
            'nama_file' => $barang['nama_file'],
            'kuantitas' => 1
        );
        $session = session();
        if ($session->has('cart')) {
            $index = $this->exists($id);
            $cart = array_values(session('cart'));
            if ($index == -1) {
                array_push($cart, $item);
            } else {
                $cart[$index]['kuantitas']++;
            }
            $session->set('cart', $cart);
        } else {
            $cart = array($item);
            $session->set('cart', $cart);
        }
        $this->model->barang_kurang_stok($barang['id_barang']);
        return redirect()->to(site_url('cart/index'));
    }


    public function remove($id)
    {
        $index = $this->exists($id);
        $cart = array_values(session('cart'));
        unset($cart[$index]);
        $session = session();
        $session->set('cart', $cart);
        $this->model->barang_tambah_stok($id); // menambah stok barang
        return redirect()->to(site_url('cart/index'));
    }


    public function update()
    {
        $cart = array_values(session('cart'));
        for ($i = 0; $i < count($cart); $i++) {
            $kuantitas = $_POST['kuantitas'][$i];
            $id_barang = $cart[$i]['id_barang'];
            $barang = $this->model->barang_get($id_barang);
            if ($kuantitas <= $barang['stok']) {
                $cart[$i]['kuantitas'] = $kuantitas;
                $this->model->barang_kurang_stok($id_barang, $cart[$i]['kuantitas'] - $_POST['kuantitas'][$i]); // mengurangi stok barang
            } else {
                // stok barang tidak mencukupi, tampilkan pesan error dan kembalikan ke halaman keranjang
                session()->setFlashdata('error', 'Maaf, stok barang ' . $cart[$i]['nama_barang'] . ' tidak mencukupi untuk jumlah yang diminta.');
                return redirect()->to(site_url('cart/index'));
            }
        }
        $session = session();
        $session->set('cart', $cart);
        return redirect()->to(site_url('cart/index'));
    }


    private function exists($id)
    {
        $items = array_values(session('cart'));
        for ($i = 0; $i < count($items); $i++) {
            if ($items[$i]['id_barang'] == $id) {
                return $i;
            }
        }
        return -1;
    }

    private function total()
    {
        $s = 0;
        $items = array_values(session('cart'));
        foreach ($items as $item) {
            $s += $item['harga_barang'] * $item['kuantitas'];
        }
        return $s;
    }
}
