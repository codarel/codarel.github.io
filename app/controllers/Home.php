<?php

class Home extends Controller
{
    public function index()
    {
        $data['judul'] = 'Home';
        $data['ccart'] = $this->model("User_model")->getCountCartByEmail($_SESSION['email']);
        $data['products'] = $this->model("Admin_model")->getAllDetailProductWithGroup();
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}
