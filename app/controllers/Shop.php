<?php

class Shop extends Controller
{
    public function index()
    {
        $data['judul'] = 'Shop';
        $this->view('templates/header', $data);
        $this->view('shop/index');
        $this->view('templates/footer');
    }

    public function grid()
    {
        $data['judul'] = 'Shop Grid';
        $this->view('templates/header', $data);
        $this->view('shop/grid');
        $this->view('templates/footer');
    }

    public function blog()
    {
        $data['judul'] = 'Blog';
        $this->view('templates/header', $data);
        $this->view('shop/blog');
        $this->view('templates/footer');
    }
}
