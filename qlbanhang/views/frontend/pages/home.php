<?php
// Debug: kiểm tra dữ liệu được truyền từ controller
if (!isset($featuredProducts)) {
    // Nếu không có dữ liệu từ controller, load trực tiếp
    require_once __DIR__ . '/../../../config/database.php';
    require_once __DIR__ . '/../../../models/product.php';
    require_once __DIR__ . '/../../../models/category.php';
    
    $productModel = new Product();
    $categoryModel = new Category();
    
    $featuredProducts = $productModel->getFeatured(8);
    $newProducts = $productModel->getLatest(8);
    $categories = $categoryModel->getAll();
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>TV Store - Cửa hàng điện tử</title>

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
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="/qlbanhang/public/assets/css/frontend/style.css"/>

		<!-- Custom cart notification styles -->
		<style>
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
		
		/* Debug styles */
		.debug-dropdown {
			background: red !important;
			color: white !important;
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
						<li><a href="#"><i class="fa fa-envelope-o"></i> tvstore@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> I-tech</a></li>
					</ul>
					<ul class="header-links pull-right">
						<?php 
						// Khởi tạo AuthController để check login status
						if (!class_exists('AuthController')) {
							require_once 'controllers/authController.php';
						}
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
								<a href="#" class="logo">
									<img src="/qlbanhang/public/assets/img/frontend/logo.png" alt="">
								</a>
							</div>
						</div>
						<!-- /LOGO -->

						<!-- SEARCH BAR -->
						<div class="col-md-6">
							<div class="header-search">
								<form>
									<select class="input-select">
										<option value="0">Danh mục</option>
										<option value="1">Danh mục 01</option>
										<option value="1">Danh mục 02</option>
									</select>
									<input class="input" placeholder="Tìm kiếm">
									<button class="search-btn">Tìm Kiếm</button>
								</form>
							</div>
						</div>
						<!-- /SEARCH BAR -->

						<!-- ACCOUNT -->
						<div class="col-md-3 clearfix">
							<div class="header-ctn">
								<!-- Cart -->
								<div>
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true" onclick="toggleCart(event)">
										<i class="fa fa-shopping-cart"></i>
										<span>Giỏ hàng</span>
										<div class="qty" id="cart-count"><?php echo isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0; ?></div>
									</a>
									<div class="cart-dropdown" id="cart-dropdown">
										<div class="cart-list" id="cart-items">
											<?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])): ?>
												<?php 
												$totalPrice = 0;
												foreach ($_SESSION['cart'] as $item): 
													$totalPrice += $item['price'] * $item['quantity'];
													
													// Debug để xem structure của item
													error_log('Cart Item: ' . print_r($item, true));
												?>
													<div class="product-widget">
														<div class="product-img">
															<?php 
															// Kiểm tra key nào có sẵn: 'image' hoặc 'images'
															$imageKey = isset($item['images']) ? 'images' : (isset($item['image']) ? 'image' : '');
															$imagePath = $imageKey ? $item[$imageKey] : 'default.jpg';
															?>
															<img src="/qlbanhang/public/uploads/products/<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>">
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
												<small id="cart-total-items"><?php echo array_sum(array_column($_SESSION['cart'], 'quantity')); ?> sản phẩm đã chọn</small>
												<h5 id="cart-total-price">TỔNG: <?php echo number_format($totalPrice ?? 0); ?>đ</h5>
											</div>
											<div class="cart-btns">
												<a href="/qlbanhang/frontend.php?page=cart">Xem giỏ hàng</a>
												<a href="/qlbanhang/frontend.php?page=checkout">Thanh toán <i class="fa fa-arrow-circle-right"></i></a>
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
						<li class="active"><a href="/qlbanhang/frontend.php">Trang chủ</a></li>
						<li class="dropdown" style="position: relative;">
							<a href="/qlbanhang/frontend.php?page=products" class="dropdown-toggle">
								Tất cả sản phẩm <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu" style="position: absolute; top: 100%; left: 0; background: #fff; border: 1px solid #e4e7ed; box-shadow: 0 4px 12px rgba(0,0,0,0.1); min-width: 200px; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.3s ease; z-index: 1000; display: block; list-style: none; padding: 0; margin: 0;">
								<?php if (isset($categories) && !empty($categories)): ?>
									<?php foreach ($categories as $category): ?>
										<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="/qlbanhang/frontend.php?page=products&category=<?= $category['id'] ?>" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;"><?= htmlspecialchars($category['name']) ?></a></li>
									<?php endforeach; ?>
								<?php else: ?>
									<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="#" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi OLED</a></li>
									<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="#" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi 4K</a></li>
									<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="#" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi Samsung</a></li>
									<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="#" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi LG</a></li>
									<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="#" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi Sony</a></li>
									<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="#" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi Xiaomi</a></li>
									<li style="display: block; border-bottom: none; width: 100%; float: none;"><a href="#" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi Toshiba</a></li>
								<?php endif; ?>
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

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="/qlbanhang/public/assets/img/frontend/shop01.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Tivi OLED<br></h3>
								<a href="#" class="cta-btn">Mua ngay <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="/qlbanhang/public/assets/img/frontend/shop03.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Tivi 4k<br></h3>
								<a href="#" class="cta-btn">Mua ngay <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->

					<!-- shop -->
					<div class="col-md-4 col-xs-6">
						<div class="shop">
							<div class="shop-img">
								<img src="/qlbanhang/public/assets/img/frontend/shop02.png" alt="">
							</div>
							<div class="shop-body">
								<h3>Tivi QLED<br></h3>
								<a href="#" class="cta-btn">Mua ngay <i class="fa fa-arrow-circle-right"></i></a>
							</div>
						</div>
					</div>
					<!-- /shop -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Sản Phẩm Mới</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<li class="active"><a data-toggle="tab" href="#tab1">Tivi OLED </a></li>
									<li><a data-toggle="tab" href="#tab1">Tivi 4K</a></li>
									<li><a data-toggle="tab" href="#tab1">Tivi QLED</a></li>
									<!-- <li><a data-toggle="tab" href="#tab1">Accessories</a></li> -->
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab1" class="tab-pane active">
									<div class="products-slick" data-nav="#slick-nav-1">
										<?php if (isset($newProducts) && !empty($newProducts)): ?>
											<?php foreach ($newProducts as $product): ?>
												<!-- product -->
												<div class="product">
													<div class="product-img">
														<?php if (!empty($product['images'])): ?>
															<img src="/qlbanhang/public/uploads/products/<?= htmlspecialchars($product['images']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
														<?php else: ?>
															<img src="/qlbanhang/public/assets/img/frontend/no-image.png" alt="<?= htmlspecialchars($product['name']) ?>">
														<?php endif; ?>
														<div class="product-label">
															<span class="new">MỚI</span>
														</div>
													</div>
													<div class="product-body">
														<p class="product-category"><?= htmlspecialchars($product['category_name'] ?? 'Chưa phân loại') ?></p>
														<h3 class="product-name"><a href="/qlbanhang/frontend.php?page=product-detail&id=<?= $product['id'] ?>"><?= htmlspecialchars($product['name']) ?></a></h3>
														<h4 class="product-price"><?= number_format($product['price'], 0, ',', '.') ?>đ</h4>
														<div class="product-rating">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="product-btns">
															<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Yêu thích</span></button>
															<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">So sánh</span></button>
															<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Xem nhanh</span></button>
														</div>
													</div>
													<div class="add-to-cart">
														<button class="add-to-cart-btn" data-product-id="<?= $product['id'] ?>"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
													</div>
												</div>
												<!-- /product -->
											<?php endforeach; ?>
										<?php else: ?>
											<div class="text-center">
												<p>Chưa có sản phẩm nào.</p>
											</div>
										<?php endif; ?>
									</div>
									<div id="slick-nav-1" class="products-slick-nav"></div>
								</div>

		<!-- HOT DEAL SECTION -->
		<div id="hot-deal" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="hot-deal">
							<ul class="hot-deal-countdown">
								<li>
									<div>
										<h3>02</h3>
										<span>Ngày</span>
									</div>
								</li>
								<li>
									<div>
										<h3>10</h3>
										<span>Tiếng</span>
									</div>
								</li>
								<li>
									<div>
										<h3>34</h3>
										<span>Phút</span>
									</div>
								</li>
								<li>
									<div>
										<h3>60</h3>
										<span>Giây  </span>
									</div>
								</li>
							</ul>
							<h2 class="text-uppercase">Khuyến mãi hot trong tuần</h2>
							<p> Bộ sưu tập mới giảm giá lên đến 50%</p>
							<a class="primary-btn cta-btn" href="#">Mua ngay</a>
						</div>
					</div>
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /HOT DEAL SECTION -->

		<!-- SECTION -->
		<div class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">

					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h3 class="title">Sản phẩm nổi bật</h3>
							<div class="section-nav">
								<ul class="section-tab-nav tab-nav">
									<?php if (isset($categories) && !empty($categories)): ?>
										<?php foreach (array_slice($categories, 0, 3) as $index => $category): ?>
											<li <?= $index === 0 ? 'class="active"' : '' ?>><a data-toggle="tab" href="#tab2"><?= htmlspecialchars($category['name']) ?></a></li>
										<?php endforeach; ?>
									<?php else: ?>
										<li class="active"><a data-toggle="tab" href="#tab2">Tivi OLED</a></li>
										<li><a data-toggle="tab" href="#tab2">Tivi 4K</a></li>
									<?php endif; ?>
								</ul>
							</div>
						</div>
					</div>
					<!-- /section title -->

					<!-- Products tab & slick -->
					<div class="col-md-12">
						<div class="row">
							<div class="products-tabs">
								<!-- tab -->
								<div id="tab2" class="tab-pane fade in active">
									<div class="products-slick" data-nav="#slick-nav-2">
										<?php if (isset($featuredProducts) && !empty($featuredProducts)): ?>
											<?php foreach ($featuredProducts as $product): ?>
												<!-- product -->
												<div class="product">
													<div class="product-img">
														<?php if (!empty($product['images'])): ?>
															<img src="/qlbanhang/public/uploads/products/<?= htmlspecialchars($product['images']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
														<?php else: ?>
															<img src="/qlbanhang/public/assets/img/frontend/no-image.png" alt="<?= htmlspecialchars($product['name']) ?>">
														<?php endif; ?>
														<div class="product-label">
															<span class="sale">NỔI BẬT</span>
														</div>
													</div>
													<div class="product-body">
														<p class="product-category"><?= htmlspecialchars($product['category_name'] ?? 'Chưa phân loại') ?></p>
														<h3 class="product-name"><a href="/qlbanhang/frontend.php?page=product-detail&id=<?= $product['id'] ?>"><?= htmlspecialchars($product['name']) ?></a></h3>
														<h4 class="product-price"><?= number_format($product['price'], 0, ',', '.') ?>đ</h4>
														<div class="product-rating">
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
															<i class="fa fa-star"></i>
														</div>
														<div class="product-btns">
															<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">Yêu thích</span></button>
															<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">So sánh</span></button>
															<button class="quick-view"><i class="fa fa-eye"></i><span class="tooltipp">Xem nhanh</span></button>
														</div>
													</div>
													<div class="add-to-cart">
														<button class="add-to-cart-btn" data-product-id="<?= $product['id'] ?>"><i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng</button>
													</div>
												</div>
												<!-- /product -->
											<?php endforeach; ?>
										<?php else: ?>
											<div class="text-center">
												<p>Chưa có sản phẩm nổi bật nào.</p>
											</div>
										<?php endif; ?>
									</div>
									<div id="slick-nav-2" class="products-slick-nav"></div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
								<!-- /tab -->
							</div>
						</div>
					</div>
					<!-- /Products tab & slick -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->



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
									<li><a href="#"><i class="fa fa-envelope-o"></i>tvstore@email.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Danh Mục</h3>
								<ul class="footer-links">
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Tivi OLED</a></li>
									<li><a href="#">Tivi 4K</a></li>
									<li><a href="#">Tivi QLED</a></li>
									<!-- <li><a href="#">Accessories</a></li> -->
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
								<!-- Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> -->
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

		<!-- jQuery Plugins -->
		<script src="/qlbanhang/public/assets/js/frontend/jquery.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/bootstrap.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/slick.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/nouislider.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/jquery.zoom.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/main.js"></script>
		
		<!-- Cart Script -->
		<script>
			console.log('🛒 CART SCRIPT LOADED IN HOME.PHP');
			
			// Navigation dropdown functionality  
			document.addEventListener('DOMContentLoaded', function() {
				const navDropdowns = document.querySelectorAll('.main-nav .dropdown');
				console.log('🔍 Found navigation dropdowns:', navDropdowns.length);
				
				navDropdowns.forEach(function(dropdown) {
					const dropdownMenu = dropdown.querySelector('.dropdown-menu');
					console.log('📋 Dropdown menu found:', dropdownMenu);
					
					if (dropdownMenu) {
						// Mouse enter
						dropdown.addEventListener('mouseenter', function() {
							console.log('🖱️ Mouse enter dropdown');
							dropdownMenu.style.opacity = '1';
							dropdownMenu.style.visibility = 'visible';
							dropdownMenu.style.transform = 'translateY(0)';
							dropdownMenu.style.display = 'block';
						});
						
						// Mouse leave
						dropdown.addEventListener('mouseleave', function() {
							console.log('🖱️ Mouse leave dropdown');
							dropdownMenu.style.opacity = '0';
							dropdownMenu.style.visibility = 'hidden';
							dropdownMenu.style.transform = 'translateY(-10px)';
						});
					}
				});
			});
			
			// Show notification function
			function showNotification(message, isError = false) {
				// Remove existing notification
				const existingNotification = document.querySelector('.cart-notification');
				if (existingNotification) {
					existingNotification.remove();
				}
				
				// Create new notification
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

			function removeFromCart(productId) {
				console.log('🗑️ Removing product:', productId);
				
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
			
			// Simple direct approach
			document.addEventListener('DOMContentLoaded', function() {
				console.log('🟢 DOM ready - attaching cart events');
				
				// Event listener cho các nút xóa đã có sẵn trong header
				document.querySelectorAll('.remove-from-cart').forEach(button => {
					button.addEventListener('click', function() {
						const productId = this.dataset.productId;
						console.log('🗑️ Remove from cart button clicked for product:', productId);
						removeFromCart(productId);
					});
				});
				
				// Find all add to cart buttons
				const buttons = document.querySelectorAll('.add-to-cart-btn');
				console.log('🔍 Found buttons:', buttons.length);
				
				buttons.forEach(function(button, index) {
					console.log('🎯 Button ' + index + ':', button);
					console.log('📦 Product ID:', button.getAttribute('data-product-id'));
					
					button.addEventListener('click', function(e) {
						console.log('🔥 BUTTON CLICKED!');
						e.preventDefault();
						e.stopPropagation();
						
						const productId = this.getAttribute('data-product-id');
						console.log('🛍️ Adding product:', productId);
						
						// Disable button temporarily
						this.disabled = true;
						this.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Đang thêm...';
						
						// Simple AJAX
						const formData = new FormData();
						formData.append('product_id', productId);
						formData.append('quantity', 1);
						
						console.log('📡 Sending request...');
						
						fetch('/qlbanhang/frontend.php?action=add-to-cart', {
							method: 'POST',
							body: formData
						})
						.then(response => {
							console.log('📥 Response:', response.status);
							return response.json();
						})
						.then(data => {
							console.log('✅ JSON:', data);
							
							if (data.success) {
								showNotification('Đã thêm vào giỏ hàng thành công! 🎉');
								updateCartDisplay(data);
							} else {
								showNotification('Lỗi: ' + data.message, true);
							}
						})
						.catch(error => {
							console.error('❌ Error:', error);
							showNotification('Có lỗi xảy ra', true);
						})
						.finally(() => {
							// Re-enable button
							this.disabled = false;
							this.innerHTML = '<i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng';
						});
					});
				});
			});
		</script>

		<!-- jQuery Plugins -->
		<script src="/qlbanhang/public/assets/js/frontend/jquery.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/bootstrap.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/slick.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/nouislider.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/jquery.zoom.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/main.js"></script>

	</body>
</html>
