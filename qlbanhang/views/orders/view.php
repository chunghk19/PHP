<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="/qlbanhang/public/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="/qlbanhang/public/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Chi Tiết Đơn Hàng - TV Store</title>
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
            <a class="navbar-brand" href="javascript:;">Chi Tiết Đơn Hàng #<?php echo $order['id']; ?></a>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row">
          <div class="col-md-8">
            <!-- Thông tin đơn hàng -->
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Thông Tin Đơn Hàng</h4>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <p><strong>Mã đơn hàng:</strong> #<?php echo $order['id']; ?></p>
                    <p><strong>Ngày đặt:</strong> <?php echo date('d/m/Y H:i', strtotime($order['order_date'])); ?></p>
                    <p><strong>Tổng tiền:</strong> <?php echo number_format($order['total_price'], 0, ',', '.') . ' đ'; ?></p>
                  </div>
                  <div class="col-md-6">
                    <p><strong>Khách hàng:</strong> <?php echo htmlspecialchars($order['full_name']); ?></p>
                    <p><strong>Điện thoại:</strong> <?php echo htmlspecialchars($order['phone']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($order['email']); ?></p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Chi tiết sản phẩm -->
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Chi Tiết Sản Phẩm</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class="text-primary">
                      <tr>
                        <th>Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($orderItems)): ?>
                        <?php foreach ($orderItems as $item): ?>
                          <tr>
                            <td>
                              <div class="d-flex align-items-center">
                                <?php if ($item['images']): ?>
                                  <img src="/qlbanhang/public/uploads/products/<?php echo $item['images']; ?>" 
                                       alt="<?php echo htmlspecialchars($item['product_name']); ?>" 
                                       style="width: 50px; margin-right: 10px;">
                                <?php endif; ?>
                                <?php echo htmlspecialchars($item['product_name']); ?>
                              </div>
                            </td>
                            <td><?php echo number_format($item['price'], 0, ',', '.') . ' đ'; ?></td>
                            <td><?php echo $item['quantity']; ?></td>
                            <td><?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.') . ' đ'; ?></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-4">
            <!-- Cập nhật trạng thái -->
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Cập Nhật Trạng Thái</h4>
              </div>
              <div class="card-body">
                <form method="POST" action="/qlbanhang/admin.php?page=orders&action=updateStatus">
                  <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                  <div class="form-group">
                    <label>Trạng thái hiện tại:</label>
                    <select class="form-control" name="status">
                      <option value="pending" <?php echo ($order['status'] == 'pending') ? 'selected' : ''; ?>>Chờ xử lý</option>
                      <option value="processing" <?php echo ($order['status'] == 'processing') ? 'selected' : ''; ?>>Đang xử lý</option>
                      <option value="shipping" <?php echo ($order['status'] == 'shipping') ? 'selected' : ''; ?>>Đang giao</option>
                      <option value="completed" <?php echo ($order['status'] == 'completed') ? 'selected' : ''; ?>>Hoàn thành</option>
                      <option value="cancelled" <?php echo ($order['status'] == 'cancelled') ? 'selected' : ''; ?>>Đã hủy</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary btn-round">
                    <i class="fa fa-save"></i> Cập nhật
                  </button>
                </form>
              </div>
            </div>

            <!-- Thao tác -->
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Thao Tác</h4>
              </div>
              <div class="card-body">
                <a href="/qlbanhang/admin.php?page=orders&action=index" class="btn btn-secondary btn-round btn-block">
                  <i class="fa fa-list"></i> Quay lại danh sách
                </a>
                <a href="/qlbanhang/admin.php?page=orders&action=delete&id=<?php echo $order['id']; ?>" 
                   class="btn btn-danger btn-round btn-block mt-2"
                   onclick="return confirm('Bạn có chắc muốn xóa đơn hàng này?')">
                  <i class="fa fa-trash"></i> Xóa đơn hàng
                </a>
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
</body>
</html>
