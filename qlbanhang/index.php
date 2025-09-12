<?php
require_once 'config.php';
require_once 'controllers/dashboardController.php';

$controller = new DashboardController();
$controller->index();