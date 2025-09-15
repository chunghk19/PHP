<?php
require_once 'config/database.php';

class Cart {
    
    // Thêm sản phẩm vào giỏ hàng database
    public function addToCart($userId, $productId, $quantity, $price) {
        $conn = Database::connect();
        
        // Kiểm tra sản phẩm đã có trong giỏ chưa
        $stmt = $conn->prepare("SELECT * FROM carts WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$userId, $productId]);
        $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($existingItem) {
            // Cập nhật số lượng nếu đã có
            $newQuantity = $existingItem['quantity'] + $quantity;
            $newTotalPrice = $newQuantity * $price;
            
            $updateStmt = $conn->prepare("UPDATE carts SET quantity = ?, total_price = ? WHERE user_id = ? AND product_id = ?");
            return $updateStmt->execute([$newQuantity, $newTotalPrice, $userId, $productId]);
        } else {
            // Thêm mới nếu chưa có
            $totalPrice = $quantity * $price;
            $insertStmt = $conn->prepare("INSERT INTO carts (user_id, product_id, quantity, price, total_price) VALUES (?, ?, ?, ?, ?)");
            return $insertStmt->execute([$userId, $productId, $quantity, $price, $totalPrice]);
        }
    }
    
    // Lấy giỏ hàng của user
    public function getCartByUserId($userId) {
        $conn = Database::connect();
        $stmt = $conn->prepare("
            SELECT c.*, p.name, p.images 
            FROM carts c 
            JOIN products p ON c.product_id = p.id 
            WHERE c.user_id = ?
        ");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function updateQuantity($userId, $productId, $quantity, $price) {
        $conn = Database::connect();
        
        if ($quantity <= 0) {
            // Xóa nếu số lượng <= 0
            return $this->removeFromCart($userId, $productId);
        } else {
            // Cập nhật số lượng
            $totalPrice = $quantity * $price;
            $stmt = $conn->prepare("UPDATE carts SET quantity = ?, total_price = ? WHERE user_id = ? AND product_id = ?");
            return $stmt->execute([$quantity, $totalPrice, $userId, $productId]);
        }
    }
    
    // Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($userId, $productId) {
        $conn = Database::connect();
        $stmt = $conn->prepare("DELETE FROM carts WHERE user_id = ? AND product_id = ?");
        return $stmt->execute([$userId, $productId]);
    }
    
    // Xóa toàn bộ giỏ hàng của user
    public function clearCart($userId) {
        $conn = Database::connect();
        $stmt = $conn->prepare("DELETE FROM carts WHERE user_id = ?");
        return $stmt->execute([$userId]);
    }
    
    // Đếm số sản phẩm trong giỏ hàng
    public function getCartCount($userId) {
        $conn = Database::connect();
        $stmt = $conn->prepare("SELECT SUM(quantity) as total FROM carts WHERE user_id = ?");
        $stmt->execute([$userId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
}
?>