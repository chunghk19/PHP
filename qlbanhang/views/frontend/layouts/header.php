<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'TV Store - Cửa hàng điện tử'; ?></title>
    
    <!-- CSS Files -->
    <link href="/qlbanhang/public/assets/css/frontend/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/qlbanhang/public/assets/css/frontend/slick.css" rel="stylesheet">
    <link href="/qlbanhang/public/assets/css/frontend/slick-theme.css" rel="stylesheet">
    <link href="/qlbanhang/public/assets/css/frontend/nouislider.min.css" rel="stylesheet">
    <link href="/qlbanhang/public/assets/css/frontend/style.css" rel="stylesheet">
    
    <!-- Custom CSS cho frontend -->
    <link href="/qlbanhang/public/assets/css/frontend.css" rel="stylesheet">
    
    <!-- Thêm CSS tùy chỉnh nếu có -->
    <?php if (isset($extraCSS)): ?>
        <?php foreach ($extraCSS as $css): ?>
            <link href="<?php echo $css; ?>" rel="stylesheet">
        <?php endforeach; ?>
    <?php endif; ?>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <!-- Top Bar -->
        <div class="top-bar bg-dark text-white py-2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="contact-info">
                            <span class="me-3">
                                <i class="fas fa-phone"></i> 
                                Hotline: 1900-xxx-xxx
                            </span>
                            <span>
                                <i class="fas fa-envelope"></i> 
                                info@tvstore.vn
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="user-actions">
                            <?php 
                            // Xử lý refresh session nếu được yêu cầu
                            if (isset($_GET['refresh_session'])) {
                                session_destroy();
                                session_start();
                                header('Location: /qlbanhang/frontend.php');
                                exit;
                            }
                            
                            // Khởi tạo AuthController để check login status
                            $rootPath = $_SERVER['DOCUMENT_ROOT'] . '/qlbanhang/';
                            require_once $rootPath . 'controllers/authController.php';
                            $authController = new AuthController();
                            
                            if ($authController->isLoggedIn()): 
                                // Refresh session để đảm bảo dữ liệu mới nhất
                                $authController->refreshSession();
                                $currentUser = $authController->getCurrentUser();
                            ?>
                                <span class="text-white me-3">
                                    <i class="fa fa-user"></i> Xin chào, <?= htmlspecialchars($currentUser['full_name'] ?? 'User') ?>
                                    <?php if ($currentUser['role'] === 'admin'): ?>
                                        <small class="badge bg-warning text-dark ms-1">Admin</small>
                                    <?php endif; ?>
                                </span>
                                <?php if ($currentUser['role'] === 'admin'): ?>
                                    <a href="/qlbanhang/admin.php" class="text-white text-decoration-none me-3">
                                        <i class="fa fa-cog"></i> Quản trị
                                    </a>
                                <?php endif; ?>
                                <a href="?refresh_session=1" class="text-white text-decoration-none me-2" title="Refresh session">
                                    <i class="fa fa-refresh"></i>
                                </a>
                                <a href="/qlbanhang/frontend.php?action=logout" class="text-white text-decoration-none">
                                    <i class="fa fa-sign-out"></i> Đăng xuất
                                </a>
                                </a>
                            <?php else: ?>
                                <a href="/qlbanhang/frontend.php?action=login" class="text-white text-decoration-none me-3">
                                    <i class="fa fa-sign-in"></i> Đăng nhập
                                </a>
                                <a href="/qlbanhang/frontend.php?action=register" class="text-white text-decoration-none">
                                    <i class="fa fa-user-plus"></i> Đăng ký
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Header -->
        <div class="main-header bg-white py-3 shadow-sm">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Logo -->
                    <div class="col-md-3">
                        <div class="logo">
                            <a href="/qlbanhang/frontend.php" class="text-decoration-none">
                                <h2 class="mb-0 text-primary">
                                    <i class="fas fa-tv"></i> TV Store
                                </h2>
                            </a>
                        </div>
                    </div>

                    <!-- Search -->
                    <div class="col-md-6">
                        <form action="/qlbanhang/frontend.php" method="GET" class="search-form">
                            <input type="hidden" name="page" value="products">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" 
                                       placeholder="Tìm kiếm sản phẩm..." 
                                       value="<?php echo $_GET['search'] ?? ''; ?>">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Cart -->
                    <div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Giỏ hàng</span>
                                <div class="qty" id="cart-count"><?php echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0; ?></div>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list" id="cart-items">
                                    <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                                        <?php 
                                        $totalPrice = 0;
                                        foreach ($_SESSION['cart'] as $item): 
                                            $totalPrice += $item['price'] * $item['quantity'];
                                        ?>
                                            <div class="product-widget">
                                                <div class="product-img">
                                                    <img src="/qlbanhang/public/uploads/products/<?php echo $item['image']; ?>" alt="">
                                                </div>
                                                <div class="product-body">
                                                    <h3 class="product-name"><a href="#"><?php echo htmlspecialchars($item['name']); ?></a></h3>
                                                    <h4 class="product-price"><span class="qty"><?php echo $item['quantity']; ?>x</span><?php echo number_format($item['price']); ?>đ</h4>
                                                </div>
                                                <button class="delete remove-from-cart" data-product-id="<?php echo $item['id']; ?>"><i class="fa fa-close"></i></button>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="text-center p-3">
                                            <p>Giỏ hàng trống</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
                                    <div class="cart-summary">
                                        <small><?php echo array_sum(array_column($_SESSION['cart'], 'quantity')); ?> sản phẩm đã chọn</small>
                                        <h5>TỔNG: <?php echo number_format($totalPrice ?? 0); ?>đ</h5>
                                    </div>
                                    <div class="cart-btns">
                                        <a href="/qlbanhang/frontend.php?page=cart">Xem giỏ hàng</a>
                                        <a href="/qlbanhang/frontend.php?page=checkout">Thanh toán <i class="fa fa-arrow-circle-right"></i></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="/qlbanhang/frontend.php">
                                <i class="fas fa-home"></i> Trang chủ
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/qlbanhang/frontend.php?page=products">
                                <i class="fas fa-list"></i> Sản phẩm
                            </a>
                        </li>
                        
                        <!-- Categories Dropdown -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="categoriesDropdown" 
                               role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-th-large"></i> Danh mục
                            </a>
                            <ul class="dropdown-menu" id="categories-menu">
                                <!-- Categories sẽ được load động bằng JavaScript -->
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="/qlbanhang/frontend.php?page=about">
                                <i class="fas fa-info-circle"></i> Về chúng tôi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/qlbanhang/frontend.php?page=contact">
                                <i class="fas fa-phone"></i> Liên hệ
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <?php echo $content ?? ''; ?>
    </main>

    <!-- Footer sẽ được include từ file khác -->
    <?php include "footer.php"; ?>

    <!-- Scripts -->
    <script src="/qlbanhang/public/assets/js/frontend/jquery.min.js"></script>
    <script src="/qlbanhang/public/assets/js/frontend/bootstrap.min.js"></script>
    <script src="/qlbanhang/public/assets/js/frontend/slick.min.js"></script>
    <script src="/qlbanhang/public/assets/js/frontend/nouislider.min.js"></script>
    <script src="/qlbanhang/public/assets/js/frontend/jquery.zoom.min.js"></script>
    <script src="/qlbanhang/public/assets/js/frontend/main.js"></script>
    <script src="/qlbanhang/public/assets/js/frontend.js"></script>
    
    <!-- Thêm JS tùy chỉnh nếu có -->
    <?php if (isset($extraJS)): ?>
        <?php foreach ($extraJS as $js): ?>
            <script src="<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
