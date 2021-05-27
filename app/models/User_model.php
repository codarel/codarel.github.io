<?php

class User_model
{
    private $nama = 'Huda';

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
}
