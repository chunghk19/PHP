// Cart functionality
class Cart {
  constructor() {
    this.init();
  }

  init() {
    console.log("Cart initialized"); // Debug log

    // Gắn sự kiện cho nút "Thêm vào giỏ hàng"
    document.addEventListener("click", (e) => {
      if (e.target.classList.contains("add-to-cart-btn")) {
        e.preventDefault();
        console.log("Add to cart clicked"); // Debug log
        const productId = e.target.getAttribute("data-product-id");
        console.log("Product ID:", productId); // Debug log
        this.addToCart(productId);
      }
    });

    // Gắn sự kiện cho nút "Xóa khỏi giỏ hàng"
    document.addEventListener("click", (e) => {
      if (e.target.closest(".remove-from-cart")) {
        e.preventDefault();
        const productId = e.target
          .closest(".remove-from-cart")
          .getAttribute("data-product-id");
        this.removeFromCart(productId);
      }
    });

    // Load cart count khi trang được tải
    this.updateCartDisplay();
  }

  // Thêm sản phẩm vào giỏ hàng
  addToCart(productId, quantity = 1) {
    console.log("Adding to cart:", productId); // Debug log

    const formData = new FormData();
    formData.append("product_id", productId);
    formData.append("quantity", quantity);

    fetch("/qlbanhang/index.php?action=add-to-cart", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        console.log("Response received:", response); // Debug log
        return response.json();
      })
      .then((data) => {
        console.log("Response data:", data); // Debug log
        if (data.success) {
          this.showNotification(data.message, "success");
          this.updateCartCount(data.totalItems);
          this.updateCartDisplay();
        } else {
          this.showNotification(data.message, "error");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        this.showNotification("Có lỗi xảy ra", "error");
      });
  }

  // Xóa sản phẩm khỏi giỏ hàng
  removeFromCart(productId) {
    const formData = new FormData();
    formData.append("product_id", productId);

    fetch("/qlbanhang/index.php?action=remove-from-cart", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          this.showNotification(data.message, "success");
          this.updateCartCount(data.totalItems);
          this.updateCartDisplay();
        } else {
          this.showNotification(data.message, "error");
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        this.showNotification("Có lỗi xảy ra", "error");
      });
  }

  // Cập nhật số lượng hiển thị trên cart
  updateCartCount(count) {
    const cartCountElement = document.getElementById("cart-count");
    if (cartCountElement) {
      cartCountElement.textContent = count;
    }
  }

  // Cập nhật hiển thị cart dropdown
  updateCartDisplay() {
    fetch("/qlbanhang/index.php?action=get-cart")
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          this.updateCartCount(data.totalItems);
          this.refreshCartDropdown();
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }

  // Refresh lại cart dropdown bằng cách reload trang (đơn giản)
  refreshCartDropdown() {
    // Reload lại trang để cập nhật cart dropdown
    window.location.reload();
  }

  // Hiển thị thông báo
  showNotification(message, type = "info") {
    // Tạo element thông báo
    const notification = document.createElement("div");
    notification.className = `alert alert-${
      type === "success" ? "success" : "danger"
    } alert-dismissible fade show position-fixed`;
    notification.style.cssText =
      "top: 20px; right: 20px; z-index: 1050; min-width: 300px;";
    notification.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

    // Thêm vào body
    document.body.appendChild(notification);

    // Tự động ẩn sau 3 giây
    setTimeout(() => {
      if (notification && notification.parentNode) {
        notification.remove();
      }
    }, 3000);
  }
}

// Khởi tạo cart khi DOM đã sẵn sàng
document.addEventListener("DOMContentLoaded", () => {
  console.log("DOM loaded, initializing cart..."); // Debug log
  new Cart();
});

// Test ngay khi file được load
console.log("Cart.js file loaded successfully");
