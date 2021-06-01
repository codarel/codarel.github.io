<?php

class User_model
{
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

    public function getDetailCartByEmail($email)
    {
        $this->db->query('SELECT * FROM users WHERE email=:email');
        $this->db->bind('email', $email);
        $this->db->execute();
        $user_id = $this->db->single();
        $this->db->query('SELECT * FROM cart_detail WHERE user_id=:user_id');
        $this->db->bind('user_id', $user_id['id']);
        $this->db->execute();

        return $this->db->resultSet();
    }

    public function addPayment($image)
    {
        $this->db->query('CALL add_payment(:email, :order_id, :sender_name, :amount, :payment_image)');
        $this->db->bind('email', $_POST['email']);
        $this->db->bind('order_id', $_POST['orderid']);
        $this->db->bind('sender_name', $_POST['sender']);
        $this->db->bind('amount', $_POST['amount']);
        $this->db->bind('payment_image', $image);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function addAddress($user_id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $this->db->query('INSERT INTO user_address (user_id, fullname, street_name, province, city, districts, postcode, phone, created_at) VALUES (:user_id, :fullname, :street_name, :province, :city, :districts, :postcode, :phone, :created_at)');
        $this->db->bind('user_id', $user_id);
        $this->db->bind('fullname', $_POST['fullname']);
        $this->db->bind('street_name', $_POST['street_name']);
        $this->db->bind('province', $_POST['province']);
        $this->db->bind('city', $_POST['city']);
        $this->db->bind('districts', $_POST['districts']);
        $this->db->bind('postcode', $_POST['postcode']);
        $this->db->bind('phone', $_POST['phone']);
        $this->db->bind('created_at', date("Y-m-d H:i:s"));
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getAddressByUserId($user_id)
    {
        $this->db->query('SELECT * FROM user_address WHERE user_id=:user_id');
        $this->db->bind('user_id', $user_id);
        return $this->db->resultSet();
    }
}
