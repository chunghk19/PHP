<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/qlbanhang/public/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/qlbanhang/public/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Danh Sách Sản Phẩm - TV Store</title>
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
          <li class="active">
            <a href="javascript:void(0)" onclick="toggleProductsSubmenu()">
              <i class="nc-icon nc-box-2"></i>
              <p>
                Quản lý Sản phẩm
                <b class="caret"></b>
              </p>
            </a>
            <div id="productsSubmenu" style="display: block;">
              <ul class="nav">
                <li>
                  <a href="/qlbanhang/admin.php?page=products&action=create">
                    <span class="sidebar-mini-icon">➕</span>
                    <span class="sidebar-normal">Thêm mới</span>
                  </a>
                </li>
                <li class="active">
                  <a href="/qlbanhang/admin.php?page=products&action=index">
                    <span class="sidebar-mini-icon">📋</span>
                    <span class="sidebar-normal">Danh sách</span>
                  </a>
                </li>
              </ul>
            </div>
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
            <a class="navbar-brand" href="javascript:;">Quản Lý Sản Phẩm</a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-6">
                    <h4 class="card-title">Danh Sách Sản Phẩm</h4>
                  </div>
                  <div class="col-md-6 text-right">
                    <a href="/qlbanhang/admin.php?page=products&action=create" class="btn btn-primary btn-round">
                      <i class="fa fa-plus"></i> Thêm Sản Phẩm
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <tr>
                        <th>ID</th>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($products)): ?>
                        <?php foreach ($products as $product): ?>
                          <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td>
                              <?php if ($product['images']): ?>
                                <img src="/qlbanhang/public/uploads/products/<?php echo $product['images']; ?>" 
                                     alt="<?php echo htmlspecialchars($product['name']); ?>" 
                                     style="max-width: 50px;">
                              <?php else: ?>
                                <img src="/qlbanhang/public/assets/img/default-product.jpg" 
                                     alt="No image" 
                                     style="max-width: 50px;">
                              <?php endif; ?>
                            </td>
                            <td><?php echo htmlspecialchars($product['name']); ?></td>
                            <td><?php echo htmlspecialchars($product['category_name']); ?></td>
                            <td><?php echo number_format($product['price'], 0, ',', '.') . ' đ'; ?></td>
                            <td>
                              <a href="/qlbanhang/admin.php?page=products&action=edit&id=<?php echo $product['id']; ?>" 
                                 class="btn btn-info btn-sm btn-round">
                                <i class="fa fa-edit"></i> Sửa
                              </a>
                              <a href="/qlbanhang/admin.php?page=products&action=delete&id=<?php echo $product['id']; ?>" 
                                 class="btn btn-danger btn-sm btn-round"
                                 onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
                                <i class="fa fa-trash"></i> Xóa
                              </a>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="6" class="text-center">Chưa có sản phẩm nào</td>
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
              <span class="copyright">ChungLee</span>
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
    function toggleProductsSubmenu() {
      var submenu = document.getElementById('productsSubmenu');
      submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
    }
  </script>
</body>
</html>
