<?php

class User extends Controller
{
    public function __construct()
    {
        if (!$_SESSION['email']) {
            Flasher::setFlash('Anda belum', 'login', 'danger');
            header('Location: ' . BASEURL . 'auth');
        }
    }

    public function index()
    {
        $data['judul'] = 'My Account';
        $data['user'] = $this->model('Auth_model')->getUserByEmail($_SESSION['email']);
        $this->view('templates/header', $data);
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    public function addtocart($id)
    {
        $data['user'] = $this->model('Auth_model')->getUserByEmail($_SESSION['email']);
        var_dump($data['user']);
        var_dump($id);
        var_dump($_POST);
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

    public function update($id)
    {
        if ($_POST['old_image'] != '') {
            if ($_FILES['user_image']['error'] === 4) {
                $image = $_POST['old_image'];
                $data = $this->model("Auth_model")->updateUser($id, $image);
                if ($data == 1) {
                    Flasher::setFlash('Data user berhasil', 'diubah', 'success');
                    header('Location: ' . BASEURL . 'user');
                } else {
                    Flasher::setFlash('Data user gagal', 'diubah', 'danger');
                    header('Location: ' . BASEURL . 'user');
                }
            } else {
                $file = $_FILES['user_image'];
                $old_image = $_POST['old_image'];
                if ($old_image != 'default.jpg') {
                    unlink('img/' . $old_image);
                }
                $image = Uploader::uploadSingle($file);
                $data = $this->model("Auth_model")->updateUser($id, $image);
                if ($data == 1) {
                    Flasher::setFlash('Data user berhasil', 'diubah', 'success');
                    header('Location: ' . BASEURL . 'user');
                } else {
                    Flasher::setFlash('Data user gagal', 'diubah', 'danger');
                    header('Location: ' . BASEURL . 'user');
                }
            }
        }
    }
}
