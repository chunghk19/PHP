<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title>Đặt hàng - TV Store</title>

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
			z-index: 1000 !important;
			opacity: 0 !important;
			visibility: hidden !important;
			transform: translateY(-10px) !important;
			transition: all 0.3s ease !important;
		}
		
		.main-nav .dropdown:hover .dropdown-menu {
			opacity: 1 !important;
			visibility: visible !important;
			transform: translateY(0) !important;
		}
		
		.main-nav .dropdown-menu li {
			display: block !important;
			width: 100% !important;
			float: none !important;
			border-bottom: 1px solid #f0f0f0 !important;
		}
		
		.main-nav .dropdown-menu li:last-child {
			border-bottom: none !important;
		}
		
		.main-nav .dropdown-menu li a {
			display: block !important;
			padding: 10px 15px !important;
			color: #333 !important;
			text-decoration: none !important;
			text-transform: none !important;
			font-size: 14px !important;
			transition: all 0.3s ease !important;
		}
		
		.main-nav .dropdown-menu li a:hover {
			background-color: #f8f9fa !important;
			color: #D10024 !important;
		}

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

		/* Cart dropdown fixes */
		.cart-dropdown {
			opacity: 0;
			visibility: hidden;
			transition: all 0.3s ease;
			position: absolute !important;
			top: 100% !important;
			right: 0 !important;
			background: #fff !important;
			border: 1px solid #e4e7ed !important;
			box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
			min-width: 300px !important;
			z-index: 1000 !important;
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

		.product-widget .product-name a {
			color: #333 !important;
			text-decoration: none !important;
		}

		.product-widget .product-price {
			font-size: 12px;
			color: #D10024;
			margin: 0;
			font-weight: bold;
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
			padding: 15px !important;
			border-top: 1px solid #f0f0f0 !important;
			background: #f8f9fa !important;
		}

		.cart-summary small {
			display: block !important;
			margin-bottom: 5px !important;
			color: #666 !important;
		}

		.cart-summary h5 {
			margin: 0 !important;
			color: #D10024 !important;
			font-weight: bold !important;
		}

		.cart-btns {
			padding: 15px !important;
		}

		.cart-btns .btn-checkout-only {
			display: block !important;
			width: 100% !important;
			text-align: center !important;
			padding: 10px !important;
			background: #D10024 !important;
			color: #fff !important;
			text-decoration: none !important;
			border-radius: 4px !important;
			transition: all 0.3s ease !important;
		}

		.cart-btns .btn-checkout-only:hover {
			background: #b8001f !important;
			color: #fff !important;
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
						<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
						<?php 
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
										<option value="1">Tivi OLED</option>
										<option value="2">Tivi 4K</option>
										<option value="3">Tivi Samsung</option>
										<option value="4">Tivi LG</option>
										<option value="5">Tivi Sony</option>
										<option value="6">Tivi Xiaomi</option>
										<option value="7">Tivi Toshiba</option>
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
								<!-- Wishlist -->
								
								<!-- /Wishlist -->

								<!-- Cart -->
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
						<li class="active"><a href="/qlbanhang/frontend.php">Trang chủ</a></li>
						<li class="dropdown" style="position: relative;">
							<a href="/qlbanhang/frontend.php?page=store" class="dropdown-toggle">
								Tất cả sản phẩm <i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu" style="position: absolute; top: 100%; left: 0; background: #fff; border: 1px solid #e4e7ed; box-shadow: 0 4px 12px rgba(0,0,0,0.1); min-width: 200px; opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.3s ease; z-index: 1000; display: block; list-style: none; padding: 0; margin: 0;">
								<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="/qlbanhang/frontend.php?page=store&category=1" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi OLED</a></li>
								<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="/qlbanhang/frontend.php?page=store&category=2" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi 4K</a></li>
								<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="/qlbanhang/frontend.php?page=store&category=3" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi Samsung</a></li>
								<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="/qlbanhang/frontend.php?page=store&category=4" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi LG</a></li>
								<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="/qlbanhang/frontend.php?page=store&category=5" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi Sony</a></li>
								<li style="display: block; border-bottom: 1px solid #f0f0f0; width: 100%; float: none;"><a href="/qlbanhang/frontend.php?page=store&category=6" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi Xiaomi</a></li>
								<li style="display: block; border-bottom: none; width: 100%; float: none;"><a href="/qlbanhang/frontend.php?page=store&category=7" style="display: block; padding: 10px 15px; color: #333; text-decoration: none; transition: all 0.3s ease; text-transform: none; font-size: 14px;">Tivi Toshiba</a></li>
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
						<h3 class="breadcrumb-header">Checkout</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Home</a></li>
							<li class="active">Checkout</li>
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

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Thông tin giao hàng</h3>
							</div>
							<form id="checkout-form">
								<div class="form-group">
									<input class="input" type="text" name="customer_name" id="customer_name" placeholder="Họ và tên" required>
								</div>
								<div class="form-group">
									<input class="input" type="email" name="customer_email" id="customer_email" placeholder="Email" required>
								</div>
								<div class="form-group">
									<input class="input" type="text" name="delivery_address" id="delivery_address" placeholder="Địa chỉ giao hàng" required>
								</div>
								<div class="form-group">
									<input class="input" type="tel" name="customer_phone" id="customer_phone" placeholder="Số điện thoại" required>
								</div>
								
								<!-- Order notes -->
								<div class="order-notes">
									<textarea class="input" name="notes" id="notes" placeholder="Ghi chú đơn hàng"></textarea>
								</div>
								<!-- /Order notes -->
							</form>
						</div>
						<!-- /Billing Details -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Đơn hàng của bạn</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>SẢN PHẨM</strong></div>
								<div><strong>TỔNG</strong></div>
							</div>
							<div class="order-products">
								<?php 
								$total = 0;
								if (!empty($_SESSION['cart'])): 
									foreach ($_SESSION['cart'] as $product_id => $item): 
										$subtotal = $item['price'] * $item['quantity'];
										$total += $subtotal;
								?>
									<div class="order-col">
										<div><?= $item['quantity'] ?>x <?= $item['name'] ?></div>
										<div><?= number_format($subtotal) ?>₫</div>
									</div>
								<?php 
									endforeach; 
								else:
								?>
									<div class="order-col">
										<div>Giỏ hàng trống</div>
										<div>0₫</div>
									</div>
								<?php endif; ?>
							</div>
							<div class="order-col">
								<div>Phí vận chuyển</div>
								<div><strong>MIỄN PHÍ</strong></div>
							</div>
							<div class="order-col">
								<div><strong>TỔNG CỘNG</strong></div>
								<div><strong class="order-total"><?= number_format($total) ?>₫</strong></div>
							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1" checked>
								<label for="payment-1">
									<span></span>
									Thanh toán khi nhận hàng
								</label>
								<div class="caption">
									<p>Thanh toán bằng tiền mặt khi nhận hàng tại địa chỉ của bạn.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-2">
								<label for="payment-2">
									<span></span>
									Chuyển khoản ngân hàng
								</label>
								<div class="caption">
									<p>Chuyển khoản trực tiếp vào tài khoản ngân hàng của chúng tôi.</p>
								</div>
							</div>
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-3">
								<label for="payment-3">
									<span></span>
									Ví điện tử MoMo
								</label>
								<div class="caption">
									<p>Thanh toán nhanh chóng và an toàn qua ví điện tử MoMo.</p>
								</div>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms" required>
							<label for="terms">
								<span></span>
								Tôi đã đọc và đồng ý với <a href="#">điều khoản & điều kiện</a>
							</label>
						</div>
						<button type="button" onclick="submitOrder()" class="primary-btn order-submit" style="background-color: #D10024 !important; border-color: #D10024 !important;">Đặt hàng</button>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->

		<!-- NEWSLETTER -->
		<div id="newsletter" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Đăng ký nhận <strong>TIN TỨC MỚI NHẤT</strong></p>
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
								<h3 class="footer-title">About Us</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">Smartphones</a></li>
									<li><a href="#">Cameras</a></li>
									<li><a href="#">Accessories</a></li>
								</ul>
							</div>
						</div>

						<div class="clearfix visible-xs"></div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>

						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
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

		<!-- jQuery Plugins -->
		<script src="/qlbanhang/public/assets/js/frontend/jquery.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/bootstrap.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/slick.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/nouislider.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/jquery.zoom.min.js"></script>
		<script src="/qlbanhang/public/assets/js/frontend/main.js"></script>
		
		<script>
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

		// Remove from cart function
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

		// Navigation dropdown functionality  
		document.addEventListener('DOMContentLoaded', function() {
			// Event listener cho các nút xóa trong dropdown
			document.querySelectorAll('.remove-from-cart').forEach(button => {
				button.addEventListener('click', function() {
					const productId = this.dataset.productId;
					console.log('🗑️ Remove from cart button clicked for product:', productId);
					removeFromCart(productId);
				});
			});

			const navDropdowns = document.querySelectorAll('.main-nav .dropdown');
			console.log('🔍 Found navigation dropdowns in checkout.php:', navDropdowns.length);
			
			navDropdowns.forEach(function(dropdown) {
				const dropdownMenu = dropdown.querySelector('.dropdown-menu');
				console.log('📋 Dropdown menu found:', dropdownMenu);
				
				if (dropdownMenu) {
					// Mouse enter
					dropdown.addEventListener('mouseenter', function() {
						console.log('🖱️ Mouse enter dropdown in checkout.php');
						dropdownMenu.style.opacity = '1';
						dropdownMenu.style.visibility = 'visible';
						dropdownMenu.style.transform = 'translateY(0)';
						dropdownMenu.style.display = 'block';
					});
					
					// Mouse leave
					dropdown.addEventListener('mouseleave', function() {
						console.log('🖱️ Mouse leave dropdown in checkout.php');
						dropdownMenu.style.opacity = '0';
						dropdownMenu.style.visibility = 'hidden';
						dropdownMenu.style.transform = 'translateY(-10px)';
					});
				}
			});
		});

		// Hàm xử lý đặt hàng
		function submitOrder() {
			// Kiểm tra điều khoản
			if (!document.getElementById('terms').checked) {
				showNotification('Vui lòng đồng ý với điều khoản và điều kiện!', 'error');
				return;
			}

			// Lấy dữ liệu form
			const formData = new FormData();
			formData.append('customer_name', document.getElementById('customer_name').value);
			formData.append('customer_email', document.getElementById('customer_email').value);
			formData.append('customer_phone', document.getElementById('customer_phone').value);
			formData.append('delivery_address', document.getElementById('delivery_address').value);
			formData.append('notes', document.getElementById('notes').value);

			// Hiển thị loading
			const submitBtn = document.querySelector('.order-submit');
			const originalText = submitBtn.textContent;
			submitBtn.textContent = 'Đang xử lý...';
			submitBtn.disabled = true;

			// Gửi request
			fetch('frontend.php?action=place-order', {
				method: 'POST',
				body: formData
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					showNotification(data.message, 'success');
					// Chuyển về trang chủ sau 2 giây
					setTimeout(() => {
						window.location.href = 'frontend.php?page=home';
					}, 2000);
				} else {
					showNotification(data.message, 'error');
				}
			})
			.catch(error => {
				console.error('Error:', error);
				showNotification('Có lỗi xảy ra khi đặt hàng!', 'error');
			})
			.finally(() => {
				// Khôi phục button
				submitBtn.textContent = originalText;
				submitBtn.disabled = false;
			});
		}
		</script>

	</body>
</html>
