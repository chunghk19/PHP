<?php
// Database class đã được include từ config.php

class Category{
    private $model;
    public function __construct(){
        $this->model = Database::connect();
    }
    //lấy tất cả bản ghi
    public function getAll(){
        $result = $this->model->query("SELECT * FROM categories ORDER BY id ASC");
        return $result->fetchAll();
    }
    //lấy bản ghi theo id
    public function getById($id){
        $sql = "SELECT * FROM categories WHERE id = ?";
        $result = $this->model->prepare($sql);
        $result->execute([$id]);
        return $result->fetch();
        
    }
    //lưu bản ghi
    public function store($name, $description){
        $sql = "INSERT INTO categories (name, description) VALUES (?, ?)";
        $result = $this->model->prepare($sql);
        return $result->execute([$name, $description]);
    }
    //cập nhật bản ghi theo id
    public function update($id, $name, $description){
        $sql = "UPDATE categories SET name = ?, description = ? WHERE id = ?";
        $result = $this->model->prepare($sql);  
        return $result->execute([$name, $description, $id]);

    }
    //xoá bản ghi theo id
    public function delete($id = 0){
        $sql = "DELETE FROM categories WHERE id = ?";
        $result = $this->model->prepare($sql);
        return $result->execute([$id]);
    }
}