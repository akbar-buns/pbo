<?php
require_once 'classes/ProductManager.php';
require_once 'classes/TransactionManager.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
    case 'customer':
        include 'views/customer.php';
        break;
    case 'add_product':
        include 'views/add_product.php';
        break;
    case 'home':
    default:
        include 'views/home.php';
        break;
}
?>
