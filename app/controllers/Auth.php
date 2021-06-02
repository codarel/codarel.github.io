<?php

class Auth extends Controller
{
    public function index()
    {
        if (isset($_SESSION['email'])) {
            Flasher::setFlash('Anda sudah', 'login', 'danger');
            if ($_SESSION['role_id'] == 1) {
                header('Location: ' . BASEURL . 'admin');
                exit;
            } else {
                header('Location: ' . BASEURL);
                exit;
            }
        } else {
            $data['judul'] = 'Login';
            $this->view('templates/auth_header', $data);
            $this->view('auth/login', $data);
            $this->view('templates/auth_footer');
        }
    }

    public function register()
    {
        if (isset($_SESSION['email'])) {
            Flasher::setFlash('Anda sudah', 'login', 'danger');
            if ($_SESSION['role_id'] == 1) {
                header('Location: ' . BASEURL . 'admin');
                exit;
            } else {
                header('Location: ' . BASEURL);
                exit;
            }
        } else {
            $data['judul'] = 'Register';
            $this->view('templates/auth_header', $data);
            $this->view('auth/register', $data);
            $this->view('templates/auth_footer');
        }
    }

    public function login()
    {
        $this->model("Auth_model")->_login();
    }

    public function create()
    {
        $user = $this->model("Auth_model")->getUserByEmail($_POST['email']);
        if (!isset($user)) {
            if ($this->model('Auth_model')->createUser($_POST) > 0) {
                if ($_POST['password'] === $_POST['confirm']) {
                    Flasher::setFlash('Akun berhasil', 'ditambahkan', 'success');
                    header('Location: ' . BASEURL . 'auth');
                    exit;
                }
            } else {
                Flasher::setFlash('Akun gagal', 'ditambahkan', 'danger');
                header('Location: ' . BASEURL . 'auth');
                exit;
            }
        } else {
            Flasher::setFlash('Akun dengan email tersebut', 'sudah didaftarkan', 'danger');
            header('Location: ' . BASEURL . 'auth');
            exit;
        }
    }

    public function logout()
    {
        unset($_SESSION['email']);
        unset($_SESSION['role_id']);

        Flasher::setFlash('Logout', 'berhasil', 'success');
        header('Location: ' . BASEURL . 'auth');
        exit;
    }
}
