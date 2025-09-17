<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Đăng nhập - TV Store' ?></title>

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">

    <!-- Bootstrap -->
    <link type="text/css" rel="stylesheet" href="/qlbanhang/public/assets/css/frontend/bootstrap.min.css"/>

    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom stlylesheet -->
    <link type="text/css" rel="stylesheet" href="/qlbanhang/public/assets/css/frontend/style.css"/>

    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }
        .auth-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
        }
        .auth-header {
            background: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .auth-header h3 {
            color: white !important;
            font-weight: 700 !important;
            margin: 0 !important;
            text-shadow: none !important;
            opacity: 1 !important;
        }
        .auth-body {
            padding: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-control {
            height: 45px;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 0 15px;
            width: 100%;
        }
        .form-control:focus {
            border-color: #D10024;
            box-shadow: 0 0 0 0.2rem rgba(209, 0, 36, 0.25);
        }
        .btn-auth {
            height: 45px;
            background: #D10024;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: 500;
            width: 100%;
        }
        .btn-auth:hover {
            background: #a8001c;
            color: white;
        }
        .alert {
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        /* Responsive */
        @media (max-width: 576px) {
            .auth-container {
                padding: 10px;
            }
            .auth-body {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h3><i class="fa fa-sign-in"></i> Đăng nhập</h3>
            </div>
            <div class="auth-body">
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <i class="fa fa-exclamation-circle"></i> <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <i class="fa fa-check-circle"></i> <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <form action="/qlbanhang/index.php?action=login" method="POST">
                    <div class="form-group">
                        <label><i class="fa fa-user"></i> Email hoặc Tên đăng nhập</label>
                        <input type="text" class="form-control" name="email_username" 
                               placeholder="Nhập email hoặc tên đăng nhập" required>
                    </div>

                    <div class="form-group">
                        <label><i class="fa fa-lock"></i> Mật khẩu</label>
                        <input type="password" class="form-control" name="password" 
                               placeholder="Nhập mật khẩu" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-auth">
                            <i class="fa fa-sign-in"></i> Đăng nhập
                        </button>
                    </div>

                    <div class="text-center">
                        <p>Chưa có tài khoản? 
                            <a href="/qlbanhang/index.php?action=register" style="color: #D10024;">
                                Đăng ký ngay
                            </a>
                        </p>
                        <p>
                            <a href="/qlbanhang/index.php" style="color: #666;">
                                <i class="fa fa-arrow-left"></i> Quay về trang chủ
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- jQuery Plugins -->
    <script src="/qlbanhang/public/assets/js/frontend/jquery.min.js"></script>
    <script src="/qlbanhang/public/assets/js/frontend/bootstrap.min.js"></script>
</body>

</html>
