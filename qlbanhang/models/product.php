<?php
class Product {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    // Lấy tất cả sản phẩm kèm tên danh mục
    public function getAll() {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                ORDER BY p.id DESC";
        $result = $this->conn->query($sql);
        return $result->fetchAll();
    }

    // Lấy sản phẩm theo ID
    public function getById($id) {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Thêm sản phẩm mới
    public function create($name, $category_id, $price, $description, $image) {
        $sql = "INSERT INTO products (name, category_id, price, description, images) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $category_id, $price, $description, $image]);
    }

    // Cập nhật sản phẩm
    public function update($id, $name, $category_id, $price, $description, $image = null) {
        if ($image) {
            $sql = "UPDATE products 
                    SET name = ?, category_id = ?, price = ?, description = ?, images = ? 
                    WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$name, $category_id, $price, $description, $image, $id]);
        } else {
            $sql = "UPDATE products 
                    SET name = ?, category_id = ?, price = ?, description = ? 
                    WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$name, $category_id, $price, $description, $id]);
        }
    }

    // Xóa sản phẩm
    public function delete($id) {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Lấy sản phẩm theo danh mục
    public function getByCategory($category_id, $page = 1, $limit = 12) {
        $offset = ($page - 1) * $limit;
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.category_id = ? 
                ORDER BY p.id DESC 
                LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$category_id]);
        return $stmt->fetchAll();
    }

    // Lấy sản phẩm nổi bật
    public function getFeatured($limit = 8) {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                ORDER BY p.id DESC 
                LIMIT " . (int)$limit;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Lấy sản phẩm mới nhất
    public function getLatest($limit = 8) {
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                ORDER BY p.id DESC 
                LIMIT " . (int)$limit;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Tìm kiếm sản phẩm
    public function search($keyword, $page = 1, $limit = 12) {
        $offset = ($page - 1) * $limit;
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.name LIKE ? OR p.description LIKE ? 
                ORDER BY p.id DESC 
                LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        $stmt = $this->conn->prepare($sql);
        $searchTerm = "%$keyword%";
        $stmt->execute([$searchTerm, $searchTerm]);
        return $stmt->fetchAll();
    }

    // Lấy sản phẩm với phân trang cho frontend
    public function getAllWithPagination($page = 1, $limit = 12) {
        $offset = ($page - 1) * $limit;
        $sql = "SELECT p.*, c.name as category_name 
                FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                ORDER BY p.id DESC 
                LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
