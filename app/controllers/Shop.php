<?php

class Shop extends Controller
{
    public function index()
    {
        $data['judul'] = 'Shop';
        $this->view('templates/header', $data);
        $this->view('shop/index', $data);
        $this->view('templates/footer');
    }
}
