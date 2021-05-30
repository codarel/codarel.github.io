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
            $data['stocks'] = $this->model('Admin_model')->getAllDetailProduct();
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
        if (true == $this->model("Admin_model")->getProductBySku($_POST['sku'])) {
            Flasher::setFlash('Nomor SKU', 'tidak boleh sama', 'danger');
            header('Location: ' . BASEURL . 'admin/create');
        } else {
            $data = $this->model("Admin_model")->addProduct();
            if ($data == 1) {
                Flasher::setFlash('Data produk berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . 'admin');
            }
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
        $product = $this->model("Admin_model")->getProductBySku($_POST['sku']);
        $productid = $this->model("Admin_model")->getProductById($id);
        if ($product['sku'] != $productid['sku']) {
            Flasher::setFlash('Nomor SKU', 'tidak boleh sama', 'danger');
            header('Location: ' . BASEURL . 'admin/edit/' . $id);
        } else {
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

    public function stock()
    {
        if ($this->return == true) {
            $data['judul'] = 'Tambah Data Stok Produk';
            $data['products'] = $this->model('Admin_model')->getAllProduct();
            $this->view('templates/header', $data);
            $this->view('admin/stock', $data);
            $this->view('templates/footer');
        }
    }

    public function savestock()
    {
        var_dump($_POST);
        $stock = $this->model("Admin_model")->getStockByProductIdAndSize($_POST['product_id'], $_POST['size']);
        if ($stock['size'] === $_POST['size']) {
            Flasher::setFlash('Size', 'sudah ada', 'danger');
            header('Location: ' . BASEURL . 'admin/stok');
        } else {
            $data = $this->model("Admin_model")->addStok();
            if ($data == 1) {
                Flasher::setFlash('Data stok berhasil', 'ditambahkan', 'success');
                header('Location: ' . BASEURL . 'admin');
            } else {
                Flasher::setFlash('Data stok gagal', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . 'admin');
            }
        }
    }

    public function editstock($id)
    {
        $data['judul'] = 'Update Data Produk';
        $data['products'] = $this->model('Admin_model')->getAllProduct();
        $data['stock'] = $this->model("Admin_model")->getStockById($id);
        $this->view('templates/header', $data);
        $this->view('admin/editstock', $data);
        $this->view('templates/footer');
    }

    public function updatestock($id)
    {
        $stock = $this->model("Admin_model")->getStockById($id);
        if ($id == $stock['id']) {
            if (isset($_POST['product_id'])) {
                $data = $this->model("Admin_model")->updateStok($id);
                if ($data == 1) {
                    Flasher::setFlash('Data stok berhasil', 'diubah', 'success');
                    header('Location: ' . BASEURL . 'admin');
                } else {
                    Flasher::setFlash('Data stok gagal', 'diubah', 'danger');
                    header('Location: ' . BASEURL . 'admin');
                }
            } else {
                Flasher::setFlash('Anda', 'belum memasukkan apapun', 'danger');
                header('Location: ' . BASEURL . 'admin');
            }
        } else {
            Flasher::setFlash('Stok produk dengan id ' . $id, 'tidak ada', 'danger');
            header('Location: ' . BASEURL . 'admin');
        }
    }

    public function deletestock($id)
    {
        if (isset($_POST['_method'])) {
            $this->model("Admin_model")->deleteStock($id);
            Flasher::setFlash('Data stok produk berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . 'admin');
        } else {
            Flasher::setFlash('Data stok produk gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . 'admin');
        }
    }
}
