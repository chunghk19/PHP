<?php
// Cấu hình cơ bản cho dự án
define('BASE_URL', '/qlbanhang');
define('SITE_NAME', 'TV Store - Cửa hàng bán tivi');

// Cấu hình database
define('DB_HOST', 'localhost');
define('DB_NAME', 'qlbanhang');
define('DB_USER', 'root');
define('DB_PASS', '');

// Báo lỗi trong môi trường development
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include database connection
require_once 'config/database.php';
