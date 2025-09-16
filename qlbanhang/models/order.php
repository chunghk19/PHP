<?php
class Order {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    // Lấy tất cả đơn hàng kèm thông tin khách hàng
    public function getAll() {
        $sql = "SELECT o.*, 
                COALESCE(o.customer_name, u.full_name) as customer_name,
                COALESCE(o.customer_phone, u.phone) as customer_phone, 
                COALESCE(o.customer_email, u.email) as customer_email,
                o.delivery_address, o.notes
                FROM orders o 
                LEFT JOIN users u ON o.user_id = u.id 
                ORDER BY o.order_date DESC";
        $result = $this->conn->query($sql);
        return $result->fetchAll();
    }

    // Lấy đơn hàng theo ID kèm thông tin chi tiết
    public function getById($id) {
        $sql = "SELECT o.*, 
                COALESCE(o.customer_name, u.full_name) as customer_name,
                COALESCE(o.customer_phone, u.phone) as customer_phone, 
                COALESCE(o.customer_email, u.email) as customer_email,
                o.delivery_address, o.notes
                FROM orders o 
                LEFT JOIN users u ON o.user_id = u.id 
                WHERE o.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Lấy chi tiết sản phẩm trong đơn hàng
    public function getOrderItems($order_id) {
        $sql = "SELECT oi.*, p.name as product_name, p.images 
                FROM order_items oi 
                LEFT JOIN products p ON oi.product_id = p.id 
                WHERE oi.order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$order_id]);
        return $stmt->fetchAll();
    }

    // Tạo đơn hàng mới
    public function create($user_id, $total_price, $status = 'pending') {
        $sql = "INSERT INTO orders (user_id, order_date, status, total_price) 
                VALUES (?, NOW(), ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id, $status, $total_price]);
        return $this->conn->lastInsertId();
    }

    // Tạo đơn hàng với thông tin khách hàng đầy đủ
    public function createWithCustomerInfo($user_id, $customer_name, $customer_phone, $customer_email, $delivery_address, $total_price, $notes = '', $status = 'Đã đặt hàng') {
        $sql = "INSERT INTO orders (user_id, customer_name, customer_phone, customer_email, delivery_address, notes, order_date, status, total_price) 
                VALUES (?, ?, ?, ?, ?, ?, NOW(), ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id, $customer_name, $customer_phone, $customer_email, $delivery_address, $notes, $status, $total_price]);
        return $this->conn->lastInsertId();
    }

    // Thêm sản phẩm vào đơn hàng
    public function addOrderItem($order_id, $product_id, $quantity, $price) {
        $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$order_id, $product_id, $quantity, $price]);
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus($id, $status) {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$status, $id]);
    }

    // Xóa đơn hàng (và chi tiết đơn hàng)
    public function delete($id) {
        // Xóa chi tiết đơn hàng trước
        $sql1 = "DELETE FROM order_items WHERE order_id = ?";
        $stmt1 = $this->conn->prepare($sql1);
        $stmt1->execute([$id]);
        
        // Xóa đơn hàng
        $sql2 = "DELETE FROM orders WHERE id = ?";
        $stmt2 = $this->conn->prepare($sql2);
        return $stmt2->execute([$id]);
    }

    // Thống kê đơn hàng theo trạng thái
    public function getStatsByStatus() {
        $sql = "SELECT status, COUNT(*) as count 
                FROM orders 
                GROUP BY status";
        $result = $this->conn->query($sql);
        return $result->fetchAll();
    }

    // Lấy doanh thu theo ngày/tháng
    public function getRevenue($period = 'today') {
        switch ($period) {
            case 'today':
                $sql = "SELECT SUM(total_price) as revenue 
                        FROM orders 
                        WHERE DATE(order_date) = CURDATE() 
                        AND status = 'completed'";
                break;
            case 'month':
                $sql = "SELECT SUM(total_price) as revenue 
                        FROM orders 
                        WHERE MONTH(order_date) = MONTH(CURDATE()) 
                        AND YEAR(order_date) = YEAR(CURDATE()) 
                        AND status = 'completed'";
                break;
            default:
                $sql = "SELECT SUM(total_price) as revenue 
                        FROM orders 
                        WHERE status = 'completed'";
        }
        $result = $this->conn->query($sql);
        $row = $result->fetch();
        return $row['revenue'] ?? 0;
    }
}
