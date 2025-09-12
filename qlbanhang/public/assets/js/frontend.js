// Frontend JavaScript for TV Store

document.addEventListener("DOMContentLoaded", function () {
  // Load categories for navigation dropdown and footer
  loadCategories();

  // Initialize cart
  initCart();

  // Setup search functionality
  setupSearch();
});

// Load categories from API
function loadCategories() {
  // Categories dropdown in navigation
  const categoriesMenu = document.getElementById("categories-menu");
  const footerCategories = document.getElementById("footer-categories");

  // Mock data - sẽ được thay bằng AJAX call thực tế
  const categories = [
    {
      id: 1,
      name: "TV & Màn hình",
      description: "Smart TV, màn hình máy tính",
    },
    { id: 2, name: "Laptop & PC", description: "Laptop, máy tính để bàn" },
    { id: 3, name: "Điện thoại", description: "Smartphone các hãng" },
    { id: 4, name: "Phụ kiện", description: "Tai nghe, sạc, bao da" },
  ];

  // Populate navigation dropdown
  if (categoriesMenu) {
    categoriesMenu.innerHTML = "";
    categories.forEach((category) => {
      const li = document.createElement("li");
      li.innerHTML = `
                <a class="dropdown-item" href="/qlbanhang/frontend.php?page=products&category=${category.id}">
                    <i class="fas fa-angle-right me-2"></i> ${category.name}
                </a>
            `;
      categoriesMenu.appendChild(li);
    });
  }

  // Populate footer categories
  if (footerCategories) {
    footerCategories.innerHTML = "";
    categories.forEach((category) => {
      const li = document.createElement("li");
      li.className = "mb-2";
      li.innerHTML = `
                <a href="/qlbanhang/frontend.php?page=products&category=${category.id}" 
                   class="text-muted text-decoration-none">
                    <i class="fas fa-angle-right"></i> ${category.name}
                </a>
            `;
      footerCategories.appendChild(li);
    });
  }
}

// Initialize cart functionality
function initCart() {
  updateCartCount();
}

// Update cart count in header
function updateCartCount() {
  const cartCount = getCartItemCount();
  const cartCountElement = document.getElementById("cart-count");
  if (cartCountElement) {
    cartCountElement.textContent = cartCount;
  }
}

// Get cart item count from localStorage
function getCartItemCount() {
  const cart = JSON.parse(localStorage.getItem("cart") || "[]");
  return cart.reduce((total, item) => total + item.quantity, 0);
}

// Add product to cart
function addToCart(productId, productName, productPrice, productImage) {
  let cart = JSON.parse(localStorage.getItem("cart") || "[]");

  // Check if product already in cart
  const existingItem = cart.find((item) => item.id === productId);

  if (existingItem) {
    existingItem.quantity += 1;
  } else {
    cart.push({
      id: productId,
      name: productName,
      price: productPrice,
      image: productImage,
      quantity: 1,
    });
  }

  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartCount();

  // Show success message
  showToast("Đã thêm sản phẩm vào giỏ hàng!", "success");
}

// Remove product from cart
function removeFromCart(productId) {
  let cart = JSON.parse(localStorage.getItem("cart") || "[]");
  cart = cart.filter((item) => item.id !== productId);
  localStorage.setItem("cart", JSON.stringify(cart));
  updateCartCount();

  // Reload cart page if currently on cart page
  if (window.location.search.includes("page=cart")) {
    location.reload();
  }
}

// Update product quantity in cart
function updateCartQuantity(productId, quantity) {
  let cart = JSON.parse(localStorage.getItem("cart") || "[]");
  const item = cart.find((item) => item.id === productId);

  if (item) {
    if (quantity <= 0) {
      removeFromCart(productId);
    } else {
      item.quantity = quantity;
      localStorage.setItem("cart", JSON.stringify(cart));
      updateCartCount();
    }
  }
}

// Get cart items
function getCartItems() {
  return JSON.parse(localStorage.getItem("cart") || "[]");
}

// Calculate cart total
function getCartTotal() {
  const cart = getCartItems();
  return cart.reduce((total, item) => total + item.price * item.quantity, 0);
}

// Clear cart
function clearCart() {
  localStorage.removeItem("cart");
  updateCartCount();
}

// Setup search functionality
function setupSearch() {
  const searchForm = document.querySelector(".search-form");
  if (searchForm) {
    searchForm.addEventListener("submit", function (e) {
      const searchInput = this.querySelector('input[name="search"]');
      if (!searchInput.value.trim()) {
        e.preventDefault();
        searchInput.focus();
      }
    });
  }
}

// Show toast notification
function showToast(message, type = "info") {
  // Create toast element
  const toast = document.createElement("div");
  toast.className = `toast align-items-center text-white bg-${type} border-0`;
  toast.setAttribute("role", "alert");
  toast.style.position = "fixed";
  toast.style.top = "20px";
  toast.style.right = "20px";
  toast.style.zIndex = "9999";

  toast.innerHTML = `
        <div class="d-flex">
            <div class="toast-body">
                ${message}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" 
                    data-bs-dismiss="toast"></button>
        </div>
    `;

  document.body.appendChild(toast);

  // Initialize and show toast
  const bsToast = new bootstrap.Toast(toast);
  bsToast.show();

  // Remove toast element after it's hidden
  toast.addEventListener("hidden.bs.toast", function () {
    this.remove();
  });
}

// Format currency
function formatCurrency(amount) {
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(amount);
}

// Smooth scroll to element
function scrollToElement(elementId) {
  const element = document.getElementById(elementId);
  if (element) {
    element.scrollIntoView({
      behavior: "smooth",
      block: "start",
    });
  }
}

// Debounce function for search
function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}
