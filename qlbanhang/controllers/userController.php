<?php
require_once "models/user.php";

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // Hiển thị danh sách người dùng
    public function index() {
        $users = $this->userModel->getAll();
        include "views/users/index.php";
    }

    // Hiển thị form thêm người dùng
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            include "views/users/create.php";
        } else {
            // Xử lý tạo người dùng mới
            $full_name = $_POST['full_name'];
            $user_name = $_POST['user_name'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $role = $_POST['role'];

            // Kiểm tra username đã tồn tại
            if ($this->userModel->checkUserNameExists($user_name)) {
                echo "<script>alert('Tên đăng nhập đã tồn tại!'); history.back();</script>";
                exit;
            }

            // Kiểm tra email đã tồn tại
            if ($this->userModel->checkEmailExists($email)) {
                echo "<script>alert('Email đã tồn tại!'); history.back();</script>";
                exit;
            }

            if ($this->userModel->create($full_name, $user_name, $password, $phone, $email, $gender, $role)) {
                header('Location: ' . BASE_URL . '/admin.php?page=users&action=index');
            } else {
                echo "<script>alert('Thêm người dùng thất bại!'); history.back();</script>";
            }
            exit;
        }
    }

    // Hiển thị form sửa người dùng
    public function edit() {
        $id = $_GET['id'] ?? 0;
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $user = $this->userModel->getById($id);
            include "views/users/edit.php";
        } else {
            // Xử lý cập nhật người dùng
            $full_name = $_POST['full_name'];
            $user_name = $_POST['user_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $gender = $_POST['gender'];
            $role = $_POST['role'];

            // Kiểm tra username đã tồn tại (trừ chính user này)
            if ($this->userModel->checkUserNameExists($user_name, $id)) {
                echo "<script>alert('Tên đăng nhập đã tồn tại!'); history.back();</script>";
                exit;
            }

            // Kiểm tra email đã tồn tại (trừ chính user này)
            if ($this->userModel->checkEmailExists($email, $id)) {
                echo "<script>alert('Email đã tồn tại!'); history.back();</script>";
                exit;
            }

            if ($this->userModel->update($id, $full_name, $user_name, $phone, $email, $gender, $role)) {
                header('Location: ' . BASE_URL . '/admin.php?page=users&action=index');
            } else {
                echo "<script>alert('Cập nhật người dùng thất bại!'); history.back();</script>";
            }
            exit;
        }
    }

    // Xóa người dùng
    public function delete() {
        $id = $_GET['id'] ?? 0;
        if ($this->userModel->delete($id)) {
            header('Location: ' . BASE_URL . '/admin.php?page=users&action=index');
        }
        exit;
    }

    // Hiển thị chi tiết người dùng
    public function view() {
        $id = $_GET['id'] ?? 0;
        $user = $this->userModel->getById($id);
        include "views/users/view.php";
    }

    // Thống kê người dùng
    public function stats() {
        $roleStats = $this->userModel->getStatsByRole();
        $customers = $this->userModel->getByRole('customer');
        $admins = $this->userModel->getByRole('admin');
        include "views/users/stats.php";
    }
}
