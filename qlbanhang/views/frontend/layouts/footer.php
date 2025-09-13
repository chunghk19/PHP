    <!-- Footer -->
    <footer class="footer bg-dark text-white mt-5">
        <div class="container py-5">
            <div class="row">
                <!-- About -->
                <div class="col-md-3">
                    <h5 class="mb-3">
                        <i class="fas fa-tv"></i> TV Store
                    </h5>
                    <p class="text-muted">
                        Cửa hàng điện tử uy tín với nhiều năm kinh nghiệm. 
                        Chúng tôi cung cấp các sản phẩm chất lượng với giá tốt nhất.
                    </p>
                    <div class="social-links">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-youtube"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-md-3">
                    <h5 class="mb-3">Liên kết nhanh</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="/qlbanhang/frontend.php" class="text-muted text-decoration-none">
                                <i class="fas fa-angle-right"></i> Trang chủ
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/qlbanhang/frontend.php?page=products" class="text-muted text-decoration-none">
                                <i class="fas fa-angle-right"></i> Sản phẩm
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/qlbanhang/frontend.php?page=about" class="text-muted text-decoration-none">
                                <i class="fas fa-angle-right"></i> Về chúng tôi
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="/qlbanhang/frontend.php?page=contact" class="text-muted text-decoration-none">
                                <i class="fas fa-angle-right"></i> Liên hệ
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Categories -->
                <div class="col-md-3">
                    <h5 class="mb-3">Danh mục sản phẩm</h5>
                    <ul class="list-unstyled" id="footer-categories">
                        <!-- Categories sẽ được load động -->
                        <li class="mb-2">
                            <a href="#" class="text-muted text-decoration-none">
                                <i class="fas fa-angle-right"></i> Đang tải...
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="col-md-3">
                    <h5 class="mb-3">Thông tin liên hệ</h5>
                    <div class="contact-info">
                        <div class="mb-2">
                            <i class="fas fa-map-marker-alt me-2"></i>
                            <span class="text-muted">123 Đường ABC, Quận XYZ, TP.HCM</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-phone me-2"></i>
                            <span class="text-muted">Hotline: 1900-xxx-xxx</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-envelope me-2"></i>
                            <span class="text-muted">Email: info@tvstore.vn</span>
                        </div>
                        <div class="mb-2">
                            <i class="fas fa-clock me-2"></i>
                            <span class="text-muted">Mở cửa: 8:00 - 22:00 hàng ngày</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="copyright bg-black py-3">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">
                            © 2025 TV Store. All rights reserved. | Developed by ChungLee
                        </p>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="payment-methods">
                            <span class="text-muted me-3">Phương thức thanh toán:</span>
                            <i class="fab fa-cc-visa text-primary me-2"></i>
                            <i class="fab fa-cc-mastercard text-warning me-2"></i>
                            <i class="fas fa-university text-info me-2"></i>
                            <i class="fas fa-wallet text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Ignore errors from other scripts
        window.addEventListener('error', function(e) {
            if (e.filename.includes('main.js')) {
                console.log('Ignored main.js error:', e.message);
                e.preventDefault();
                return true;
            }
        });
        
        // Simple cart script - safeguarded
        try {
            console.log('🛒 Cart script starting...');
            
            function initSimpleCart() {
                console.log('🟢 Simple cart initializing...');
                
                // Wait for page fully loaded
                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', initSimpleCart);
                    return;
                }
                
                console.log('✅ Cart ready to attach events');
                
                // Use event delegation từ document để tránh conflict
                document.addEventListener('click', function(e) {
                    try {
                        // Check if clicked element or parent has add-to-cart-btn class
                        let target = e.target;
                        let depth = 0;
                        
                        while (target && target !== document && depth < 10) {
                            if (target.classList && target.classList.contains('add-to-cart-btn')) {
                                console.log('🎯 Add to cart clicked!');
                                e.preventDefault();
                                e.stopPropagation();
                                
                                const productId = target.getAttribute('data-product-id');
                                console.log('📦 Product ID:', productId);
                                
                                if (productId) {
                                    addToCartSimple(productId);
                                } else {
                                    console.error('❌ No product ID found');
                                    alert('❌ Không tìm thấy ID sản phẩm');
                                }
                                return false;
                            }
                            target = target.parentNode;
                            depth++;
                        }
                    } catch (err) {
                        console.error('❌ Error in click handler:', err);
                    }
                }, true); // Use capture phase
                
                console.log('🎉 Cart events attached successfully');
            }
            
            function addToCartSimple(productId) {
                console.log('🔄 Adding product to cart:', productId);
                
                try {
                    const formData = new FormData();
                    formData.append('product_id', productId);
                    formData.append('quantity', 1);
                    
                    console.log('📡 Sending AJAX request...');
                    
                    fetch('/qlbanhang/frontend.php?action=add-to-cart', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        console.log('📥 Response status:', response.status);
                        if (!response.ok) {
                            throw new Error('HTTP ' + response.status);
                        }
                        return response.text();
                    })
                    .then(data => {
                        console.log('📄 Raw response:', data);
                        
                        try {
                            const jsonData = JSON.parse(data);
                            console.log('✅ Parsed response:', jsonData);
                            
                            if (jsonData.success) {
                                alert('🎉 Thêm vào giỏ hàng thành công!');
                                console.log('🔄 Reloading page...');
                                window.location.reload();
                            } else {
                                alert('❌ Lỗi: ' + (jsonData.message || 'Không xác định'));
                            }
                        } catch (parseError) {
                            console.error('❌ JSON parse error:', parseError);
                            console.log('📄 Response was not JSON:', data);
                            alert('❌ Có lỗi xảy ra khi xử lý phản hồi');
                        }
                    })
                    .catch(error => {
                        console.error('❌ Fetch error:', error);
                        alert('❌ Lỗi kết nối: ' + error.message);
                    });
                } catch (err) {
                    console.error('❌ Error in addToCart:', err);
                    alert('❌ Có lỗi xảy ra: ' + err.message);
                }
            }
            
            // Initialize immediately and on DOM ready
            initSimpleCart();
            
        } catch (err) {
            console.error('❌ Cart script initialization error:', err);
        }
    </script>
