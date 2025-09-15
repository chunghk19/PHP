<?php
// Debug: kiểm tra dữ liệu được truyền từ controller
if (!isset($product)) {
    // Nếu không có dữ liệu từ controller, redirect về trang chủ
    header('Location: /qlbanhang/frontend.php');
    exit;
}

// Load cần thiết các model và controller để check session
if (!isset($categories)) {
    require_once __DIR__ . '/../../../models/category.php';
    $categoryModel = new Category();
    $categories = $categoryModel->getAll();
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title><?= isset($product) ? htmlspecialchars($product['name']) . ' - TV Store' : 'Chi tiết sản phẩm - TV Store' ?></title>

 		<!-- Google font -->
 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

 		<!-- Bootstrap -->
 		<link type="text/css" rel="stylesheet" href="/qlbanhang/public/assets/css/frontend/bootstrap.min.css"/>

 		<!-- Slick -->
 		<link type="text/css" rel="stylesheet" href="/qlbanhang/public/assets/css/frontend/slick.css"/>
 		<link type="text/css" rel="stylesheet" href="/qlbanhang/public/assets/css/frontend/slick-theme.css"/>

 		<!-- nouislider -->
 		<link type="text/css" rel="stylesheet" href="/qlbanhang/public/assets/css/frontend/nouislider.min.css"/>

 		<!-- Font Awesome Icon -->
 		<link rel="stylesheet" href="/qlbanhang/public/assets/css/frontend/font-awesome.min.css">
 		<!-- Font Awesome CDN Backup -->
 		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

 		<!-- Custom stlylesheet -->
 		<link type="text/css" rel="stylesheet" href="/qlbanhang/public/assets/css/frontend/style.css"/>

	
		
		<style>
		/* Cart notification styles */
		.cart-notification {
			position: fixed;
			top: 20px;
			right: 20px;
			background: #28a745;
			color: white;
			padding: 15px 20px;
			border-radius: 5px;
			box-shadow: 0 4px 12px rgba(0,0,0,0.2);
			z-index: 9999;
			display: flex;
			align-items: center;
			gap: 10px;
			transform: translateX(100%);
			transition: transform 0.3s ease;
		}
		
		.cart-notification.show {
			transform: translateX(0);
		}
		
		.cart-notification i {
			font-size: 20px;
		}
		
		.cart-notification.error {
			background: #dc3545;
		}
		
		.cart-notification {
			position: fixed;
			top: 20px;
			right: 20px;
			background: #28a745;
			color: white;
			padding: 15px 20px;
			border-radius: 5px;
			box-shadow: 0 4px 12px rgba(0,0,0,0.2);
			z-index: 9999;
			display: flex;
			align-items: center;
			gap: 10px;
			transform: translateX(100%);
			transition: transform 0.3s ease;
		}
		
		.cart-notification.show {
			transform: translateX(0);
		}
		
		.cart-notification i {
			font-size: 20px;
		}
		
		.cart-notification.error {
			background: #dc3545;
		}

		/* Single checkout button styling */
		.btn-checkout-only {
			display: block !important;
			width: 100% !important;
			text-align: center !important;
			padding: 10px !important;
			background: #D10024 !important;
			color: #fff !important;
			text-decoration: none !important;
			border-radius: 4px !important;
			transition: all 0.3s ease !important;
			font-weight: bold !important;
		}

		.btn-checkout-only:hover {
			background: #b8001f !important;
			color: #fff !important;
		}

		/* Cart button container styling */
		.cart-btns {
			padding: 15px !important;
		}

		/* Cart dropdown visibility fix */
		.header-ctn > div {
			position: relative;
		}
		
		.cart-dropdown {
			opacity: 0;
			visibility: hidden;
			transition: all 0.3s ease;
		}
		
		.header-ctn > div:hover .cart-dropdown {
			opacity: 1;
			visibility: visible;
		}
		
		.cart-dropdown.show {
			opacity: 1 !important;
			visibility: visible !important;
		}

		/* Cart dropdown content styling */
		.cart-list {
			max-height: 300px;
			overflow-y: auto;
			padding: 15px;
		}
		
		.product-widget {
			display: flex;
			align-items: center;
			padding: 10px 0;
			border-bottom: 1px solid #eee;
			position: relative;
		}
		
		.product-widget:last-child {
			border-bottom: none;
		}
		
		.product-widget .product-img {
			width: 50px;
			height: 50px;
			margin-right: 10px;
		}
		
		.product-widget .product-img img {
			width: 100%;
			height: 100%;
			object-fit: cover;
		}
		
		.product-widget .product-body {
			flex: 1;
		}
		
		.product-widget .product-name {
			font-size: 14px;
			margin: 0 0 5px 0;
		}
		
		.product-widget .product-price {
			font-size: 12px;
			color: #D10024;
			margin: 0;
		}
		
		.product-widget .delete {
			position: absolute;
			top: 0;
			left: 0;
			height: 14px;
			width: 14px;
			text-align: center;
			font-size: 10px;
			padding: 0;
			background: #1e1f29;
			border: none;
			color: #fff;
			cursor: pointer;
		}
		
		.product-widget .delete:hover {
			background: #D10024;
		}
		
		.cart-summary {
			padding: 15px;
			border-top: 1px solid #eee;
			text-align: center;
		}
		
		.cart-btns {
			padding: 15px;
			border-top: 1px solid #eee;
		}
		
		.cart-btns a {
			display: block;
			padding: 8px 15px;
			margin-bottom: 5px;
			background: #D10024;
			color: white;
			text-decoration: none;
			text-align: center;
			border-radius: 3px;
		}
		
		.cart-btns a:hover {
			background: #b8001f;
			color: white;
		}

		/* Navigation dropdown styles */
		.main-nav > li {
			position: relative !important;
		}
		
		.main-nav li.dropdown {
			position: relative !important;
		}
		
		.main-nav .dropdown-menu {
			position: absolute !important;
			top: 100% !important;
			left: 0 !important;
			background: #fff !important;
			border: 1px solid #e4e7ed !important;
			box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
			border-radius: 0 !important;
			min-width: 200px !important;
			opacity: 0 !important;
			visibility: hidden !important;
			transform: translateY(-10px) !important;
			transition: all 0.3s ease !important;
			z-index: 1000 !important;
			display: block !important;
			list-style: none !important;
			padding: 0 !important;
			margin: 0 !important;
		}
		
		.main-nav li.dropdown:hover .dropdown-menu {
			opacity: 1 !important;
			visibility: visible !important;
			transform: translateY(0) !important;
		}
		
		.dropdown-menu li {
			display: block !important;
			border-bottom: 1px solid #f0f0f0 !important;
			width: 100% !important;
			float: none !important;
		}
		
		.dropdown-menu li:last-child {
			border-bottom: none !important;
		}
		
		.dropdown-menu li a {
			display: block !important;
			padding: 10px 15px !important;
			color: #333 !important;
			text-decoration: none !important;
			transition: all 0.3s ease !important;
			text-transform: none !important;
			font-size: 14px !important;
		}
		
		.dropdown-menu li a:hover {
			background: #d10024 !important;
			color: #fff !important;
		}

		/* Fix search form layout */
		.header-search form {
			display: flex !important;
			align-items: stretch !important;
			position: relative !important;
		}
		
		.header-search .input-select {
			margin-right: -4px !important;
			border-radius: 40px 0px 0px 40px !important;
			min-width: 160px !important;
			flex-shrink: 0 !important;
		}
		
		.header-search .input {
			margin-right: -4px !important;
			border-radius: 0 !important;
			flex: 1 !important;
		}
		
		.header-search .search-btn {
			height: 40px !important;
			width: 100px !important;
			background: #d10024 !important;
			color: #fff !important;
			font-weight: 700 !important;
			border: none !important;
			border-radius: 0px 40px 40px 0px !important;
			flex-shrink: 0 !important;
		}
		</style>

    </head>
	<body>
		<!-- HEADER -->
		<header>
			<!-- TOP HEADER -->
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> 0982 905 207</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> tvstore@gmail.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> I - Tech</a></li>
					</ul>
					<ul class="header-links pull-right">
						<!-- <li><a href="#"><i class="fa fa-dollar"></i> VNĐ</a></li> -->
						<?php
						// Khởi tạo AuthController để check login status
						require_once __DIR__ . '/../../../controllers/authController.php';
						$authController = new AuthController();
						
						if ($authController->isLoggedIn()): 
							$currentUser = $authController->getCurrentUser();
						?>
							<li>
								<a href="#">
									<i class="fa fa-user-o"></i> Xin chào, <?= htmlspecialchars($currentUser['full_name'] ?? 'User') ?>
									<?php if ($currentUser['role'] === 'admin'): ?>
										<small style="background: #ffc107; color: #000; padding: 2px 5px; border-radius: 3px; font-size: 10px; margin-left: 5px;">Admin</small>
									<?php endif; ?>
								</a>
							</li>
							<?php if ($currentUser['role'] === 'admin'): ?>
								<li><a href="/qlbanhang/admin.php"><i class="fa fa-cog"></i> Quản trị</a></li>
							<?php endif; ?>
							<li><a href="/qlbanhang/frontend.php?action=logout"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
						<?php else: ?>
							<li><a href="/qlbanhang/frontend.php?action=login"><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
							<li><a href="/qlbanhang/frontend.php?action=register"><i class="fa fa-user-plus"></i> Đăng ký</a></li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
			<!-- /TOP HEADER -->

			<!-- MAIN HEADER -->
			<div id="header">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<!-- LOGO -->
						<div class="col-md-3">
							<div class="header-logo">
								<a href="/qlbanhang/frontend.php" class="logo">
									<h2 style="color: #D10024; margin: 0; font-weight: bold;">TV Store</h2>
									<p style="color: #666; margin: 0; font-size: 12px; text-align: center;">Nhóm 5</p>
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">Tất cả danh mục</option>
										<?php if (isset($categories)): ?>
											<?php foreach ($categories as $category): ?>
												<option value="<?= $category['id'] ?>"><?= htmlspecialchars($category['name']) ?></option>
											<?php endforeach; ?>
										<?php endif; ?>
									</select>
									<input class="input" placeholder="Tìm kiếm sản phẩm...">
									<button class="search-btn">Tìm kiếm</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								
								<div>
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" onclick="toggleCart(event)">
										<i class="fa fa-shopping-cart"></i>
										<span>Giỏ hàng</span>
										<div class="qty" id="cart-count"><?= isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0 ?></div>
									</a>
									<div class="cart-dropdown" id="cart-dropdown">
										<div class="cart-list" id="cart-items">
											<?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
												<?php 
												$totalPrice = 0;
												foreach ($_SESSION['cart'] as $item): 
													$totalPrice += $item['price'] * $item['quantity'];
												?>
													<div class="product-widget">
														<div class="product-img">
															<?php 
															// Kiểm tra key nào có sẵn: 'image' hoặc 'images'
															$imageKey = isset($item['images']) ? 'images' : (isset($item['image']) ? 'image' : '');
															$imagePath = $imageKey ? $item[$imageKey] : 'default.jpg';
															?>
															<img src="/qlbanhang/public/uploads/products/<?= htmlspecialchars($imagePath) ?>" alt="<?= htmlspecialchars($item['name']) ?>">
														</div>
														<div class="product-body">
															<h3 class="product-name"><a href="#"><?= htmlspecialchars($item['name']) ?></a></h3>
															<h4 class="product-price"><span class="qty"><?= $item['quantity'] ?>x</span><?= number_format($item['price']) ?>đ</h4>
														</div>
														<button class="delete remove-from-cart" data-product-id="<?= $item['id'] ?>"><i class="fa fa-close"></i></button>
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
												<small id="cart-total-items"><?= array_sum(array_column($_SESSION['cart'], 'quantity')) ?> sản phẩm đã chọn</small>
												<h5 id="cart-total-price">TỔNG: <?= number_format($totalPrice ?? 0) ?>đ</h5>
											</div>
											<div class="cart-btns">
												<a href="/qlbanhang/frontend.php?page=checkout" class="btn-checkout-only">Đặt Hàng  <i class="fa fa-arrow-circle-right"></i></a>
											</div>
										<?php endif; ?>
									</div>
								</div>
								<!-- /Cart -->

								<!-- Menu Toogle -->
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
								<!-- /Menu Toogle -->
							</div>
						</div>
						<!-- /ACCOUNT -->
					</div>
					<!-- row -->
				</div>
				<!-- container -->
			</div>
			<!-- /MAIN HEADER -->
		</header>
		<!-- /HEADER -->

		<!-- NAVIGATION -->
		<nav id="navigation">
			<!-- container -->
			<div class="container">
				<!-- responsive-nav -->
				<div id="responsive-nav">
					<!-- NAV -->
					<ul class="main-nav nav navbar-nav">
						<li><a href="/qlbanhang/frontend.php">Trang chủ</a></li>
						<li class="dropdown" style="position: relative;">
							<a href="/qlbanhang/frontend.php?page=store" class="dropdown-toggle">
								Tất cả sản phẩm <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu" style="position: absolute; top: 100%; left: 0; background: #fff; border: 1px solid #e4e7ed; box-shadow: 0 4px 12px rgba(0,0,0,0.1); min-width: 200px; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.3s ease; z-index: 1000; display: block; list-style: none; padding: 0; margin: 0;">
							
								<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="/qlbanhang/frontend.php?page=store&categories=Tivi Samsung" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi Samsung</a></li>
								<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="/qlbanhang/frontend.php?page=store&categories=Tivi LG" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi LG</a></li>
								<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="/qlbanhang/frontend.php?page=store&categories=Tivi Sony" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi Sony</a></li>
								<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="/qlbanhang/frontend.php?page=store&categories=Tivi Xiaomi" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi Xiaomi</a></li>
								<li style="display: block; border-bottom: none; width: 100%; float: none;"><a href="/qlbanhang/frontend.php?page=store&categories=Tivi Toshiba" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi Toshiba</a></li>
							</ul>
						</li>
					</ul>
					<!-- /NAV -->
				</div>
				<!-- /responsive-nav -->
			</div>
			<!-- /container -->
		</nav>
		<!-- /NAVIGATION -->

		<!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<ul class="breadcrumb-tree">
							<li><a href="/qlbanhang/frontend.php">Trang chủ</a></li>
							<li><a href="/qlbanhang/frontend.php?page=products">Sản phẩm</a></li>
							<li class="active"><?= isset($product) ? htmlspecialchars($product['name']) : 'Chi tiết sản phẩm' ?></li>
						</ul>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /BREADCRUMB -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- Product main img -->
					<div class="col-md-5 col-md-push-2">
						<div id="product-main-img">
							<div class="product-preview">
								<?php if (isset($product) && !empty($product['images'])): ?>
									<img src="/qlbanhang/public/uploads/products/<?= htmlspecialchars($product['images']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
								<?php else: ?>
									<img src="/qlbanhang/public/assets/img/frontend/product01.png" alt="Hình ảnh sản phẩm">
								<?php endif; ?>
							</div>
						</div>
					</div>
					<!-- /Product main img -->

					<!-- Product thumb imgs -->
					<div class="col-md-2  col-md-pull-5">
						<div id="product-imgs">
							<div class="product-preview">
								<?php if (isset($product) && !empty($product['images'])): ?>
									<img src="/qlbanhang/public/uploads/products/<?= htmlspecialchars($product['images']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
								<?php else: ?>
									<img src="/qlbanhang/public/assets/img/frontend/product01.png" alt="Hình ảnh sản phẩm">
								<?php endif; ?>
							</div>
						</div>
					</div>
					<!-- /Product thumb imgs -->

					<!-- Product details -->
					<div class="col-md-5">
						<div class="product-details">
							<h2 class="product-name"><?= isset($product) ? htmlspecialchars($product['name']) : 'Tên sản phẩm' ?></h2>
							<div>
								<div class="product-rating">
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-o"></i>
								</div>
								<a class="review-link" href="#">10 Đánh giá | Thêm đánh giá của bạn</a>
							</div>
							<div>
								<h3 class="product-price">
									<?php if (isset($product)): ?>
										<?= number_format($product['price'], 0, ',', '.') ?>₫
									<?php else: ?>
										0₫
									<?php endif; ?>
								</h3>
								<span class="product-available">Còn hàng</span>
							</div>
							<p><?= isset($product) ? nl2br(htmlspecialchars($product['description'])) : 'Mô tả sản phẩm sẽ được hiển thị ở đây.' ?></p>

							<div class="product-options">
								<!-- Remove size and color for TVs, they're not applicable -->
							</div>

							<div class="add-to-cart">
								<div class="qty-label">
									Số lượng
									<div class="input-number">
										<input type="number" id="product-quantity" value="1" min="1">
										<span class="qty-up">+</span>
										<span class="qty-down">-</span>
									</div>
								</div>
								<button class="add-to-cart-btn" data-product-id="<?= isset($product) ? $product['id'] : '' ?>"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ</button>
							</div>

							<ul class="product-btns">
								<li><a href="#"><i class="fa fa-heart-o"></i> Thêm vào yêu thích</a></li>
								<li><a href="#"><i class="fa fa-exchange"></i> So sánh</a></li>
							</ul>

							<ul class="product-links">
								<li>Danh mục:</li>
								<li>
									<?php if (isset($product)): ?>
										<a href="/qlbanhang/frontend.php?page=products&category=<?= $product['category_id'] ?>">
											<?= htmlspecialchars($product['category_name']) ?>
										</a>
									<?php else: ?>
										<a href="#">TV & Điện tử</a>
									<?php endif; ?>
								</li>
							</ul>

							<ul class="product-links">
								<li>Chia sẻ:</li>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
								<li><a href="#"><i class="fa fa-envelope"></i></a></li>
							</ul>

						</div>
					</div>
					<!-- /Product details -->

					<!-- Product tab -->
					<div class="col-md-12">
						<div id="product-tab">
							<!-- product tab nav -->
							<ul class="tab-nav">
								<li class="active"><a data-toggle="tab" href="#tab1">Mô tả</a></li>
								<li><a data-toggle="tab" href="#tab2">Chi tiết</a></li>
								<li><a data-toggle="tab" href="#tab3">Đánh giá (3)</a></li>
							</ul>
							<!-- /product tab nav -->

							<!-- product tab content -->
							<div class="tab-content">
								<!-- tab1  -->
								<div id="tab1" class="tab-pane fade in active">
									<div class="row">
										<div class="col-md-12">
											<p><?= isset($product) ? nl2br(htmlspecialchars($product['description'])) : 'Mô tả chi tiết về sản phẩm sẽ được hiển thị ở đây. Bao gồm các thông tin về tính năng, thông số kỹ thuật và ưu điểm của sản phẩm.' ?></p>
										</div>
									</div>
								</div>
								<!-- /tab1  -->

								<!-- tab2  -->
								<div id="tab2" class="tab-pane fade in">
									<div class="row">
										<div class="col-md-12">
											<?php if (isset($product)): ?>
												<h4>Thông số kỹ thuật</h4>
												<ul>
													<li><strong>Tên sản phẩm:</strong> <?= htmlspecialchars($product['name']) ?></li>
													<li><strong>Danh mục:</strong> <?= htmlspecialchars($product['category_name']) ?></li>
													<li><strong>Giá:</strong> <?= number_format($product['price'], 0, ',', '.') ?>₫</li>
													<li><strong>Tình trạng:</strong> Còn hàng</li>
												</ul>
											<?php else: ?>
												<p>Thông tin chi tiết về sản phẩm sẽ được hiển thị ở đây.</p>
											<?php endif; ?>
										</div>
									</div>
								</div>
								<!-- /tab2  -->

								<!-- tab3  -->
								<div id="tab3" class="tab-pane fade in">
									<div class="row">
										<!-- Rating -->
										<div class="col-md-3">
											<div id="rating">
												<div class="rating-avg">
													<span>4.5</span>
													<div class="rating-stars">
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star"></i>
														<i class="fa fa-star-o"></i>
													</div>
												</div>
												<ul class="rating">
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 80%;"></div>
														</div>
														<span class="sum">3</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div style="width: 60%;"></div>
														</div>
														<span class="sum">2</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
													<li>
														<div class="rating-stars">
															<i class="fa fa-star"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
															<i class="fa fa-star-o"></i>
														</div>
														<div class="rating-progress">
															<div></div>
														</div>
														<span class="sum">0</span>
													</li>
												</ul>
											</div>
										</div>
										<!-- /Rating -->

										<!-- Reviews -->
										<div class="col-md-6">
											<div id="reviews">
												<ul class="reviews">
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
														</div>
													</li>
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
														</div>
													</li>
													<li>
														<div class="review-heading">
															<h5 class="name">John</h5>
															<p class="date">27 DEC 2018, 8:0 PM</p>
															<div class="review-rating">
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star"></i>
																<i class="fa fa-star-o empty"></i>
															</div>
														</div>
														<div class="review-body">
															<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua</p>
														</div>
													</li>
												</ul>
												<ul class="reviews-pagination">
													<li class="active">1</li>
													<li><a href="#">2</a></li>
													<li><a href="#">3</a></li>
													<li><a href="#">4</a></li>
													<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
												</ul>
											</div>
										</div>
										<!-- /Reviews -->

										<!-- Review Form -->
										<div class="col-md-3">
											<div id="review-form">
												<form class="review-form">
													<input class="input" type="text" placeholder="Tên của bạn">
													<input class="input" type="email" placeholder="Email của bạn">
													<textarea class="input" placeholder="Đánh giá của bạn"></textarea>
													<div class="input-rating">
														<span>Xếp hạng: </span>
														<div class="stars">
															<input id="star5" name="rating" value="5" type="radio"><label for="star5"></label>
															<input id="star4" name="rating" value="4" type="radio"><label for="star4"></label>
															<input id="star3" name="rating" value="3" type="radio"><label for="star3"></label>
															<input id="star2" name="rating" value="2" type="radio"><label for="star2"></label>
															<input id="star1" name="rating" value="1" type="radio"><label for="star1"></label>
														</div>
													</div>
													<button class="primary-btn">Gửi đánh giá</button>
												</form>
											</div>
										</div>
										<!-- /Review Form -->
									</div>
								</div>
								<!-- /tab3  -->
							</div>
							<!-- /product tab content  -->
						</div>
					</div>
					<!-- /product tab -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- Section -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<div class="col-md-12">
						<div class="section-title text-center">
							<h3 class="title">Sản phẩm liên quan</h3>
						</div>
					</div>

					<?php if (isset($relatedProducts) && !empty($relatedProducts)): ?>
						<?php foreach ($relatedProducts as $relatedProduct): ?>
							<!-- product -->
							<div class="col-md-3 col-xs-6">
								<div class="product">
									<div class="product-img">
										<?php if (!empty($relatedProduct['images'])): ?>
											<img src="/qlbanhang/public/uploads/products/<?= htmlspecialchars($relatedProduct['images']) ?>" alt="<?= htmlspecialchars($relatedProduct['name']) ?>">
										<?php else: ?>
											<img src="/qlbanhang/public/assets/img/frontend/product01.png" alt="<?= htmlspecialchars($relatedProduct['name']) ?>">
										<?php endif; ?>
									</div>
									<div class="product-body">
										<p class="product-category"><?= htmlspecialchars($relatedProduct['category_name']) ?></p>
										<h3 class="product-name"><a href="/qlbanhang/frontend.php?page=product-detail&id=<?= $relatedProduct['id'] ?>"><?= htmlspecialchars($relatedProduct['name']) ?></a></h3>
										<h4 class="product-price"><?= number_format($relatedProduct['price'], 0, ',', '.') ?>₫</h4>
										<div class="product-rating">
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star"></i>
											<i class="fa fa-star-o"></i>
										</div>
										<div class="product-btns">
											<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">thêm vào yêu thích</span></button>
											<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">so sánh</span></button>
											<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">xem nhanh</span></button>
										</div>
									</div>
									<div class="add-to-cart">
										<button class="add-to-cart-btn" data-product-id="<?= $relatedProduct['id'] ?>"><i class="fa fa-shopping-cart"></i> thêm vào giỏ</button>
									</div>
								</div>
							</div>
							<!-- /product -->
						<?php endforeach; ?>
					<?php else: ?>
						<div class="col-md-12 text-center">
							<p>Không có sản phẩm liên quan nào.</p>
						</div>
					<?php endif; ?>

				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /Section -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Đăng ký nhận <strong>BẢN TIN</strong></p>
							<form>
								<input class="input" type="email" placeholder="Nhập email của bạn">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Đăng ký</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /NEWSLETTER -->

		<!-- FOOTER -->
		<footer id="footer">
			<!-- top footer -->
			<div class="section">
				<!-- container -->
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Về Chúng Tôi</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>I - Tech</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>0982 905 207</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>tvstore@gmail.com</a></li>
								</ul>
							</div>
						</div>

												<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Danh Mục</h3>
								<ul class="footer-links">
									
									<li><a href="#">Tivi Samsung</a></li>
									<li><a href="#">Tivi LG</a></li>
									<li><a href="#">Tivi Sony</a></li>
									<li><a href="#">Tivi Xiaomi</a></li>
									<li><a href="#">Tivi Toshiba</a></li>
									
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Thông Tin</h3>
								<ul class="footer-links">
									<li><a href="#">Thông tin</a></li>
									<li><a href="#">Liên hệ </a></li>
									<li><a href="#">Chính sách bảo mật</a></li>
									<li><a href="#">Đơn hàng và trả hàng</a></li>
									<li><a href="#">Điều khoản & Điều kiện</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Dịch Vụ</h3>
								<ul class="footer-links">
									<li><a href="#">Tài khoản </a></li>
									<li><a href="#">Giỏ hàng</a></li>
									<li><a href="#">Danh sách yêu thích</a></li>
									<li><a href="#">Theo dõi đơn hàng</a></li>
									<li><a href="#">Trợ giúp</a></li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /top footer -->

			<!-- bottom footer -->
			<div id="bottom-footer" class="section">
				<div class="container">
					<!-- row -->
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
								Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</span>
						</div>
					</div>
						<!-- /row -->
				</div>
				<!-- /container -->
			</div>
			<!-- /bottom footer -->
		</footer>
		<!-- /FOOTER -->

		<!-- Thư viện JavaScript cần thiết -->
		<script src="/qlbanhang/public/assets/js/frontend/jquery.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/bootstrap.min.js"></script>
		
		<!-- Script chức năng chính -->
		<script>
		// Hiển thị thông báo
		function showNotification(message, isError = false) {
			// Xóa thông báo đã có
			const existingNotification = document.querySelector('.cart-notification');
			if (existingNotification) {
				existingNotification.remove();
			}
			
			// Tạo thông báo mới
			const notification = document.createElement('div');
			notification.className = 'cart-notification' + (isError ? ' error' : '');
			notification.innerHTML = `
				<i class="fa fa-shopping-cart"></i>
				<span>${message}</span>
			`;
			
			document.body.appendChild(notification);
			
			// Show notification
			setTimeout(() => notification.classList.add('show'), 100);
			
			// Hide notification after 3 seconds
			setTimeout(() => {
				notification.classList.remove('show');
				setTimeout(() => notification.remove(), 300);
			}, 3000);
		}

		// Update cart display function
		function updateCartDisplay(cart) {
			console.log('📊 Updating cart display with:', cart);
			
			// Cập nhật số lượng trong header
			const cartCountElement = document.getElementById('cart-count');
			if (cartCountElement) {
				cartCountElement.textContent = cart.totalItems || 0;
			}
			
			// Reload page để cập nhật dropdown (simple approach)
			setTimeout(() => {
				window.location.reload();
			}, 1500);
		}

		// Remove from cart function
		function removeFromCart(productId) {
			console.log('�️ Removing product:', productId);
			
			fetch('/qlbanhang/frontend.php?action=remove-from-cart', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded',
				},
				body: `product_id=${productId}`
			})
			.then(response => response.json())
			.then(data => {
				console.log('📄 Remove response:', data);
				if (data.success) {
					showNotification('Đã xóa sản phẩm khỏi giỏ hàng');
					updateCartDisplay(data);
				} else {
					showNotification('Có lỗi xảy ra khi xóa sản phẩm', true);
				}
			})
			.catch(error => {
				console.error('❌ Remove error:', error);
				showNotification('Có lỗi xảy ra khi xóa sản phẩm khỏi giỏ hàng', true);
			});
		}

		// Toggle cart dropdown
		function toggleCart(event) {
			event.preventDefault();
			event.stopPropagation();
			
			const cartDropdown = document.getElementById('cart-dropdown');
			if (cartDropdown) {
				cartDropdown.classList.toggle('show');
				
				// Close when clicking outside
				if (cartDropdown.classList.contains('show')) {
					document.addEventListener('click', function closeCart(e) {
						if (!e.target.closest('.header-ctn')) {
							cartDropdown.classList.remove('show');
							document.removeEventListener('click', closeCart);
						}
					});
				}
			}
		}

		// DOM ready event
		document.addEventListener('DOMContentLoaded', function() {
			console.log('🚀 Product.php DOM ready');
			
			// Event listener cho các nút xóa trong dropdown
			document.querySelectorAll('.remove-from-cart').forEach(button => {
				button.addEventListener('click', function() {
					const productId = this.dataset.productId;
					console.log('�️ Remove from cart button clicked for product:', productId);
					removeFromCart(productId);
				});
			});

			// Add to cart functionality
			const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
			console.log('🔍 Found add to cart buttons:', addToCartButtons.length);
			
			addToCartButtons.forEach(function(button) {
				button.addEventListener('click', function(e) {
					e.preventDefault();
					e.stopPropagation();
					
					const productId = this.getAttribute('data-product-id');
					if (!productId) {
						showNotification('Không tìm thấy thông tin sản phẩm', true);
						return;
					}

					// Get quantity
					const quantityInput = document.getElementById('product-quantity');
					let quantity = 1;
					if (quantityInput && this.closest('.product-details')) {
						quantity = parseInt(quantityInput.value) || 1;
					}
					
					console.log('🛍️ Adding product:', productId, 'quantity:', quantity);
					
					// Disable button temporarily
					this.disabled = true;
					this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Đang thêm...';
					
					// Send AJAX request
					const formData = new FormData();
					formData.append('product_id', productId);
					formData.append('quantity', quantity);
					
					fetch('/qlbanhang/frontend.php?action=add-to-cart', {
						method: 'POST',
						body: formData
					})
					.then(response => response.json())
					.then(data => {
						console.log('✅ Add to cart response:', data);
						
						if (data.success) {
							showNotification('Đã thêm vào giỏ hàng thành công! 🎉');
							updateCartDisplay(data);
						} else {
							showNotification('Lỗi: ' + data.message, true);
						}
					})
					.catch(error => {
						console.error('❌ Add to cart error:', error);
						showNotification('Có lỗi xảy ra', true);
					})
					.finally(() => {
						// Re-enable button
						this.disabled = false;
						this.innerHTML = '<i class="fa fa-shopping-cart"></i> Thêm vào giỏ';
					});
				});
			});

			// Quantity input controls
			const quantityInput = document.getElementById('product-quantity');
			const qtyUp = document.querySelector('.qty-up');
			const qtyDown = document.querySelector('.qty-down');

			if (qtyUp && quantityInput) {
				qtyUp.addEventListener('click', function() {
					let currentValue = parseInt(quantityInput.value) || 1;
					quantityInput.value = currentValue + 1;
				});
			}

			if (qtyDown && quantityInput) {
				qtyDown.addEventListener('click', function() {
					let currentValue = parseInt(quantityInput.value) || 1;
					if (currentValue > 1) {
						quantityInput.value = currentValue - 1;
					}
				});
			}
		});
		</script>

	</body>
</html>