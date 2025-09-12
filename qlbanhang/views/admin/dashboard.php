
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/qlbanhang/public/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/qlbanhang/public/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Dashboard
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="/qlbanhang/public/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/qlbanhang/public/assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="/qlbanhang/public/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a  class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="/qlbanhang/public/assets/img/logo-small.png">
          </div>

        </a>
        <a  class="simple-text logo-normal">
          TV STORE ADMIN
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="active">
            <a href="/qlbanhang/admin.php?page=dashboard&action=index">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)" onclick="toggleCategoriesSubmenu()">
              <i class="nc-icon nc-tag-content"></i>
              <p>
                Quản lý Danh mục
                <b class="caret"></b>
              </p>
            </a>
            <div id="categoriesSubmenu" style="display: none;">
              <ul class="nav">
                <li>
                  <a href="/qlbanhang/admin.php?page=categories&action=create">
                    <span class="sidebar-mini-icon">➕,</span>
                    <span class="sidebar-normal">Thêm mới</span>
                  </a>
                </li>
                <li>
                  <a href="/qlbanhang/admin.php?page=categories&action=index">
                    <span class="sidebar-mini-icon">📋</span>
                    <span class="sidebar-normal">Hiển thị danh sách</span>
                  </a>
                </li>
              </ul>
            </div>
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
          <li>
            <a href="/qlbanhang/admin.php?page=users&action=index">
              <i class="nc-icon nc-single-02"></i>
              <p>Quản lý Người dùng</p>
            </a>
          </li>
          
        </ul>
      </div>
    </div>
    <div class="main-panel" style="height: 100vh;">
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
            <a class="navbar-brand" href="javascript:;">Dashboard
              
            </a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-bell-55"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <a class="dropdown-item" href="#">Something else here</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col-5">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-cart-simple"></i>
                    </div>
                  </div>
                  <div class="col-7">
                    <div class="numbers">
                      <p class="card-category">Đơn hàng hôm nay</p>
                      <h4 class="card-title"><?php echo $stats['orders_today']; ?></h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i> Cập nhật vừa xong
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
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
                      <h4 class="card-title"><?php echo number_format($stats['revenue_today'] / 1000000, 1) . 'M'; ?></h4>
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
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col-5">
                    <div class="icon-big text-center icon-danger">
                      <i class="nc-icon nc-chart-bar-32"></i>
                    </div>
                  </div>
                  <div class="col-7">
                    <div class="numbers">
                      <p class="card-category">Doanh thu tháng</p>
                      <h4 class="card-title"><?php echo number_format($stats['revenue_month'] / 1000000, 0) . 'M'; ?></h4>
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
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body">
                <div class="row">
                  <div class="col-5">
                    <div class="icon-big text-center icon-info">
                      <i class="nc-icon nc-single-02"></i>
                    </div>
                  </div>
                  <div class="col-7">
                    <div class="numbers">
                      <p class="card-category">Lượt truy cập hiện tại</p>
                      <h4 class="card-title"><?php echo number_format($stats['visitors']); ?></h4>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer">
                <hr>
                <div class="stats">
                  <i class="fa fa-users"></i> Hôm nay
                </div>
              </div>
            </div>
          </div>
          

        </div>
        
        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="card h-100">
              <div class="card-header">
                <h4 class="card-title">Sản phẩm bán chạy</h4>
                <p class="card-category">Top 5 sản phẩm được mua nhiều nhất</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <tr>
                        <th>Sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Đã bán</th>
                        <th>Doanh thu</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Samsung 55" QLED</td>
                        <td>Smart TV</td>
                        <td>15</td>
                        <td>45.5M</td>
                      </tr>
                      <tr>
                        <td>LG 65" OLED</td>
                        <td>OLED</td>
                        <td>12</td>
                        <td>38.2M</td>
                      </tr>
                      <tr>
                        <td>Sony 50" LED</td>
                        <td>LED</td>
                        <td>10</td>
                        <td>25.8M</td>
                      </tr>
                      <tr>
                        <td>TCL 43" Smart</td>
                        <td>Smart TV</td>
                        <td>8</td>
                        <td>18.5M</td>
                      </tr>
                      <tr>
                        <td>Panasonic 55"</td>
                        <td>LED</td>
                        <td>6</td>
                        <td>22.3M</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
          <div class="col-lg-6 col-md-12">
            <div class="card h-100">
              <div class="card-header">
                <h4 class="card-title">Thống kê đơn hàng</h4>
                <p class="card-category">Tình trạng đơn hàng trong ngày</p>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="text-center">
                      <h3 class="text-success">18</h3>
                      <p>Đã giao</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="text-center">
                      <h3 class="text-warning">7</h3>
                      <p>Đang xử lý</p>
                    </div>
                  </div>
                </div>
                <div class="row mt-3">
                  <div class="col-md-6">
                    <div class="text-center">
                      <h3 class="text-info">5</h3>
                      <p>Đang giao</p>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="text-center">
                      <h3 class="text-danger">2</h3>
                      <p>Đã hủy</p>
                    </div>
                  </div>
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
              <ul>
                <!-- <li><a href="https://www.creative-tim.com" target="_blank">Creative Tim</a></li>
                <li><a href="https://www.creative-tim.com/blog" target="_blank">Blog</a></li>
                <li><a href="https://www.creative-tim.com/license" target="_blank">Licenses</a></li> -->
              </ul>
            </nav>
            <!-- <div class="credits ml-auto">
              <span class="copyright">
                ChungLee
              </span>
            </div> -->
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="/qlbanhang/public/assets/js/core/jquery.min.js"></script>
  <script src="/qlbanhang/public/assets/js/core/popper.min.js"></script>
  <script src="/qlbanhang/public/assets/js/core/bootstrap.min.js"></script>
  <script src="/qlbanhang/public/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="/qlbanhang/public/assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="/qlbanhang/public/assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="/qlbanhang/public/assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
  
  <!-- Custom JavaScript for submenu -->
  <script>
    function toggleCategoriesSubmenu() {
      var submenu = document.getElementById('categoriesSubmenu');
      var caret = document.querySelector('a[onclick="toggleCategoriesSubmenu()"] .caret');
      
      if (submenu.style.display === 'none' || submenu.style.display === '') {
        submenu.style.display = 'block';
        caret.style.transform = 'rotate(180deg)';
      } else {
        submenu.style.display = 'none';
        caret.style.transform = 'rotate(0deg)';
      }
    }
  </script>
</body>

</html>
