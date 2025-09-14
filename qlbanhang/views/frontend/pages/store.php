<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

		<title><?php echo $title ?? 'Tất cả sản phẩm - TV Store'; ?></title>

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

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		
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

		/* Cart button styling */
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
						<!-- <li><a href="#"><i class="fa fa-dollar"></i> USD</a></li> -->
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
												<a href="/qlbanhang/frontend.php?page=checkout" class="btn-checkout-only">Đặt Hàng <i class="fa fa-arrow-circle-right"></i></a>
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
						<li class="active dropdown" style="position: relative;">
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
							<li class="active">Tất cả sản phẩm (<?php echo count($products); ?> sản phẩm)</li>
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
					<!-- ASIDE -->
					<div id="aside" class="col-md-3">
						<!-- aside Widget -->
						<div class="aside">
							<h3 class="aside-title">Danh mục</h3>
							<div class="checkbox-filter">
								<?php
								$categoryCounts = array();
								foreach ($allProducts as $product) {
									$categoryName = $product['category_name'];
									if (isset($categoryCounts[$categoryName])) {
										$categoryCounts[$categoryName]++;
									} else {
										$categoryCounts[$categoryName] = 1;
									}
								}
								
								$categoryIndex = 1;
								foreach ($categoryCounts as $categoryName => $count):
									$isChecked = in_array($categoryName, $selectedCategories) ? 'checked' : '';
								?>
								<div class="input-checkbox">
									<input type="checkbox" id="category-<?php echo $categoryIndex; ?>" name="category[]" value="<?php echo htmlspecialchars($categoryName); ?>" <?php echo $isChecked; ?>>
									<label for="category-<?php echo $categoryIndex; ?>">
										<span></span>
										<?php echo htmlspecialchars($categoryName); ?>
										<small>(<?php echo $count; ?>)</small>
									</label>
								</div>
								<?php 
								$categoryIndex++;
								endforeach; 
								?>
							</div>
						</div>
						<!-- /aside Widget -->

					</div>
					<!-- /ASIDE -->

					<!-- STORE -->
					<div id="store" class="col-md-9">
						<!-- store top filter -->
						<div class="store-filter clearfix">
							<div class="store-sort">
								<label>
									Sắp xếp theo:
									<select class="input-select">
										<option value="0">Phổ biến</option>
										<option value="1">Giá thấp đến cao</option>
										<option value="2">Giá cao đến thấp</option>
										<option value="3">Mới nhất</option>
									</select>
								</label>

								<label>
									Hiển thị:
									<select class="input-select">
										<option value="0">12</option>
										<option value="1">24</option>
										<option value="2">48</option>
									</select>
								</label>
							</div>
							<ul class="store-grid">
								<li class="active"><i class="fa fa-th"></i></li>
								<li><a href="#"><i class="fa fa-th-list"></i></a></li>
							</ul>
						</div>
						<!-- /store top filter -->

						<!-- store products -->
						<div class="row" id="products-container">
							<?php if (empty($products)): ?>
								<div class="col-md-12">
									<p class="text-center">Không tìm thấy sản phẩm nào.</p>
								</div>
							<?php else: ?>
								<?php $productCount = 0; ?>
								<?php foreach ($products as $product): ?>
								<!-- product -->
								<div class="col-md-4 col-xs-6">
									<div class="product">
										<div class="product-img">
											<?php 
											$imagePath = !empty($product['images']) ? '/qlbanhang/public/uploads/products/' . $product['images'] : '/qlbanhang/public/assets/img/frontend/product01.png';
											?>
											<img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
											<?php if (!empty($product['discount_percentage']) && $product['discount_percentage'] > 0): ?>
											<div class="product-label">
												<span class="sale">-<?php echo $product['discount_percentage']; ?>%</span>
											</div>
											<?php endif; ?>
										</div>
										<div class="product-body">
											<p class="product-category"><?php echo htmlspecialchars($product['category_name']); ?></p>
											<h3 class="product-name">
												<a href="/qlbanhang/frontend.php?page=product&id=<?php echo $product['id']; ?>">
													<?php echo htmlspecialchars($product['name']); ?>
												</a>
											</h3>
											<h4 class="product-price">
												<?php if (!empty($product['discount_percentage']) && $product['discount_percentage'] > 0): ?>
													<?php $discountedPrice = $product['price'] * (1 - $product['discount_percentage'] / 100); ?>
													<?php echo number_format($discountedPrice, 0, ',', '.'); ?>₫
													<del class="product-old-price"><?php echo number_format($product['price'], 0, ',', '.'); ?>₫</del>
												<?php else: ?>
													<?php echo number_format($product['price'], 0, ',', '.'); ?>₫
												<?php endif; ?>
											</h4>
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
												<button class="quick-view" data-product-id="<?php echo $product['id']; ?>"><i class="fa fa-eye"></i><span class="tooltipp">xem nhanh</span></button>
											</div>
										</div>
										<div class="add-to-cart">
											<button class="add-to-cart-btn" data-product-id="<?php echo $product['id']; ?>">
												<i class="fa fa-shopping-cart"></i> Thêm vào giỏ hàng
											</button>
										</div>
									</div>
								</div>
								<!-- /product -->
								
								<?php 
								$productCount++;
								// Add clearfix divs for proper responsive layout
								if ($productCount % 2 == 0): ?>
									<div class="clearfix visible-sm visible-xs"></div>
								<?php endif; 
								if ($productCount % 3 == 0): ?>
									<div class="clearfix visible-lg visible-md"></div>
								<?php endif; ?>
								
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
						<!-- /store products -->

						<!-- store bottom filter -->
						<div class="store-filter clearfix">
							<span class="store-qty">Hiển thị <?php echo count($products); ?> sản phẩm</span>
							<?php if (count($products) > 12): ?>
							<ul class="store-pagination">
								<li class="active">1</li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#"><i class="fa fa-angle-right"></i></a></li>
							</ul>
							<?php endif; ?>
						</div>
						<!-- /store bottom filter -->
					</div>
					<!-- /STORE -->
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
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
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
		
		<style>
		/* Notification styles - copied from home.php */
		.cart-notification {
			position: fixed;
			top: 20px;
			right: -400px;
			background: linear-gradient(135deg, #4CAF50, #45a049);
			color: white;
			padding: 12px 20px;
			border-radius: 5px;
			box-shadow: 0 4px 20px rgba(0,0,0,0.15);
			z-index: 10000;
			display: flex;
			align-items: center;
			gap: 10px;
			min-width: 280px;
			transition: all 0.3s ease;
			font-weight: 500;
		}

		.cart-notification.error {
			background: linear-gradient(135deg, #f44336, #d32f2f);
		}

		.cart-notification.show {
			right: 20px;
		}

		.cart-notification i {
			font-size: 18px;
		}

		/* Cart dropdown improvements - simplified like home.php */
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
		</style>

		<script>
		// Navigation dropdown functionality  
		document.addEventListener('DOMContentLoaded', function() {
			console.log('🟢 Store.php DOM ready - initializing all features');
			
			const navDropdowns = document.querySelectorAll('.main-nav .dropdown');
			console.log('🔍 Found navigation dropdowns in store.php:', navDropdowns.length);
			
			navDropdowns.forEach(function(dropdown) {
				const dropdownMenu = dropdown.querySelector('.dropdown-menu');
				console.log('📋 Dropdown menu found:', dropdownMenu);
				
				if (dropdownMenu) {
					// Mouse enter
					dropdown.addEventListener('mouseenter', function() {
						console.log('🖱️ Mouse enter dropdown in store.php');
						dropdownMenu.style.opacity = '1';
						dropdownMenu.style.visibility = 'visible';
						dropdownMenu.style.transform = 'translateY(0)';
						dropdownMenu.style.display = 'block';
					});
					
					// Mouse leave
					dropdown.addEventListener('mouseleave', function() {
						console.log('🖱️ Mouse leave dropdown in store.php');
						dropdownMenu.style.opacity = '0';
						dropdownMenu.style.visibility = 'hidden';
						dropdownMenu.style.transform = 'translateY(-10px)';
					});
				}
			});
			
			// Category filtering functionality
			const categoryCheckboxes = document.querySelectorAll('input[name="category[]"]');
			
			function filterProducts() {
				const selectedCategories = Array.from(categoryCheckboxes)
					.filter(cb => cb.checked)
					.map(cb => cb.value);
				
				// Build URL parameters
				const params = new URLSearchParams();
				params.append('page', 'store'); // Always include page=store
				if (selectedCategories.length > 0) {
					params.append('categories', selectedCategories.join(','));
				}
				
				// Reload page with filters
				const newUrl = '/qlbanhang/frontend.php?' + params.toString();
				window.location.href = newUrl;
			}
			
			// Add event listeners to checkboxes
			categoryCheckboxes.forEach(checkbox => {
				checkbox.addEventListener('change', filterProducts);
			});
			
			// Event listener cho các nút xóa đã có sẵn trong header
			document.querySelectorAll('.remove-from-cart').forEach(button => {
				button.addEventListener('click', function() {
					const productId = this.dataset.productId;
					console.log('�️ Remove from cart button clicked for product:', productId);
					removeFromCart(productId);
				});
			});
			
			// Find all add to cart buttons
			const buttons = document.querySelectorAll('.add-to-cart-btn');
			console.log('🔍 Found buttons:', buttons.length);
			
			buttons.forEach(function(button, index) {
				console.log('🎯 Button ' + index + ':', button);
				console.log('� Product ID:', button.getAttribute('data-product-id'));
				
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
		</script>

	</body>
</html>
