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
        $title = 'Trang chủ - TV Store';
        $categories = $this->categoryModel->getAll();
        $featuredProducts = $this->productModel->getFeatured(8); // Lấy 8 sản phẩm nổi bật
        $newProducts = $this->productModel->getLatest(8); // Lấy 8 sản phẩm mới nhất
        
        // Bạn có thể chọn sử dụng layout hoặc file riêng
        include "views/frontend/pages/home.php";
        // Hoặc sử dụng layout: $this->loadView('home', compact('title', 'categories', 'featuredProducts', 'newProducts'));
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
        
        // Lấy tất cả categories cho navigation
        $categories = $this->categoryModel->getAll();
        
        $title = htmlspecialchars($product['name']) . ' - TV Store';
        
        include "views/frontend/pages/product.php";
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

    // Trang cửa hàng với filtering
    public function store() {
        // Lấy filter parameters từ URL
        $selectedCategories = isset($_GET['categories']) ? explode(',', $_GET['categories']) : [];
        $sortBy = isset($_GET['sort']) ? $_GET['sort'] : '';
        
        // Lấy tất cả sản phẩm để tính toán filter counts
        $allProducts = $this->productModel->getAllWithCategories();
        
        // Filter sản phẩm theo category
        $products = $allProducts;
        
        if (!empty($selectedCategories)) {
            $products = array_filter($products, function($product) use ($selectedCategories) {
                return in_array($product['category_name'], $selectedCategories);
            });
            // Reset array keys after filtering
            $products = array_values($products);
        }
        
        // Sắp xếp sản phẩm theo giá
        if ($sortBy === 'price_asc') {
            usort($products, function($a, $b) {
                return $a['price'] - $b['price'];
            });
        } elseif ($sortBy === 'price_desc') {
            usort($products, function($a, $b) {
                return $b['price'] - $a['price'];
            });
        }
        
        // Lấy tất cả categories cho navigation
        $categories = $this->categoryModel->getAll();
        
        $title = 'Tất cả sản phẩm - TV Store';
        
        // Make sure variables are available to the view
        $authController = new AuthController();
        
        include "views/frontend/pages/store.php";
    }

    // Tài khoản của tôi
    public function account() {
        // Kiểm tra đăng nhập
        include "views/frontend/pages/account.php";
    }
}
?>
