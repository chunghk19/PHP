<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/qlbanhang/public/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/qlbanhang/public/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Quản Lý Người Dùng - TV Store</title>
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
            <a class="navbar-brand" href="javascript:;">Quản Lý Người Dùng</a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Danh Sách Người Dùng</h4>
                <p class="card-category">Quản lý tài khoản khách hàng và admin</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <tr>
                        <th>ID</th>
                        <th>Họ tên</th>
                        <th>Tên đăng nhập</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>Giới tính</th>
                        <th>Vai trò</th>
                        <th>Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                          <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['user_name']); ?></td>
                            <td><?php echo htmlspecialchars($user['email']); ?></td>
                            <td><?php echo htmlspecialchars($user['phone']); ?></td>
                            <td>
                              <?php 
                              switch($user['gender']) {
                                case 'male': echo 'Nam'; break;
                                case 'female': echo 'Nữ'; break;
                                default: echo 'Khác';
                              }
                              ?>
                            </td>
                            <td>
                              <?php if ($user['role'] == 'admin'): ?>
                                <span class="badge badge-danger">Admin</span>
                              <?php else: ?>
                                <span class="badge badge-success">Khách hàng</span>
                              <?php endif; ?>
                            </td>
                            <td>
                              <a href="/qlbanhang/admin.php?page=users&action=view&id=<?php echo $user['id']; ?>" 
                                 class="btn btn-info btn-sm btn-round">
                                <i class="fa fa-eye"></i> Xem
                              </a>
                              <a href="/qlbanhang/admin.php?page=users&action=edit&id=<?php echo $user['id']; ?>" 
                                 class="btn btn-warning btn-sm btn-round">
                                <i class="fa fa-edit"></i> Sửa
                              </a>
                              <a href="/qlbanhang/admin.php?page=users&action=delete&id=<?php echo $user['id']; ?>" 
                                 class="btn btn-danger btn-sm btn-round"
                                 onclick="return confirm('Bạn có chắc muốn xóa người dùng này?')">
                                <i class="fa fa-trash"></i> Xóa
                              </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="8" class="text-center">Chưa có người dùng nào</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
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
