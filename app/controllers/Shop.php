<?php

class Shop extends Controller
{
    public function index()
    {
        $data['judul'] = 'Shop';
        if (isset($_SESSION['email'])) {
            $data['ccart'] = $this->model("User_model")->getCountCartByEmail($_SESSION['email']);
        }
        $data['products'] = $this->model("Admin_model")->getAllDetailProductWithGroup();
        $this->view('templates/header', $data);
        $this->view('shop/index', $data);
        $this->view('templates/footer');
    }

    public function product($sku)
    {
        $data['judul'] = 'Product Details';
        $data['product'] = $this->model("Admin_model")->getDetailProductBySkuWithGroup($sku);
        $data['stock'] = $this->model("Admin_model")->getDetailProductBySku($sku);
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
}
