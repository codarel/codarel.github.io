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

    public function getAllDetailProduct()
    {
        $this->db->query('SELECT * FROM product_detail');
        return $this->db->resultSet();
    }

    public function getAllStock()
    {
        $this->db->query('SELECT * FROM stock');
        return $this->db->resultSet();
    }

    public function getProductById($id)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getProductBySku($sku)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE sku=:sku');
        $this->db->bind('sku', $sku);
        return $this->db->single();
    }

    public function getStockByProductIdAndSize($product_id, $size)
    {
        $this->db->query('SELECT * FROM stock WHERE product_id=:product_id AND size=:size');
        $this->db->bind('product_id', $product_id);
        $this->db->bind('size', $size);
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

    public function updateProduct($id, $data)
    {
        if ($data != false) {
            $this->db->query("CALL update_product(:id, :sku, :name, :description, :product_image, :regular_price, :discount_price, :weight, :category)");
            $this->db->bind('id', $id);
            $this->db->bind('sku', $_POST['sku']);
            $this->db->bind('name', $_POST['name']);
            $this->db->bind('description', $_POST['description']);
            $this->db->bind('product_image', $data);
            $this->db->bind('regular_price', $_POST['regular']);
            $this->db->bind('discount_price', $_POST['discount']);
            $this->db->bind('weight', $_POST['weight']);
            $this->db->bind('category', $_POST['category']);
            $this->db->execute();

            return $this->db->rowCount();
        } else {
            header('Location: ' . BASEURL . 'admin/edit/' . $id);
        }
    }

    public function addStok()
    {
        $this->db->query("CALL add_stock(:product_id, :size, :quantity)");
        $this->db->bind('product_id', $_POST['product_id']);
        $this->db->bind('size', $_POST['size']);
        $this->db->bind('quantity', $_POST['quantity']);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
