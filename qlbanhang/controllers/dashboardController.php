<?php
// Include config first (contains database constants)
require_once "config.php";

class dashboardController{
    public function index(){
        try {
            $database = Database::connect();
            
            // Lấy dữ liệu thống kê từ database
            $stats = $this->getDashboardStats($database);
            
        } catch (Exception $e) {
            // nếu lỗi thì sử dụng giá trị 0
            $stats = [
                'orders_today' => 0,
                'revenue_today' => 0,
                'revenue_month' => 0,
                'visitors' => 0
            ];
        }

        include "views/admin/dashboard.php";
    }
    
    private function getDashboardStats($database) {
        $stats = [];
        
        // Đếm đơn hàng hôm nay
        $stmt = $database->prepare("SELECT COUNT(*) as count FROM orders WHERE DATE(order_date) = CURDATE()");
        $stmt->execute();
        $stats['orders_today'] = $stmt->fetch()['count'];
        
        // Tính doanh thu hôm nay
        $stmt = $database->prepare("SELECT SUM(total_price) as total FROM orders WHERE DATE(order_date) = CURDATE()");
        $stmt->execute();
        $stats['revenue_today'] = $stmt->fetch()['total'] ?? 0;
        
        // Tính doanh thu tháng này
        $stmt = $database->prepare("SELECT SUM(total_price) as total FROM orders WHERE MONTH(order_date) = MONTH(CURDATE()) AND YEAR(order_date) = YEAR(CURDATE())");
        $stmt->execute();
        $stats['revenue_month'] = $stmt->fetch()['total'] ?? 0;
        
        // Lượt truy cập (tạm thời random)
        $stats['visitors'] = rand(800, 1500);
        
        return $stats;
    }
}