<?php
class User {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    // Lấy tất cả người dùng
    public function getAll() {
        $sql = "SELECT id, full_name, user_name, phone, email, gender, role 
                FROM users ORDER BY id ASC";
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
        
        // Với AUTO_INCREMENT từ 1, ID hợp lệ phải > 0
        if (!empty($exclude_id) && $exclude_id > 0) {
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
        
        // Với AUTO_INCREMENT từ 1, ID hợp lệ phải > 0
        if (!empty($exclude_id) && $exclude_id > 0) {
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

    // Đăng nhập bằng email hoặc username
    public function login($emailOrUsername, $password) {
        $sql = "SELECT * FROM users WHERE email = ? OR user_name = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$emailOrUsername, $emailOrUsername]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    // Đăng ký khách hàng mới (frontend)
    public function register($full_name, $user_name, $password, $phone, $email, $gender = 'male') {
        // Kiểm tra email và username đã tồn tại chưa
        if ($this->emailExists($email) || $this->usernameExists($user_name)) {
            return false;
        }

        return $this->create($full_name, $user_name, $password, $phone, $email, $gender, 'customer');
    }

    // Kiểm tra email đã tồn tại
    public function emailExists($email) {
        $sql = "SELECT id FROM users WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch() !== false;
    }

    // Kiểm tra username đã tồn tại
    public function usernameExists($username) {
        $sql = "SELECT id FROM users WHERE user_name = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch() !== false;
    }

    // Thay đổi mật khẩu
    public function changePassword($id, $newPassword) {
        $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$hashed_password, $id]);
    }
}
