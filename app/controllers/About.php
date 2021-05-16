<?php

class About extends Controller
{
    public function index($nama = 'Huda', $pekerjaan = 'Mahasiswa', $umur = 19)
    {
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
        $data['judul'] = 'Contact Us';
        $this->view('templates/header', $data);
        $this->view('about/contact');
        $this->view('templates/footer');
    }
}
