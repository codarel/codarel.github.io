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

    public function getAllDetailProductWithGroup()
    {
        $this->db->query('SELECT * FROM product_detail GROUP BY id');
        return $this->db->resultSet();
    }

    public function getDetailProductBySkuWithGroup($sku)
    {
        $this->db->query('SELECT * FROM product_detail GROUP BY id HAVING sku=:sku');
        $this->db->bind('sku', $sku);
        return $this->db->single();
    }

    public function getDetailProductBySku($sku)
    {
        $this->db->query('SELECT * FROM product_detail WHERE sku=:sku');
        $this->db->bind('sku', $sku);
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

    public function getStockById($id)
    {
        $this->db->query('SELECT * FROM stock WHERE id=:id');
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getStockByProductId($product_id)
    {
        $this->db->query('SELECT * FROM stock WHERE product_id=:product_id');
        $this->db->bind('product_id', $product_id);
        return $this->db->single();
    }

    public function getStockByProductIdAndSize($product_id, $size)
    {
        $this->db->query('SELECT * FROM stock WHERE product_id=:product_id AND size=:size');
        $this->db->bind('product_id', $product_id);
        $this->db->bind('size', $size);
        return $this->db->single();
    }

    public function getOrderByUserId($user_id)
    {
        $this->db->query('SELECT * FROM orders WHERE user_id=:user_id');
        $this->db->bind('user_id', $user_id);
        return $this->db->resultSet();
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

    public function updateStok($id)
    {
        $this->db->query("CALL update_stock(:id, :product_id, :size, :quantity)");
        $this->db->bind('id', $id);
        $this->db->bind('product_id', $_POST['product_id']);
        $this->db->bind('size', $_POST['size']);
        $this->db->bind('quantity', $_POST['quantity']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function deleteStock($id)
    {
        $this->db->query('DELETE FROM stock WHERE id = :id');
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function addToCart($user_id, $product_id)
    {
        date_default_timezone_set("Asia/Jakarta");
        $this->db->query('INSERT INTO cart (user_id, product_id, size, quantity, created_at) VALUES (:user_id, :product_id, :size, :quantity, :created_at)');
        $this->db->bind('user_id', $user_id);
        $this->db->bind('product_id', $product_id);
        $this->db->bind('size', $_POST['size']);
        $this->db->bind('quantity', $_POST['quant'][1]);
        $this->db->bind('created_at', date("Y-m-d H:i:s"));
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function addOrder($user_id)
    {
        $id = uniqid();
        $this->db->query('CALL add_order(:id, :user_id, :shipping, :amount, :address)');
        $this->db->bind('id', $id);
        $this->db->bind('user_id', $user_id);
        $this->db->bind('shipping', $_POST['shipping']);
        $this->db->bind('amount', $_POST['amount']);
        $this->db->bind('address', $_POST['address']);
        $this->db->execute();

        return $id;
    }

    public function addOrderItems($order_id)
    {
        $count = count($_POST['quantity']);
        for ($i = 0; $i < $count; $i++) {
            $this->db->query('INSERT INTO order_items (order_id, product_id, size, quantity, subtotal) VALUES (:order_id, :product_id, :size, :quantity, :subtotal)');
            $this->db->bind('order_id', $order_id);
            $this->db->bind('product_id', $_POST['product_id'][$i]);
            $this->db->bind('size', $_POST['size'][$i]);
            $this->db->bind('quantity', $_POST['quantity'][$i]);
            $this->db->bind('subtotal', $_POST['subtotal'][$i]);
            $this->db->execute();
        }

        return $this->db->rowCount();
    }

    public function deleteAllItemCart($user_id)
    {
        $this->db->query('DELETE FROM cart WHERE user_id = :user_id');
        $this->db->bind('user_id', $user_id);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
