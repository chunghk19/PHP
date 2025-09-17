<?php
require_once "models/user.php";

class AuthController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Hiển thị form đăng nhập
    public function showLogin() {
        $title = 'Đăng nhập - TV Store';
        include "views/frontend/auth/login.php";
    }

    // Xử lý đăng nhập
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $emailOrUsername = trim($_POST['email_username'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($emailOrUsername) || empty($password)) {
                $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin!';
                header('Location: /qlbanhang/index.php?action=login');
                exit;
            }

            $user = $this->userModel->login($emailOrUsername, $password);
            
            if ($user && in_array($user['role'], ['customer', 'admin'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['full_name'];
                $_SESSION['user_role'] = $user['role'];
                $_SESSION['success'] = 'Đăng nhập thành công!';
                
                // Load giỏ hàng từ database vào session
                require_once 'controllers/cartController.php';
                $cartController = new CartController();
                $cartController->loadCartFromDatabase($user['id']);
                
                // Redirect về trang trước đó hoặc trang chủ
                $redirect = $_SESSION['redirect_after_login'] ?? '/qlbanhang/index.php';
                unset($_SESSION['redirect_after_login']);
                header("Location: $redirect");
                exit;
            } else {
                $_SESSION['error'] = 'Thông tin đăng nhập không chính xác!';
                header('Location: /qlbanhang/index.php?action=login');
                exit;
            }
        }
    }

    // Hiển thị form đăng ký
    public function showRegister() {
        $title = 'Đăng ký - TV Store';
        include "views/frontend/auth/register.php";
    }

    // Xử lý đăng ký
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $full_name = trim($_POST['full_name'] ?? '');
            $user_name = trim($_POST['user_name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm_password = $_POST['confirm_password'] ?? '';
            $phone = trim($_POST['phone'] ?? '');
            $gender = $_POST['gender'] ?? 'male';

            // Validation
            if (empty($full_name) || empty($user_name) || empty($email) || empty($password)) {
                $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin bắt buộc!';
                header('Location: /qlbanhang/index.php?action=register');
                exit;
            }

            if ($password !== $confirm_password) {
                $_SESSION['error'] = 'Mật khẩu xác nhận không khớp!';
                header('Location: /qlbanhang/index.php?action=register');
                exit;
            }

            if (strlen($password) < 6) {
                $_SESSION['error'] = 'Mật khẩu phải có ít nhất 6 ký tự!';
                header('Location: /qlbanhang/index.php?action=register');
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'Email không hợp lệ!';
                header('Location: /qlbanhang/index.php?action=register');
                exit;
            }

            // Thực hiện đăng ký
            $result = $this->userModel->register($full_name, $user_name, $password, $phone, $email, $gender);
            
            if ($result) {
                $_SESSION['success'] = 'Đăng ký thành công! Vui lòng đăng nhập.';
                header('Location: /qlbanhang/index.php?action=login');
                exit;
            } else {
                $_SESSION['error'] = 'Email hoặc tên đăng nhập đã tồn tại!';
                header('Location: /qlbanhang/index.php?action=register');
                exit;
            }
        }
    }

    // Đăng xuất
    public function logout() {
        $_SESSION['success'] = 'Đăng xuất thành công!';
        session_destroy();
        session_start();
        $_SESSION['success'] = 'Đăng xuất thành công!';
        header('Location: /qlbanhang/index.php');
        exit;
    }

    // Kiểm tra đăng nhập
    public function isLoggedIn() {
        return isset($_SESSION['user_id']) && isset($_SESSION['user_role']);
    }

    // Lấy thông tin user hiện tại
    public function getCurrentUser() {
        if ($this->isLoggedIn()) {
            return $this->userModel->getById($_SESSION['user_id']);
        }
        return null;
    }

    // Refresh session data (useful after role changes)
    public function refreshSession() {
        if ($this->isLoggedIn()) {
            $user = $this->userModel->getById($_SESSION['user_id']);
            if ($user) {
                $_SESSION['user_name'] = $user['full_name'];
                $_SESSION['user_role'] = $user['role'];
                return true;
            }
        }
        return false;
    }

    // Yêu cầu đăng nhập
    public function requireLogin() {
        if (!$this->isLoggedIn()) {
            $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            $_SESSION['error'] = 'Vui lòng đăng nhập để tiếp tục!';
            header('Location: /qlbanhang/index.php?action=login');
            exit;
        }
    }
}
