<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/qlbanhang/public/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/qlbanhang/public/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Sửa Sản Phẩm - TV Store</title>
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
                <li>
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
            <a class="navbar-brand" href="javascript:;">Sửa Sản Phẩm</a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Sửa Sản Phẩm</h4>
                <p class="card-category">Cập nhật thông tin sản phẩm</p>
              </div>
              <div class="card-body">
                <form method="POST" action="/qlbanhang/admin.php?page=products&action=edit&id=<?php echo $product['id']; ?>" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Tên sản phẩm <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Danh mục <span class="text-danger">*</span></label>
                        <select class="form-control" name="category_id" required>
                          <option value="">Chọn danh mục</option>
                          <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['id']; ?>" 
                                    <?php echo ($category['id'] == $product['category_id']) ? 'selected' : ''; ?>>
                              <?php echo htmlspecialchars($category['name']); ?>
                            </option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Giá <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="price" value="<?php echo $product['price']; ?>" required>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Hình ảnh</label>
                        <?php if ($product['images']): ?>
                          <div class="mb-2">
                            <img src="/qlbanhang/public/uploads/products/<?php echo $product['images']; ?>" 
                                 alt="Current image" 
                                 style="max-width: 100px;">
                          </div>
                        <?php endif; ?>
                        <input type="file" class="form-control" name="image" accept="image/*">
                        <small class="form-text text-muted">Để trống nếu không muốn thay đổi ảnh</small>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Mô tả</label>
                        <textarea class="form-control" name="description" rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <button type="submit" class="btn btn-primary btn-round">
                        <i class="fa fa-save"></i> Lưu thay đổi
                      </button>
                      <a href="/qlbanhang/admin.php?page=products&action=index" class="btn btn-secondary btn-round">
                        <i class="fa fa-list"></i> Danh sách
                      </a>
                    </div>
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
  <script>
    function toggleProductsSubmenu() {
      var submenu = document.getElementById('productsSubmenu');
      submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
    }
  </script>
</body>
</html>
