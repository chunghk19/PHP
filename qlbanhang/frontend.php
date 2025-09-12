<?php
// File frontend.php - Router chính cho giao diện khách hàng
session_start();

// Include database config first
require_once "config/database.php";
require_once "controllers/frontendController.php";
require_once "controllers/authController.php";

// Lấy tham số page và action từ URL
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? '';

// Khởi tạo controllers
$controller = new FrontendController();
$authController = new AuthController();

// Ưu tiên xử lý authentication trước
if (!empty($action)) {
    switch ($action) {
        case 'login':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $authController->login();
            } else {
                $authController->showLogin();
            }
            exit; // Dừng xử lý để không chạy page routes
            
        case 'register':
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $authController->register();
            } else {
                $authController->showRegister();
            }
            exit; // Dừng xử lý để không chạy page routes
            
        case 'logout':
            $authController->logout();
            exit; // Dừng xử lý để không chạy page routes
    }
}

// Route các trang chính
switch ($page) {
    case 'home':
        $controller->home();
        break;
        
    case 'products':
        $controller->products();
        break;
        
    case 'product-detail':
        $controller->productDetail();
        break;
        
    case 'cart':
        $controller->cart();
        break;
        
    case 'checkout':
        $controller->checkout();
        break;
        
    case 'contact':
        $controller->contact();
        break;
        
    case 'about':
        $controller->about();
        break;
        
    default:
        $controller->home();
        break;
}
?>
