<?php
require_once "models/product.php";
require_once "models/category.php";

class ProductController {
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
    }

    // Hiển thị danh sách sản phẩm
    public function index() {
        $products = $this->productModel->getAll();
        include "views/products/index.php";
    }

    // Hiển thị form thêm sản phẩm
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $categories = $this->categoryModel->getAll();
            include "views/products/create.php";
        } else {
            // Xử lý upload ảnh
            $image = '';
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "public/uploads/products/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $image = time() . '_' . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image);
            }

            // Thêm sản phẩm mới
            $name = $_POST['name'];
            $category_id = $_POST['category_id'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            if ($this->productModel->create($name, $category_id, $price, $description, $image)) {
                header('Location: ' . BASE_URL . '/admin.php?page=products&action=index');
            } else {
                header('Location: ' . BASE_URL . '/admin.php?page=products&action=create');
            }
            exit;
        }
    }

    // Hiển thị form sửa sản phẩm
    public function edit() {
        $id = $_GET['id'] ?? 0;
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $product = $this->productModel->getById($id);
            $categories = $this->categoryModel->getAll();
            include "views/products/edit.php";
        } else {
            // Xử lý upload ảnh mới (nếu có)
            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "public/uploads/products/";
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }
                $image = time() . '_' . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $image);
            }

            // Cập nhật sản phẩm
            $name = $_POST['name'];
            $category_id = $_POST['category_id'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            if ($this->productModel->update($id, $name, $category_id, $price, $description, $image)) {
                header('Location: ' . BASE_URL . '/admin.php?page=products&action=index');
            } else {
                header('Location: ' . BASE_URL . '/admin.php?page=products&action=edit&id=' . $id);
            }
            exit;
        }
    }

    // Xóa sản phẩm
    public function delete() {
        $id = $_GET['id'] ?? 0;
        if ($this->productModel->delete($id)) {
            header('Location: ' . BASE_URL . '/admin.php?page=products&action=index');
        }
        exit;
    }
}
