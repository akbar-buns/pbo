<?php
require_once __DIR__ . '/../classes/ProductManager.php';

$productManager = new ProductManager();
$products = $productManager->getProducts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List</title>
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>
    <h1>List Produk</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Harga</th>
                <th>Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['id'] ?></td>
                <td><?= $product['name'] ?></td>
                <td><?= $product['price'] ?></td>
                <td><?= $product['stock'] ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="customer.php">Pesan Produk</a><br>
    <a href="add_product.php">Tambah Produk</a>
</body>
</html>
