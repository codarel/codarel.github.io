<?php

class User extends Controller
{
    public function index()
    {
        $data['judul'] = 'My Account';
        $data['user'] = $this->model('Auth_model')->getUserByEmail($_SESSION['email']);
        $this->view('templates/header', $data);
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    public function cart()
    {
        $data['judul'] = 'My Cart';
        $this->view('templates/header', $data);
        $this->view('user/cart');
        $this->view('templates/footer');
    }

    public function checkout()
    {
        $data['judul'] = 'Checkout';
        $this->view('templates/header', $data);
        $this->view('user/checkout');
        $this->view('templates/footer');
    }
}
