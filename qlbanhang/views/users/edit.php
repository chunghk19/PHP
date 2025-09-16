<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/qlbanhang/public/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/qlbanhang/public/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Sửa Người Dùng - TV Store</title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href="/qlbanhang/public/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/qlbanhang/public/assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <link href="/qlbanhang/public/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="/qlbanhang/admin.php" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="/qlbanhang/public/assets/img/logo-small.png">
          </div>
        </a>
        <a href="/qlbanhang/admin.php" class="simple-text logo-normal">TV Store Admin</a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="/qlbanhang/admin.php?page=dashboard&action=index">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="/qlbanhang/admin.php?page=categories&action=index">
              <i class="nc-icon nc-tag-content"></i>
              <p>Quản lý Danh mục</p>
            </a>
          </li>
          <li>
            <a href="/qlbanhang/admin.php?page=products&action=index">
              <i class="nc-icon nc-box-2"></i>
              <p>Quản lý Sản phẩm</p>
            </a>
          </li>
          <li>
            <a href="/qlbanhang/admin.php?page=orders&action=index">
              <i class="nc-icon nc-cart-simple"></i>
              <p>Quản lý Đơn hàng</p>
            </a>
          </li>
          <li class="active">
            <a href="/qlbanhang/admin.php?page=users&action=index">
              <i class="nc-icon nc-single-02"></i>
              <p>Quản lý Người dùng</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:;">Sửa Người Dùng</a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Sửa Thông Tin Người Dùng</h4>
                <p class="card-category">Cập nhật thông tin tài khoản</p>
              </div>
              <div class="card-body">
                <?php if (isset($_SESSION['error'])): ?>
                  <div class="alert alert-danger">
                    <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                  </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                  <div class="alert alert-success">
                    <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                  </div>
                <?php endif; ?>

                <form action="/qlbanhang/admin.php?page=users&action=edit&id=<?php echo $user['id']; ?>" method="POST">
                  <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Họ và tên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="full_name" 
                               value="<?php echo isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : htmlspecialchars($user['full_name']); ?>" 
                               placeholder="Nhập họ và tên" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Tên đăng nhập <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="user_name" 
                               value="<?php echo isset($_POST['user_name']) ? htmlspecialchars($_POST['user_name']) : htmlspecialchars($user['user_name']); ?>" 
                               placeholder="Nhập tên đăng nhập" required>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" 
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : htmlspecialchars($user['email']); ?>" 
                               placeholder="Nhập email" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" 
                               value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : htmlspecialchars($user['phone']); ?>" 
                               placeholder="Nhập số điện thoại">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Mật khẩu mới</label>
                        <input type="password" class="form-control" name="password" 
                               placeholder="Để trống nếu không đổi mật khẩu">
                        <small class="form-text text-muted">Chỉ nhập nếu bạn muốn thay đổi mật khẩu</small>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Xác nhận mật khẩu mới</label>
                        <input type="password" class="form-control" name="confirm_password" 
                               placeholder="Xác nhận mật khẩu mới">
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Giới tính</label>
                        <select class="form-control" name="gender">
                          <?php $currentGender = isset($_POST['gender']) ? $_POST['gender'] : $user['gender']; ?>
                          <option value="male" <?php echo ($currentGender == 'male') ? 'selected' : ''; ?>>Nam</option>
                          <option value="female" <?php echo ($currentGender == 'female') ? 'selected' : ''; ?>>Nữ</option>
                          <option value="other" <?php echo ($currentGender == 'other') ? 'selected' : ''; ?>>Khác</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Vai trò <span class="text-danger">*</span></label>
                        <select class="form-control" name="role" required>
                          <?php $currentRole = isset($_POST['role']) ? $_POST['role'] : $user['role']; ?>
                          <option value="customer" <?php echo ($currentRole == 'customer') ? 'selected' : ''; ?>>Khách hàng</option>
                          <option value="admin" <?php echo ($currentRole == 'admin') ? 'selected' : ''; ?>>Admin</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label>Địa chỉ</label>
                    <textarea class="form-control" name="address" rows="3" 
                              placeholder="Nhập địa chỉ"><?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : htmlspecialchars($user['address']); ?></textarea>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">
                      <i class="fa fa-save"></i> Cập Nhật
                    </button>
                    <a href="/qlbanhang/admin.php?page=users&action=index" class="btn btn-secondary">
                      <i class="fa fa-arrow-left"></i> Quay lại
                    </a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer" style="position: absolute; bottom: 0; width: -webkit-fill-available;">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">
              <ul></ul>
            </nav>
            <div class="credits ml-auto">
              <span class="copyright">Nhóm 5</span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="/qlbanhang/public/assets/js/core/jquery.min.js"></script>
  <script src="/qlbanhang/public/assets/js/core/popper.min.js"></script>
  <script src="/qlbanhang/public/assets/js/core/bootstrap.min.js"></script>
  <script src="/qlbanhang/public/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="/qlbanhang/public/assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
</body>
</html>
