<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'TV Store - Cửa hàng điện tử'; ?></title>
    
    <!-- CSS Files -->
    <link href="/qlbanhang/public/assets/css/frontend/bootstrap.min.css" rel="stylesheet">
    <link href="/qlbanhang/public/assets/css/frontend/font-awesome.min.css" rel="stylesheet">
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
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <a href="/qlbanhang/frontend.php?page=account" class="text-white text-decoration-none me-3">
                                    <i class="fas fa-user"></i> Tài khoản
                                </a>
                                <a href="/qlbanhang/frontend.php?page=logout" class="text-white text-decoration-none">
                                    <i class="fas fa-sign-out-alt"></i> Đăng xuất
                                </a>
                            <?php else: ?>
                                <a href="/qlbanhang/frontend.php?page=login" class="text-white text-decoration-none me-3">
                                    <i class="fas fa-sign-in-alt"></i> Đăng nhập
                                </a>
                                <a href="/qlbanhang/frontend.php?page=register" class="text-white text-decoration-none">
                                    <i class="fas fa-user-plus"></i> Đăng ký
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
                    <div class="col-md-3 text-end">
                        <a href="/qlbanhang/frontend.php?page=cart" class="btn btn-outline-primary position-relative">
                            <i class="fas fa-shopping-cart"></i> 
                            Giỏ hàng
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                <span id="cart-count">0</span>
                            </span>
                        </a>
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
