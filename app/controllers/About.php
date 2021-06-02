<?php

class About extends Controller
{
    public function index($nama = 'Huda', $pekerjaan = 'Mahasiswa', $umur = 19)
    {
        if (isset($_SESSION['email'])) {
            $data['ccart'] = $this->model("User_model")->getCountCartByEmail($_SESSION['email']);
        }
        $data['nama'] = $nama;
        $data['pekerjaan'] = $pekerjaan;
        $data['umur'] = $umur;
        $data['judul'] = 'About Me';
        $this->view('templates/header', $data);
        $this->view('about/index', $data);
        $this->view('templates/footer');
    }

    public function contact()
    {
        if (isset($_SESSION['email'])) {
            $data['ccart'] = $this->model("User_model")->getCountCartByEmail($_SESSION['email']);
        }
        $data['judul'] = 'Contact Us';
        $this->view('templates/header', $data);
        $this->view('about/contact');
        $this->view('templates/footer');
    }
}
