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
        $user = $this->model('Auth_model')->getUserByEmail($_SESSION['email']);
        // var_dump($_POST['quant'][1]);
        if ($this->model('User_model')->getCartByUserProductAndSize($user['id'], $id, $_POST['size']) === 0) {
            $data = $this->model('Admin_model')->addToCart($user['id'], $id);
            if ($data == 1) {
                Flasher::setFlash('Produk berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . 'shop/product/' . $_POST['sku']);
            } else {
                Flasher::setFlash('Produk gagal', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . 'shop/product/' . $_POST['sku']);
            }
        } else {
            Flasher::setFlash('Produk ini', 'sudah ditambahkan sebelumnya', 'danger');
            header('Location: ' . BASEURL . 'shop/product/' . $_POST['sku']);
        }
    }

    public function cart()
    {
        $data['judul'] = 'My Cart';
        $data['ccart'] = $this->model("User_model")->getCountCartByEmail($_SESSION['email']);
        $data['cart'] = $this->model("User_model")->getDetailCartByEmail($_SESSION['email']);
        $this->view('templates/header', $data);
        $this->view('user/cart', $data);
        $this->view('templates/footer');
    }

    public function checkout()
    {
        var_dump($_POST);
        $data['post'] = $_POST;
        $data['count'] = count($_POST['quantity']);

        var_dump(array_sum($_POST['count']));

        $data['judul'] = 'Checkout';
        $this->view('templates/header', $data);
        $this->view('user/checkout', $data);
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

    public function payment()
    {
        var_dump($_POST);
    }
}
