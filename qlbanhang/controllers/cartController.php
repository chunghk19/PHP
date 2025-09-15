<?php
class CartController {
    private $productModel;
    private $cartModel;
    
    public function __construct() {
        require_once 'models/product.php';
        require_once 'models/cart.php';
        $this->productModel = new Product();
        $this->cartModel = new Cart();
    }
    
    // Thêm sản phẩm vào giỏ hàng
    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;
            
            if (!$productId) {
                echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm']);
                return;
            }
            
            // Lấy thông tin sản phẩm từ database
            $product = $this->productModel->getById($productId);
            if (!$product) {
                echo json_encode(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
                return;
            }
            
            // Khởi tạo giỏ hàng trong session nếu chưa có
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            
            // Thêm hoặc cập nhật sản phẩm trong giỏ hàng session
            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]['quantity'] += $quantity;
            } else {
                $_SESSION['cart'][$productId] = [
                    'id' => $product['id'],
                    'name' => $product['name'],
                    'price' => $product['price'],
                    'images' => $product['images'],
                    'quantity' => $quantity
                ];
            }
            
            // Nếu user đã login, lưu vào database
            if (isset($_SESSION['user_id']) && $_SESSION['user_id']) {
                try {
                    $this->cartModel->addToCart($_SESSION['user_id'], $productId, $quantity, $product['price']);
                } catch (Exception $e) {
                    // Log lỗi nhưng không ảnh hưởng user experience
                    error_log("Cart database error: " . $e->getMessage());
                }
            }
            
            // Tính tổng số lượng sản phẩm trong giỏ hàng
            $totalItems = array_sum(array_column($_SESSION['cart'], 'quantity'));
            
            echo json_encode([
                'success' => true, 
                'message' => 'Đã thêm sản phẩm vào giỏ hàng',
                'totalItems' => $totalItems
            ]);
        }
    }
    
    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? null;
            
            if ($productId && isset($_SESSION['cart'][$productId])) {
                unset($_SESSION['cart'][$productId]);
                
                // Nếu user đã login, xóa khỏi database
                if (isset($_SESSION['user_id'])) {
                    $this->cartModel->removeFromCart($_SESSION['user_id'], $productId);
                }
                
                $totalItems = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
                
                echo json_encode([
                    'success' => true, 
                    'message' => 'Đã xóa sản phẩm khỏi giỏ hàng',
                    'totalItems' => $totalItems
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm trong giỏ hàng']);
            }
        }
    }
    
    // Cập nhật số lượng sản phẩm
    public function updateQuantity() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;
            
            if ($productId && isset($_SESSION['cart'][$productId])) {
                if ($quantity > 0) {
                    $_SESSION['cart'][$productId]['quantity'] = $quantity;
                    
                    // Nếu user đã login, cập nhật database
                    if (isset($_SESSION['user_id'])) {
                        $price = $_SESSION['cart'][$productId]['price'];
                        $this->cartModel->updateQuantity($_SESSION['user_id'], $productId, $quantity, $price);
                    }
                } else {
                    unset($_SESSION['cart'][$productId]);
                    
                    // Nếu user đã login, xóa khỏi database
                    if (isset($_SESSION['user_id'])) {
                        $this->cartModel->removeFromCart($_SESSION['user_id'], $productId);
                    }
                }
                
                $totalItems = isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0;
                
                echo json_encode([
                    'success' => true, 
                    'message' => 'Đã cập nhật số lượng',
                    'totalItems' => $totalItems
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Không tìm thấy sản phẩm trong giỏ hàng']);
            }
        }
    }
    
    // Lấy danh sách sản phẩm trong giỏ hàng
    public function getCart() {
        $cart = $_SESSION['cart'] ?? [];
        $totalPrice = 0;
        
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        
        echo json_encode([
            'success' => true,
            'cart' => array_values($cart),
            'totalPrice' => $totalPrice,
            'totalItems' => array_sum(array_column($cart, 'quantity'))
        ]);
    }
    
    // Xóa toàn bộ giỏ hàng
    public function clearCart() {
        $_SESSION['cart'] = [];
        
        // Nếu user đã login, xóa giỏ hàng database
        if (isset($_SESSION['user_id'])) {
            $this->cartModel->clearCart($_SESSION['user_id']);
        }
        
        echo json_encode(['success' => true, 'message' => 'Đã xóa toàn bộ giỏ hàng']);
    }
    
    // Load giỏ hàng từ database vào session (khi user login)
    public function loadCartFromDatabase($userId) {
        $dbCart = $this->cartModel->getCartByUserId($userId);
        
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        foreach ($dbCart as $item) {
            $_SESSION['cart'][$item['product_id']] = [
                'id' => $item['product_id'],
                'name' => $item['name'],
                'price' => $item['price'],
                'images' => $item['images'],
                'quantity' => $item['quantity']
            ];
        }
    }
}
?>