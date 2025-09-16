<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/qlbanhang/public/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/qlbanhang/public/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Chi Tiết Người Dùng - TV Store</title>
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
            <a class="navbar-brand" href="javascript:;">Chi Tiết Người Dùng</a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-8">
                    <h4 class="card-title">Thông Tin Chi Tiết</h4>
                    <p class="card-category">Xem chi tiết thông tin người dùng</p>
                  </div>
                  <div class="col-md-4 text-right">
                    <a href="/qlbanhang/admin.php?page=users&action=edit&id=<?php echo $user['id']; ?>" 
                       class="btn btn-warning btn-sm">
                      <i class="fa fa-edit"></i> Sửa
                    </a>
                    <a href="/qlbanhang/admin.php?page=users&action=index" 
                       class="btn btn-secondary btn-sm">
                      <i class="fa fa-arrow-left"></i> Quay lại
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-striped">
                      <tbody>
                        <tr>
                          <th width="200">ID:</th>
                          <td><?php echo $user['id']; ?></td>
                        </tr>
                        <tr>
                          <th>Họ và tên:</th>
                          <td><?php echo htmlspecialchars($user['full_name']); ?></td>
                        </tr>
                        <tr>
                          <th>Tên đăng nhập:</th>
                          <td><?php echo htmlspecialchars($user['user_name']); ?></td>
                        </tr>
                        <tr>
                          <th>Email:</th>
                          <td><?php echo htmlspecialchars($user['email']); ?></td>
                        </tr>
                        <tr>
                          <th>Số điện thoại:</th>
                          <td><?php echo htmlspecialchars($user['phone']) ?: 'Chưa cập nhật'; ?></td>
                        </tr>
                        <tr>
                          <th>Giới tính:</th>
                          <td>
                            <?php 
                            switch($user['gender']) {
                              case 'male': echo 'Nam'; break;
                              case 'female': echo 'Nữ'; break;
                              default: echo 'Khác';
                            }
                            ?>
                          </td>
                        </tr>
                        <tr>
                          <th>Vai trò:</th>
                          <td>
                            <?php if ($user['role'] == 'admin'): ?>
                              <span class="badge badge-danger">Admin</span>
                            <?php else: ?>
                              <span class="badge badge-success">Khách hàng</span>
                            <?php endif; ?>
                          </td>
                        </tr>
                        
                      </tbody>
                    </table>
                  </div>
                </div>

                <?php if ($user['role'] == 'customer'): ?>
                <div class="row mt-4">
                  <div class="col-md-12">
                    <h5>Lịch sử đơn hàng</h5>
                    <hr>
                    <?php if (!empty($orders)): ?>
                      <div class="table-responsive">
                        <table class="table table-sm">
                          <thead>
                            <tr>
                              <th>Mã đơn</th>
                              <th>Ngày đặt</th>
                              <th>Tổng tiền</th>
                              <th>Trạng thái</th>
                              <th>Thao tác</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach ($orders as $order): ?>
                              <tr>
                                <td>#<?php echo $order['id']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($order['created_at'])); ?></td>
                                <td><?php echo number_format($order['total_amount'], 0, ',', '.'); ?>đ</td>
                                <td>
                                  <?php
                                  $statusColors = [
                                    'pending' => 'warning',
                                    'confirmed' => 'info',
                                    'shipping' => 'primary',
                                    'delivered' => 'success',
                                    'cancelled' => 'danger'
                                  ];
                                  $statusTexts = [
                                    'pending' => 'Chờ xử lý',
                                    'confirmed' => 'Đã xác nhận',
                                    'shipping' => 'Đang giao',
                                    'delivered' => 'Đã giao',
                                    'cancelled' => 'Đã hủy'
                                  ];
                                  ?>
                                  <span class="badge badge-<?php echo $statusColors[$order['status']]; ?>">
                                    <?php echo $statusTexts[$order['status']]; ?>
                                  </span>
                                </td>
                                <td>
                                  <a href="/qlbanhang/admin.php?page=orders&action=view&id=<?php echo $order['id']; ?>" 
                                     class="btn btn-info btn-xs">
                                    <i class="fa fa-eye"></i>
                                  </a>
                                </td>
                              </tr>
                            <?php endforeach; ?>
                          </tbody>
                        </table>
                      </div>
                    <?php else: ?>
                      <p class="text-muted">Chưa có đơn hàng nào.</p>
                    <?php endif; ?>
                  </div>
                </div>
                <?php endif; ?>
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
