<?php
// Load cấu hình constants
require_once __DIR__ . '/../config.php';

// Khai báo Lớp
class Database
{
    // khởi tạo phương thức
    public static function connect()
    {
        $host = DB_HOST;    
        $dbname = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

            // Cấu hình để PDO báo lỗi (nếu có)
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Cấu hình dữ liệu mảng trả về dạng gọn gàng (associative array)
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            // Trả về đối tượng PDO
            return $pdo;
        } catch (PDOException $e) {
            // Hiển thị thông báo lỗi
            throw new Exception("❌ Lỗi kết nối DB: " . $e->getMessage());
        }
    }
}

//Kiểm tra kết nối thành công hay không
//$database = Database::connect();
