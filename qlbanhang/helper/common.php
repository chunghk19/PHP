<?php
if (!function_exists('view')) {
    function view(
        $view = 'admin/dashboard.php',
        $data = [],
        $layout = 'admin/layout.php'
    ) {
        // truyền data trước khi hiển thị ra bên ngoài
        if (!empty($data)) {
            extract($data);
        }

        $pathView = './views/';
        // Bắt nội dung view
        ob_start();
        require $pathView . $view;
        $content = ob_get_clean();

        // Load layout (truyền $content vào)
        require $pathView . $layout;
    }
}
