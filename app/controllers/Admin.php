<?php

class Admin extends Controller
{
    private $return;
    public function __construct()
    {
        if (!$_SESSION['email']) {
            Flasher::setFlash('Anda belum', 'login', 'danger');
            header('Location: ' . BASEURL . 'auth');
        } else if ($_SESSION['role_id'] != 1) {
            Flasher::setFlash('Anda tidak memiliki', 'Akses', 'danger');
            header('Location: ' . BASEURL);
        } else {
            $this->return = true;
            return $this->return;
        }
    }

    public function index()
    {
        if ($this->return == true) {
            $data['judul'] = 'Admin';
            $data['users'] = $this->model('Auth_model')->getAllUser();
            $data['products'] = $this->model('Admin_model')->getAllProduct();
            $this->view('templates/header', $data);
            $this->view('admin/index', $data);
            $this->view('templates/footer');
        }
    }

    public function create()
    {
        if ($this->return == true) {
            $data['judul'] = 'Tambah Data Produk';
            $this->view('templates/header', $data);
            $this->view('admin/create', $data);
            $this->view('templates/footer');
        }
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
                    if ($explode[$i] != 'product.jpg') {
                        $path = $explode[$i];
                        unlink('img/' . $path);
                    }
                }
            }
        }

        $this->model("Admin_model")->deleteProduct($id);
        Flasher::setFlash('Data produk berhasil', 'dihapus', 'success');
        header('Location: ' . BASEURL . 'admin');
    }

    public function edit($id)
    {
        $data['judul'] = 'Update Data Produk';
        $data['file'] = $this->model("Admin_model")->getProductById($id);
        $this->view('templates/header', $data);
        $this->view('admin/edit', $data);
        $this->view('templates/footer');
    }

    public function update($id)
    {
        if ($_POST['old_image'] != '') {
            if ($_FILES['product_image']['error'][0] === 4) {
                $data = $_POST['old_image'];
                $return = $this->model("Admin_model")->updateProduct($id, $data);
                if ($return == 1) {
                    Flasher::setFlash('Data produk berhasil', 'diubah', 'success');
                    header('Location: ' . BASEURL . 'admin');
                } else {
                    Flasher::setFlash('Data produk gagal', 'diubah', 'danger');
                    header('Location: ' . BASEURL . 'admin');
                }
            } else {
                $file = $_FILES['product_image'];
                $explode = explode(",", $_POST['old_image']);
                $count = count($explode);
                // hapus gambar
                for ($i = 0; $i < $count; $i++) {
                    if (str_word_count($explode[$i]) != 0) {
                        if ($explode[$i] == is_file('img/' . $explode[$i])) {
                            if ($explode[$i] != 'product.jpg') {
                                $path = $explode[$i];
                                unlink('img/' . $path);
                            }
                        }
                    }
                }
                $fileName = Uploader::upload($file);
                $data = join(',', $fileName);
                $return = $this->model("Admin_model")->updateProduct($id, $data);
                if ($return == 1) {
                    Flasher::setFlash('Data produk berhasil', 'diubah', 'success');
                    header('Location: ' . BASEURL . 'admin');
                }
            }
        }
    }
}
