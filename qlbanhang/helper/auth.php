<?php
/**
 *  phân quyền
 */

// Kiểm tra user đã đăng nhập chưa
function isLoggedIn() {
    return isset($_SESSION['user_id']) && $_SESSION['user_id'];
}

// Kiểm tra user có phải admin không
function isAdmin() {
    return isLoggedIn() && $_SESSION['user_role'] === 'admin';
}

// Kiểm tra user có phải customer không  
function isCustomer() {
    return isLoggedIn() && $_SESSION['user_role'] === 'customer';
}

// Lấy thông tin user hiện tại
function getCurrentUser() {
    if (!isLoggedIn()) {
        return null;
    }
    
    return [
        'id' => $_SESSION['user_id'],
        'name' => $_SESSION['user_name'] ?? '',
        'role' => $_SESSION['user_role'] ?? ''
    ];
}

// Chuyển hướng nếu không có quyền
function requireAdmin($redirectUrl = '/qlbanhang/frontend.php') {
    if (!isAdmin()) {
        $_SESSION['error'] = 'Bạn không có quyền truy cập!';
        header("Location: $redirectUrl");
        exit;
    }
}

// Chuyển hướng nếu chưa đăng nhập
function requireLogin($redirectUrl = '/qlbanhang/frontend.php?action=login') {
    if (!isLoggedIn()) {
        $_SESSION['error'] = 'Vui lòng đăng nhập!';
        $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
        header("Location: $redirectUrl");
        exit;
    }
}
?>