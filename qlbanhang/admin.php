<?php
// Bắt đầu session
session_start();

// Include helper functions
require_once "helper/auth.php";

// MIDDLEWARE BẢO MẬT - Kiểm tra quyền truy cập admin
function checkAdminAccess() {
    // Kiểm tra đăng nhập
    if (!isLoggedIn()) {
        $_SESSION['error'] = 'Vui lòng đăng nhập để truy cập trang quản trị!';
        header('Location: /qlbanhang/frontend.php?action=login');
        exit;
    }
    
    // Kiểm tra quyền admin
    if (!isAdmin()) {
        $_SESSION['error'] = 'Bạn không có quyền truy cập trang quản trị!';
        header('Location: /qlbanhang/frontend.php');
        exit;
    }
}

// Áp dụng middleware cho tất cả requests (trừ login)
$action = $_GET['action'] ?? 'index';
if ($action !== 'login') {
    checkAdminAccess();
}

require_once "controllers/dashboardController.php";
require_once "controllers/categoryController.php";
require_once "controllers/productController.php";
require_once "controllers/orderController.php";
require_once "controllers/userController.php";
require_once "controllers/authController.php";

// Tham số truy vấn lần 1 trên url (?page=...)
$page = $_GET['page'] ?? 'dashboard';

// Khởi tạo biến controller
$controller = null;

// Kiểm tra tham số truy vấn lần 1 
switch ($page) {
    case 'dashboard':
        // Gọi đối tượng controller vào
        $controller = new dashboardController();

        // Kiểm tra tham số truy vấn lần 2
        switch ($action) {
            case 'index':
                // Gọi phương thức ra bên ngoài
                $controller->index();
                break;

            default:
                echo "Action không tồn tại!";
        }
        break;

    case 'categories':
        $controller = new CategoryController();
        
        switch ($action) {
            case 'index':
                //lấy dữ liệu
                $controller->index();
                break;

            case 'create':
                //tạo mới và xử lý lưu dữ liệu
                $controller->create();
                break;

            case 'edit':
                //sửa dữ liệu
                $controller->edit();
                break;

            case 'delete':
                //xóa dữ liệu
                $controller->delete();
                break;

            default:
                echo "Action không tồn tại!";
        }
        break;

    case 'products':
        $controller = new ProductController();
        
        switch ($action) {
            case 'index':
                $controller->index();
                break;

            case 'create':
                $controller->create();
                break;

            case 'edit':
                $controller->edit();
                break;

            case 'delete':
                $controller->delete();
                break;

            default:
                echo "Action không tồn tại!";
        }
        break;

    case 'orders':
        $controller = new OrderController();
        
        switch ($action) {
            case 'index':
                $controller->index();
                break;

            case 'view':
                $controller->view();
                break;

            case 'updateStatus':
                $controller->updateStatus();
                break;

            case 'delete':
                $controller->delete();
                break;

            case 'stats':
                $controller->stats();
                break;

            default:
                echo "Action không tồn tại!";
        }
        break;

    case 'users':
        $controller = new UserController();
        
        switch ($action) {
            case 'index':
                $controller->index();
                break;

            case 'edit':
                $controller->edit();
                break;

            case 'view':
                $controller->view();
                break;

            case 'delete':
                $controller->delete();
                break;

            default:
                echo "Action không tồn tại!";
        }
        break;


    case 'auth':
        $controller = new AuthController();
        
        switch ($action) {
            case 'login':
                $controller->login();
                break;

            case 'logout':
                $controller->logout();
                break;
            default:
                echo "Action không tồn tại!";
        }
        break;

    default:
        echo "404 trang không tìm thấy";
}