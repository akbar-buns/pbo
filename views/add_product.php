<?php
require_once __DIR__ . '/../classes/ProductManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dapatkan produk yang sudah ada
    $productManager = new ProductManager(__DIR__ . '/../data/products.json');
    $products = $productManager->getProducts();

    // Buat ID baru berdasarkan ID terakhir di daftar produk
    $newId = count($products) > 0 ? end($products)['id'] + 1 : 1;

    // Tambahkan produk baru
    $newProduct = [
        'id' => $newId,
        'name' => $_POST['name'],
        'price' => floatval($_POST['price']),
        'stock' => intval($_POST['quantity'])
    ];
    
    // Tambahkan produk baru ke array produk yang sudah ada
    $products[] = $newProduct;

    // Simpan kembali array produk ke file
    file_put_contents(__DIR__ . '/../data/products.json', json_encode($products, JSON_PRETTY_PRINT));

    echo "<p>Product added successfully!</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>
    <h1>Tambah Produk</h1>
    <form method="POST">
        <label for="name">Nama Produk:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="price">Harga:</label>
        <input type="number" name="price" id="price" step="0.01" required><br>

        <label for="quantity">Stok:</label>
        <input type="number" name="quantity" id="quantity" step="0.01" required><br>

        <button type="submit">Tambah</button>
    </form>
    <a href="home.php">Kembali</a><br>
    <a href="customer.php">Pesan Produk</a>
</body>
</html>
