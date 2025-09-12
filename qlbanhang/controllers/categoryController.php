<?php
// Include Category model
require_once "models/category.php";

class CategoryController{

    private $categoryModel;

    public function __construct(){
        $this->categoryModel = new Category();
    }

    public function index(){
        // Lấy danh sách tất cả danh mục
        $categories = $this->categoryModel->getAll();
        include "views/categories/index.php";
    }

    public function create(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Xử lý lưu dữ liệu
            $name = $_POST['name'];
            $description = $_POST['description'];

            $result = $this->categoryModel->store($name, $description);

            if ($result){
                echo "Thêm mới thành công
                <a href='./admin.php?page=categories&action=index'>Danh sách</a>";
                die;
            }
        }
        include "views/categories/create.php";
    }

    public function edit(){
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // update dữ liệu
            $name = $_POST['name'];
            $description = $_POST['description'];

            $result = $this->categoryModel->update($id, $name, $description);

            if ($result) {
                // cập nhật thành công
                echo "Cập nhật thành công
                <a href='./admin.php?page=categories&action=index'>Danh sách</a>";
                die;
            } else {
                echo "Cập nhật thất bại!";
        }
        } else {
            //hiện giao diện chỉnh sửa
            $category = $this->categoryModel->getById($id);

            if (!$category) {
                echo "Không tìm thấy danh mục!";
                return;
        }
        include "views/categories/edit.php";
    }
}


    public function delete(){
        $id = $_GET['id'] ?? 0;
        $result = $this->categoryModel->delete($id);
        if ($result){
            echo "Xóa thành công
            <a href='./admin.php?page=categories&action=index'>Danh sách</a>";
            die;
        }   
    }
}