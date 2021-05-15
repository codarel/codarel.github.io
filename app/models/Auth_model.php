<?php

class Auth_model
{
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllUser()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function _login()
    {
        $username = $_POST["email"];
        $password = $_POST["password"];
        var_dump($username, $password);
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE email=:username');
        $this->db->bind('username', $username);
        $user = $this->db->single();

        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $_SESSION = $data;
                    Flasher::setFlash('Login', 'berhasil', 'success');
                    if ($user['role_id'] == 1) {
                        header('Location: ' . BASEURL . 'admin');
                        exit;
                    } else {
                        header('Location: ' . BASEURL);
                        exit;
                    }
                } else {
                    Flasher::setFlash('Login gagal,', 'password salah', 'danger');
                    header('Location: ' . BASEURL . 'auth');
                }
            } else {
                Flasher::setFlash('Login gagal,', 'akun belum diaktifkan', 'danger');
                header('Location: ' . BASEURL . 'auth');
            }
        } else {
            Flasher::setFlash('Login gagal,', 'akun belum terdaftar', 'danger');
            header('Location: ' . BASEURL . 'auth');
        }
    }

    public function createUser($data)
    {
        date_default_timezone_set("Asia/Jakarta");
        $query = "INSERT INTO users
                    VALUES
                    ('', :role_id, :email, :username, :fullname, :date_of_birth, :phone, :user_image, :password, :active, :created_at, :updated_at, :deleted_at)";

        $this->db->query($query);
        $this->db->bind('role_id', 2);
        $this->db->bind('email', $data['email']);
        $this->db->bind('username', null);
        $this->db->bind('fullname', null);
        $this->db->bind('date_of_birth', null);
        $this->db->bind('phone', null);
        $this->db->bind('user_image', 'default.jpg');
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind('active', 1);
        $this->db->bind('created_at', date("Y-m-d H:i:s"));
        $this->db->bind('updated_at', null);
        $this->db->bind('deleted_at', null);

        $this->db->execute();

        return $this->db->rowCount();
    }
}
