<?php

namespace App\Controllers;

use App\Models\M_Barang;

class C_Barang extends BaseController
{
    protected $model;

    public function __construct()
    {
        $this->model = new M_Barang();
    }

    public function intro()
    {
        $data =  [
            'name' => 'Ariana Rahmawati',
            'title' => 'barang'
        ];
        return view('barang/index', $data);
    }

    public function display()
    {
        $barang = $this->model->getAll();
        $data = [
            'barang' => $barang,
            'title' => 'Barang'
        ];
        return view('v_barang_display', $data);
    }


    public function barang_create()
    {
        $data = [
            'title' => 'Barang'
        ];
        return view('v_barang_create', $data);
    }

    public function barang_store()
    {
        if (!$this->validate([
            'nama_barang' => [
                'label' => 'nama_barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'stok' => [
                'label' => 'stok',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi'
                ]
            ],
            'harga_barang' => [
                'label' => 'harga_barang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ],
            'nama_file' => [
                'label' => 'nama_file',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} harus diisi',
                ]
            ]
        ])) {
            return view('v_barang_create', [
                'errors' => $this->validator->getErrors(),
                'title' => 'Store Barang Error !'
            ]);
        }

        $data = [
            'nama_barang' => $this->request->getPost('nama_barang'),
            'stok' => $this->request->getPost('stok'),
            'harga_barang' => $this->request->getPost('harga_barang'),
            'nama_file' => $this->request->getPost('nama_file')
        ];

        $this->model->barang_store($data);
        return redirect()->to('/barang');
    }

    public function detail($id_barang)
    {
        if (session()->get('username') == '') {

            session()->setFlashdata('gagal', 'Anda belum login!');
            return redirect()->to('/login');
        }

        $data = [
            'barang' => $this->model->barang_get($id_barang),
            'title' => 'Detail Barang'
        ];
        return view('v_barang_detail', $data);
    }

    public function destroy($id_barang)
    {
        $this->model->barang_destroy($id_barang);
        return redirect()->to('/barang');
    }
}
