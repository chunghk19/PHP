<?php
require_once "config/database.php";
require_once "models/product.php";
require_once "models/category.php";
require_once "models/user.php";
require_once "models/order.php";

class FrontendController {
    private $productModel;
    private $categoryModel;
    private $userModel;
    private $orderModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->categoryModel = new Category();
        $this->userModel = new User();
        $this->orderModel = new Order();
    }

    // Trang chủ
    public function home() {
        $categories = $this->categoryModel->getAll();
        $featuredProducts = $this->productModel->getFeatured(8); // Lấy 8 sản phẩm nổi bật
        $newProducts = $this->productModel->getLatest(8); // Lấy 8 sản phẩm mới nhất
        
        include "views/frontend/pages/home.php";
    }

    // Trang sản phẩm
    public function products() {
        $categoryId = $_GET['category'] ?? null;
        $search = $_GET['search'] ?? null;
        $page = $_GET['page'] ?? 1;
        $limit = 12;
        
        $categories = $this->categoryModel->getAll();
        
        if ($categoryId) {
            $products = $this->productModel->getByCategory($categoryId, $page, $limit);
            $currentCategory = $this->categoryModel->getById($categoryId);
        } elseif ($search) {
            $products = $this->productModel->search($search, $page, $limit);
        } else {
            $products = $this->productModel->getAllWithPagination($page, $limit);
        }
        
        include "views/frontend/pages/products.php";
    }

    // Chi tiết sản phẩm
    public function productDetail() {
        $productId = $_GET['id'] ?? null;
        
        if (!$productId) {
            header('Location: /qlbanhang/index.php?page=products');
            exit;
        }
        
        $product = $this->productModel->getById($productId);
        if (!$product) {
            header('Location: /qlbanhang/index.php?page=products');
            exit;
        }
        
        $relatedProducts = $this->productModel->getByCategory($product['category_id'], 1, 4);
        
        include "views/frontend/pages/product-detail.php";
    }

    // Giỏ hàng
    public function cart() {
        include "views/frontend/pages/cart.php";
    }

    // Checkout
    public function checkout() {
        include "views/frontend/pages/checkout.php";
    }

    // Trang liên hệ
    public function contact() {
        include "views/frontend/pages/contact.php";
    }

    // Trang về chúng tôi
    public function about() {
        include "views/frontend/pages/about.php";
    }

    // Đăng nhập
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Xử lý đăng nhập
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            
            // Logic đăng nhập sẽ implement sau
            
        }
        include "views/frontend/pages/login.php";
    }

    // Đăng ký
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Xử lý đăng ký
            $userData = [
                'full_name' => $_POST['full_name'] ?? '',
                'user_name' => $_POST['user_name'] ?? '',
                'email' => $_POST['email'] ?? '',
                'password' => $_POST['password'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? '',
                'gender' => $_POST['gender'] ?? 'male',
                'role' => 'customer'
            ];
            
            // Logic đăng ký sẽ implement sau
            
        }
        include "views/frontend/pages/register.php";
    }

    // Tài khoản của tôi
    public function account() {
        // Kiểm tra đăng nhập
        include "views/frontend/pages/account.php";
    }
}
?>
