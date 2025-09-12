<?php
require_once "models/order.php";
require_once "models/product.php";

class OrderController {
    private $orderModel;
    private $productModel;

    public function __construct() {
        $this->orderModel = new Order();
        $this->productModel = new Product();
    }

    // Hiển thị danh sách đơn hàng
    public function index() {
        $orders = $this->orderModel->getAll();
        include "views/orders/index.php";
    }

    // Xem chi tiết đơn hàng
    public function view() {
        $id = $_GET['id'] ?? 0;
        $order = $this->orderModel->getById($id);
        $orderItems = $this->orderModel->getOrderItems($id);
        include "views/orders/view.php";
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus() {
        $id = $_POST['id'] ?? 0;
        $status = $_POST['status'] ?? '';
        
        if ($this->orderModel->updateStatus($id, $status)) {
            header('Location: ' . BASE_URL . '/admin.php?page=orders&action=view&id=' . $id);
        }
        exit;
    }

    // Xóa đơn hàng
    public function delete() {
        $id = $_GET['id'] ?? 0;
        if ($this->orderModel->delete($id)) {
            header('Location: ' . BASE_URL . '/admin.php?page=orders&action=index');
        }
        exit;
    }

    // Thống kê đơn hàng
    public function stats() {
        $statusStats = $this->orderModel->getStatsByStatus();
        $revenueToday = $this->orderModel->getRevenue('today');
        $revenueMonth = $this->orderModel->getRevenue('month');
        include "views/orders/stats.php";
    }
}
