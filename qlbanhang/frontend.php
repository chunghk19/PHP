<?php
// File frontend.php - Router chính cho giao diện khách hàng
session_start();

require_once "controllers/frontendController.php";

// Lấy tham số page từ URL
$page = $_GET['page'] ?? 'home';

// Khởi tạo controller
$controller = new FrontendController();

// Route các trang
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
        
    case 'login':
        $controller->login();
        break;
        
    case 'register':
        $controller->register();
        break;
        
    case 'account':
        $controller->account();
        break;
        
    default:
        $controller->home();
        break;
}
?>
