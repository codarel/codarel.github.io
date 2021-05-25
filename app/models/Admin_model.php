<?php

class Admin_model
{
    private $table = 'products';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllProduct()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getProductById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function deleteProduct($id)
    {
        $this->db->query('SET foreign_key_checks = 0');
        $this->db->execute();
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function addProduct()
    {
        $file = $_FILES['product_image'];
        $data = Uploader::upload($file);
        if ($data != false) {
            $this->db->query("CALL add_product(:sku, :name, :description, :product_image, :regular_price, :discount_price, :weight, :category)");
            $this->db->bind('sku', $_POST['sku']);
            $this->db->bind('name', $_POST['name']);
            $this->db->bind('description', $_POST['description']);
            $this->db->bind('product_image', join(",", $data));
            $this->db->bind('regular_price', $_POST['regular']);
            $this->db->bind('discount_price', $_POST['discount']);
            $this->db->bind('weight', $_POST['weight']);
            $this->db->bind('category', $_POST['category']);
            $this->db->execute();

            return $this->db->rowCount();
        } else {
            header('Location: ' . BASEURL . 'admin/create');
        }
    }
}
