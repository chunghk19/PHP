<?php
class User {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    // Lấy tất cả người dùng
    public function getAll() {
        $sql = "SELECT id, full_name, user_name, phone, email, gender, role 
                FROM users ORDER BY id DESC";
        $result = $this->conn->query($sql);
        return $result->fetchAll();
    }

    // Lấy người dùng theo ID
    public function getById($id) {
        $sql = "SELECT id, full_name, user_name, phone, email, gender, role 
                FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    // Tạo người dùng mới
    public function create($full_name, $user_name, $password, $phone, $email, $gender, $role = 'customer') {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $sql = "INSERT INTO users (full_name, user_name, password, phone, email, gender, role) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$full_name, $user_name, $hashed_password, $phone, $email, $gender, $role]);
    }

    // Cập nhật thông tin người dùng
    public function update($id, $full_name, $user_name, $phone, $email, $gender, $role) {
        $sql = "UPDATE users 
                SET full_name = ?, user_name = ?, phone = ?, email = ?, gender = ?, role = ? 
                WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$full_name, $user_name, $phone, $email, $gender, $role, $id]);
    }

    // Xóa người dùng
    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    // Kiểm tra username đã tồn tại chưa
    public function checkUserNameExists($user_name, $exclude_id = null) {
        $sql = "SELECT COUNT(*) FROM users WHERE user_name = ?";
        $params = [$user_name];
        
        if ($exclude_id) {
            $sql .= " AND id != ?";
            $params[] = $exclude_id;
        }
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    // Kiểm tra email đã tồn tại chưa
    public function checkEmailExists($email, $exclude_id = null) {
        $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
        $params = [$email];
        
        if ($exclude_id) {
            $sql .= " AND id != ?";
            $params[] = $exclude_id;
        }
        
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchColumn() > 0;
    }

    // Thống kê người dùng theo role
    public function getStatsByRole() {
        $sql = "SELECT role, COUNT(*) as count FROM users GROUP BY role";
        $result = $this->conn->query($sql);
        return $result->fetchAll();
    }

    // Lấy người dùng theo role
    public function getByRole($role) {
        $sql = "SELECT id, full_name, user_name, phone, email, gender, role 
                FROM users WHERE role = ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$role]);
        return $stmt->fetchAll();
    }
}
