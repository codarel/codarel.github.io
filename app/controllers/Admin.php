<?php

class Admin extends Controller
{
    public function __construct()
    {
        if (!$_SESSION['email']) {
            Flasher::setFlash('Anda belum', 'login', 'danger');
            header('Location: ' . BASEURL . 'auth');
        } else if ($_SESSION['role_id'] != 1) {
            Flasher::setFlash('Anda tidak memiliki', 'Akses', 'danger');
            header('Location: ' . BASEURL);
        }
    }

    public function index()
    {
        $data['judul'] = 'Admin';
        $data['users'] = $this->model('Auth_model')->getAllUser();
        $data['products'] = $this->model('Admin_model')->getAllProduct();
        $this->view('templates/header', $data);
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $data['judul'] = 'Tambah Data Produk';
        $this->view('templates/header', $data);
        $this->view('admin/create', $data);
        $this->view('templates/footer');
    }

    public function save()
    {
        $data = $this->model("Admin_model")->addProduct();
        if ($data == 1) {
            Flasher::setFlash('Data produk berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . 'admin');
        }
    }

    public function delete($id)
    {
        // cari gambar berdasarkan id
        $file = $this->model("Admin_model")->getProductById($id);
        $fileName = $file['product_image'];
        $explode = explode(",", $fileName);
        $count = count($explode);
        // hapus gambar
        for ($i = 0; $i < $count; $i++) {
            if (str_word_count($explode[$i]) != 0) {
                if ($explode[$i] == is_file('img/' . $explode[$i])) {
                    $path = $explode[$i];
                    unlink('img/' . $path);
                }
            }
        }

        $this->model("Admin_model")->deleteProduct($id);
        Flasher::setFlash('Data produk berhasil', 'dihapus', 'success');
        header('Location: ' . BASEURL . 'admin');
    }
}
