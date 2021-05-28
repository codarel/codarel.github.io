<?php

class User_model
{
    private $nama = 'Huda';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUser()
    {
        return $this->nama;
    }

    public function getDiscount($id)
    {
        $this->db->query('SELECT percentage_discount(:id)');
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->single();
    }

    public function getCartByUserProductAndSize($user_id, $product_id, $size)
    {
        $this->db->query('SELECT * FROM cart WHERE user_id=:user_id AND product_id=:product_id AND size=:size');
        $this->db->bind('user_id', $user_id);
        $this->db->bind('product_id', $product_id);
        $this->db->bind('size', $size);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getCountCartByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind('email', $email);
        $this->db->execute();
        $user_id = $this->db->single();
        $this->db->query('SELECT * FROM cart WHERE user_id=:user_id');
        $this->db->bind('user_id', $user_id['id']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getCartByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind('email', $email);
        $this->db->execute();
        $user_id = $this->db->single();
        $this->db->query('SELECT * FROM cart WHERE user_id=:user_id');
        $this->db->bind('user_id', $user_id['id']);
        $this->db->execute();

        return $this->db->resultSet();
    }
}
