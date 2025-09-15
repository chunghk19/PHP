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

    // Xử lý đặt hàng từ frontend
    public function placeOrder() {
        header('Content-Type: application/json; charset=utf-8');
        
        try {
            // Lấy dữ liệu từ POST
            $customerName = $_POST['customer_name'] ?? '';
            $customerPhone = $_POST['customer_phone'] ?? '';
            $customerEmail = $_POST['customer_email'] ?? '';
            $deliveryAddress = $_POST['delivery_address'] ?? '';
            $notes = $_POST['notes'] ?? '';

            // Kiểm tra thông tin bắt buộc
            if (empty($customerName) || empty($customerPhone) || empty($customerEmail) || empty($deliveryAddress)) {
                throw new Exception('Vui lòng điền đầy đủ thông tin giao hàng!');
            }

            // Kiểm tra giỏ hàng
            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                throw new Exception('Giỏ hàng trống!');
            }

            $cart = $_SESSION['cart'];
            $totalPrice = 0;

            // Tính tổng tiền và kiểm tra sản phẩm
            foreach ($cart as $productId => $item) {
                $product = $this->productModel->getById($productId);
                if (!$product) {
                    throw new Exception("Sản phẩm không tồn tại: ID $productId");
                }
                $totalPrice += $product['price'] * $item['quantity'];
            }

            // Bắt đầu transaction để đảm bảo tính toàn vẹn dữ liệu
            $conn = Database::connect();
            $conn->exec("SET TRANSACTION ISOLATION LEVEL READ COMMITTED");
            $conn->beginTransaction();

            try {
                // Tạo đơn hàng
                $userId = $_SESSION['user_id'] ?? null;
                
                $orderId = $this->orderModel->createWithCustomerInfo(
                    $userId,
                    $customerName,
                    $customerPhone,
                    $customerEmail,
                    $deliveryAddress,
                    $totalPrice,
                    $notes
                );

                if (!$orderId) {
                    throw new Exception('Không thể tạo đơn hàng!');
                }

                // Thêm các sản phẩm vào đơn hàng
                foreach ($cart as $productId => $item) {
                    $product = $this->productModel->getById($productId);
                    
                    $success = $this->orderModel->addOrderItem(
                        $orderId,
                        $productId,
                        $item['quantity'],
                        $product['price']
                    );
                    
                    if (!$success) {
                        throw new Exception("Không thể thêm sản phẩm vào đơn hàng: " . $product['name']);
                    }
                }

                // Commit transaction
                $conn->commit();

                // Xóa giỏ hàng sau khi đặt hàng thành công
                unset($_SESSION['cart']);
                
                // Nếu user đã login, xóa giỏ hàng database
                if (isset($_SESSION['user_id'])) {
                    require_once 'models/cart.php';
                    $cartModel = new Cart();
                    $cartModel->clearCart($_SESSION['user_id']);
                }

                // Trả về kết quả thành công
                echo json_encode([
                    'success' => true,
                    'message' => 'Đặt hàng thành công! Mã đơn hàng: #' . $orderId,
                    'order_id' => $orderId
                ]);

            } catch (Exception $e) {
                // Rollback nếu có lỗi
                $conn->rollBack();
                throw $e;
            }

        } catch (Exception $e) {
            echo json_encode([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }
        exit;
    }
}
