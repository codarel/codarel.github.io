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
        $this->view('templates/header', $data);
        $this->view('admin/index', $data);
        $this->view('templates/footer');
    }
}
