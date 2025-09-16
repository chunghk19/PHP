<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/qlbanhang/public/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/qlbanhang/public/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Thống Kê Đơn Hàng - TV Store</title>
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
          <li class="active">
            <a href="javascript:void(0)" onclick="toggleOrdersSubmenu()">
              <i class="nc-icon nc-cart-simple"></i>
              <p>
                Quản lý Đơn hàng
                <b class="caret"></b>
              </p>
            </a>
            <div id="ordersSubmenu" style="display: block;">
              <ul class="nav">
                <li>
                  <a href="/qlbanhang/admin.php?page=orders&action=index">
                    <span class="sidebar-mini-icon">📋</span>
                    <span class="sidebar-normal">Danh sách</span>
                  </a>
                </li>
                <li class="active">
                  <a href="/qlbanhang/admin.php?page=orders&action=stats">
                    <span class="sidebar-mini-icon">📊</span>
                    <span class="sidebar-normal">Thống kê</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
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
            <a class="navbar-brand" href="javascript:;">Thống Kê Đơn Hàng</a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <!-- Thống kê doanh thu -->
        <div class="row">
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col-5">
                    <div class="icon-big text-center icon-success">
                      <i class="nc-icon nc-money-coins"></i>
                    </div>
                  </div>
                  <div class="col-7">
                    <div class="numbers">
                      <p class="card-category">Doanh thu hôm nay</p>
                      <h4 class="card-title"><?php echo number_format($revenueToday / 1000000, 1) . 'M'; ?></h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i> Hôm nay
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col-5">
                    <div class="icon-big text-center icon-primary">
                      <i class="nc-icon nc-chart-bar-32"></i>
                    </div>
                  </div>
                  <div class="col-7">
                    <div class="numbers">
                      <p class="card-category">Doanh thu tháng</p>
                      <h4 class="card-title"><?php echo number_format($revenueMonth / 1000000, 0) . 'M'; ?></h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar"></i> Tháng này
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col-5">
                    <div class="icon-big text-center icon-info">
                      <i class="nc-icon nc-cart-simple"></i>
                    </div>
                  </div>
                  <div class="col-7">
                    <div class="numbers">
                      <p class="card-category">Tổng đơn hàng</p>
                      <h4 class="card-title">
                        <?php 
                        $totalOrders = 0;
                        foreach($statusStats as $stat) {
                          $totalOrders += $stat['count'];
                        }
                        echo $totalOrders;
                        ?>
                      </h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <hr>
                <div class="stats">
                  <i class="fa fa-list"></i> Tất cả
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Thống kê theo trạng thái -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Thống Kê Theo Trạng Thái</h4>
                <p class="card-category">Phân bố đơn hàng theo trạng thái</p>
              </div>
              <div class="card-body">
                <div class="row">
                  <?php if (!empty($statusStats)): ?>
                    <?php foreach ($statusStats as $stat): ?>
                      <div class="col-md-3">
                        <div class="text-center">
                          <?php
                          $statusClass = '';
                          $statusText = '';
                          $iconClass = '';
                          switch($stat['status']) {
                            case 'pending':
                              $statusClass = 'text-warning';
                              $statusText = 'Chờ xử lý';
                              $iconClass = 'nc-icon nc-time-alarm';
                              break;
                            case 'processing':
                              $statusClass = 'text-info';
                              $statusText = 'Đang xử lý';
                              $iconClass = 'nc-icon nc-settings-gear-65';
                              break;
                            case 'shipping':
                              $statusClass = 'text-primary';
                              $statusText = 'Đang giao';
                              $iconClass = 'nc-icon nc-delivery-fast';
                              break;
                            case 'completed':
                              $statusClass = 'text-success';
                              $statusText = 'Hoàn thành';
                              $iconClass = 'nc-icon nc-check-2';
                              break;
                            case 'cancelled':
                              $statusClass = 'text-danger';
                              $statusText = 'Đã hủy';
                              $iconClass = 'nc-icon nc-simple-remove';
                              break;
                            default:
                              $statusClass = 'text-secondary';
                              $statusText = $stat['status'];
                              $iconClass = 'nc-icon nc-circle-10';
                          }
                          ?>
                          <div class="icon-big <?php echo $statusClass; ?>">
                            <i class="<?php echo $iconClass; ?>"></i>
                          </div>
                          <h3 class="<?php echo $statusClass; ?>"><?php echo $stat['count']; ?></h3>
                          <p><?php echo $statusText; ?></p>
                        </div>
                      </div>
                    <?php endforeach; ?>
                  <?php else: ?>
                    <div class="col-md-12">
                      <p class="text-center">Chưa có dữ liệu thống kê</p>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Biểu đồ phân tích (placeholder) -->
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Biểu Đồ Doanh Thu</h4>
                <p class="card-category">Xu hướng doanh thu theo thời gian</p>
              </div>
              <div class="card-body">
                <div class="text-center" style="padding: 50px;">
                  <i class="nc-icon nc-chart-pie-36" style="font-size: 48px; color: #ccc;"></i>
                  <p class="text-muted mt-3">Biểu đồ sẽ được phát triển trong phiên bản tiếp theo</p>
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
  <script>
    function toggleOrdersSubmenu() {
      var submenu = document.getElementById('ordersSubmenu');
      submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
    }
  </script>
</body>
</html>
