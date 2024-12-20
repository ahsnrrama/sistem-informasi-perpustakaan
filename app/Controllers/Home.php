<?php

namespace App\Controllers;

use App\Models\BukuModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->bukumodel = new BukuModel();
    }
    public function index(): string
    {

        $data = [
            'judul' => 'Home',
            'books' => $this->bukumodel->getAllBuku(),
        ];
        return view('frontend/index',$data);
    }

    public function detail($id): string
    {

        $data = [
            'judul' =>  'Detail Buku',
            'book' => $this->bukumodel->getBukuById($id),
        ];
        return view('frontend/detail',$data);
    }
}
