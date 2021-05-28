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

    public function product($sku)
    {
        $data['judul'] = 'Product Details';
        $data['product'] = $this->model("Admin_model")->getDetailProductBySkuWithGroup($sku);
        $data['stock'] = $this->model("Admin_model")->getDetailProductBySku($sku);
        var_dump($data['product']);
        var_dump($data['stock']);
        $this->view('templates/header', $data);
        $this->view('shop/product', $data);
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
