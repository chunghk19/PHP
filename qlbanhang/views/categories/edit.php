<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/qlbanhang/public/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/qlbanhang/public/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Chỉnh Sửa Danh Mục - TV Store
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="/qlbanhang/public/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="/qlbanhang/public/assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <link href="/qlbanhang/public/assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <!-- Sidebar -->
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="/qlbanhang/admin.php" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="/qlbanhang/public/assets/img/logo-small.png">
          </div>
        </a>
        <a href="/qlbanhang/admin.php" class="simple-text logo-normal">
          TV Store Admin
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li>
            <a href="/qlbanhang/admin.php?page=dashboard&action=index">
              <i class="nc-icon nc-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="active">
            <a href="javascript:void(0)" onclick="toggleCategoriesSubmenu()">
              <i class="nc-icon nc-tag-content"></i>
              <p>
                Quản lý Danh mục
                <b class="caret"></b>
              </p>
            </a>
            <div id="categoriesSubmenu" style="display: block;">
              <ul class="nav">
                <li>
                  <a href="/qlbanhang/admin.php?page=categories&action=create">
                    <span class="sidebar-mini-icon">➕</span>
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
    <!-- End Sidebar -->

    <div class="main-panel" style="height: 100vh;">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:;">Chỉnh Sửa Danh Mục</a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->

      <div class="content">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Chỉnh Sửa Danh Mục</h4>
              </div>
              <div class="card-body">
                <form method="POST">
                  <div class="form-group">
                    <label for="name">Tên Danh Mục</label>
                    <input type="text" class="form-control" id="name" name="name"
                      value="<?= htmlspecialchars($category['name']) ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="description">Mô Tả</label>
                    <textarea class="form-control" id="description" name="description" rows="3"><?= htmlspecialchars($category['description']) ?></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary btn-round">Cập nhật</button>
                  <a href="/qlbanhang/admin.php?page=categories&action=index" class="btn btn-secondary btn-round">Hủy</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer" style="position: absolute; bottom: 0; width: -webkit-fill-available;">
        <div class="container-fluid">
          <div class="row">
            <div class="credits ml-auto">
              <span class="copyright">
                ChungLee
              </span>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!-- Core JS Files -->
  <script src="/qlbanhang/public/assets/js/core/jquery.min.js"></script>
  <script src="/qlbanhang/public/assets/js/core/popper.min.js"></script>
  <script src="/qlbanhang/public/assets/js/core/bootstrap.min.js"></script>
  <script src="/qlbanhang/public/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <script src="/qlbanhang/public/assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>

  <!-- Custom submenu JS -->
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
