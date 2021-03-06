<?php

class User extends Controller
{
    private $return;
    public function __construct()
    {
        if (!$_SESSION['email']) {
            Flasher::setFlash('Anda belum', 'login', 'danger');
            header('Location: ' . BASEURL . 'auth');
        } else {
            $this->return = true;
            return $this->return;
        }
    }

    public function index()
    {
        if ($this->return == true) {
            $data['ccart'] = $this->model("User_model")->getCountCartByEmail($_SESSION['email']);
            $data['judul'] = 'My Account';
            $data['user'] = $this->model('Auth_model')->getUserByEmail($_SESSION['email']);
            $data['address'] = $this->model("User_model")->getAddressByUserId($data['user']['id']);
            $data['belum_bayar'] = $this->model("User_model")->getDetailOrderByUserIdAndStatusWithGroup($data['user']['id'], 1);
            $data['proses'] = $this->model("User_model")->getDetailOrderByUserIdAndStatusWithGroup($data['user']['id'], 2);
            $data['selesai'] = $this->model("User_model")->getDetailOrderByUserIdAndStatusWithGroup($data['user']['id'], 3);
            $data['detail'] = $this->model("User_model")->getDetailOrderByUserId($data['user']['id']);
            $data['product'] = $this->model("Admin_model")->getAllProduct();
            $this->view('templates/header', $data);
            $this->view('user/index', $data);
            $this->view('templates/footer');
        }
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
        if ($this->return == true) {
            $data['judul'] = 'My Cart';
            $data['ccart'] = $this->model("User_model")->getCountCartByEmail($_SESSION['email']);
            if ($data['ccart'] != 0) {
                $data['cart'] = $this->model("User_model")->getDetailCartByEmail($_SESSION['email']);
                $this->view('templates/header', $data);
                $this->view('user/cart', $data);
                $this->view('templates/footer');
            } else {
                Flasher::setFlash('Anda', 'belum menambahkan apapun', 'danger');
                header('Location: ' . BASEURL);
            }
        }
    }

    public function checkout()
    {
        if ($this->return == true) {
            if ($_POST != null) {
                $data['ccart'] = $this->model("User_model")->getCountCartByEmail($_SESSION['email']);
                $data['post'] = $_POST;
                $data['count'] = count($_POST['quantity']);
                $data['user'] = $this->model('Auth_model')->getUserByEmail($_SESSION['email']);
                $data['address'] = $this->model("User_model")->getAddressByUserId($data['user']['id']);
                $data['judul'] = 'Checkout';
                $this->view('templates/header', $data);
                $this->view('user/checkout', $data);
                $this->view('templates/footer');
            } else {
                Flasher::setFlash('Anda belum', 'memilih produk', 'danger');
                header('Location: ' . BASEURL);
            }
        }
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

    public function addorder()
    {
        if ($_POST != null) {
            $user = $this->model("Auth_model")->getUserByEmail($_SESSION['email']);
            $id = $this->model("Admin_model")->addOrder($user['id']);
            $data = $this->model("Admin_model")->addOrderItems($id);
            if ($data == 1) {
                $this->model("Admin_model")->deleteAllItemCart($user['id']);
                Flasher::setFlash('Checkout berhasil', "gunakan Order Id $id sebegai referensi pembayaran", 'success');
                header('Location: ' . BASEURL . 'user/payment');
            } else {
                Flasher::setFlash('Checkout', 'gagal', 'danger');
                header('Location: ' . BASEURL . 'user/checkout');
            }
        } else {
            Flasher::setFlash('Anda belum', 'melakukan checkout', 'danger');
            header('Location: ' . BASEURL);
        }
    }

    public function payment()
    {
        if ($this->return == true) {
            $data['ccart'] = $this->model("User_model")->getCountCartByEmail($_SESSION['email']);
            $id = $this->model("Auth_model")->getUserByEmail($_SESSION['email']);
            $data['orders'] = $this->model("Admin_model")->getOrderByUserId($id['id']);
            $data['judul'] = 'Payment';
            $this->view('templates/header', $data);
            $this->view('user/payment', $data);
            $this->view('templates/footer');
        }
    }

    public function savepayment()
    {
        $file = $_FILES['payment_image'];
        $image = Uploader::uploadSingle($file);
        $data = $this->model("User_model")->addPayment($image);
        if ($data == 1) {
            Flasher::setFlash('Konfirmasi pembayaran berhasil,', 'tunggu konfirmasi dari admin', 'success');
            header('Location: ' . BASEURL . 'user');
        } else {
            Flasher::setFlash('Konfirmasi pembayaran', 'gagal', 'danger');
            header('Location: ' . BASEURL . 'user/payment');
        }
    }

    public function address()
    {
        if ($this->return == true) {
            $data['ccart'] = $this->model("User_model")->getCountCartByEmail($_SESSION['email']);
            $data['judul'] = "Tambah Alamat";
            $this->view('templates/header', $data);
            $this->view('user/address', $data);
            $this->view('templates/footer');
        }
    }

    public function addAddress()
    {
        if (isset($_POST)) {
            $user = $this->model("Auth_model")->getUserByEmail($_SESSION['email']);
            $data = $this->model("User_model")->addAddress($user['id']);
            if ($data == 1) {
                Flasher::setFlash('Alamat berhasil,', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . 'user');
            } else {
                Flasher::setFlash('Alamat gagal', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . 'user/address');
            }
        } else {
            Flasher::setFlash('Anda belum', 'memasukkan data apapun', 'danger');
            header('Location: ' . BASEURL);
        }
    }
}
