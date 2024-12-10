<?php
require_once __DIR__ . '/../classes/ProductManager.php';
require_once __DIR__ . '/../classes/TransactionManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $transactionManager = new TransactionManager();
    $transaction = [
        'name' => $_POST['name'],
        'product_id' => $_POST['product_id'],
        'quantity' => $_POST['quantity']
    ];
    
    // Lakukan pembelian dan kurangi stok
    $productManager = new ProductManager(__DIR__ . '/../data/products.json');
    $productId = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    
    // Jika stok mencukupi
    if ($productManager->reduceStock($productId, $quantity)) {
        // Simpan transaksi
        $transactionManager->saveTransaction($transaction);
        echo "<p>Transaction saved successfully and stock updated!</p>";
    } else {
        echo "<p>Sorry, insufficient stock for the selected product!</p>";
    }
}

$productManager = new ProductManager(__DIR__ . '/../data/products.json');
$products = $productManager->getProducts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Page</title>
    <link rel="stylesheet" href="../css/style.css"/>
</head>
<body>
    <h1>WELLCOME TO MY STORE</h1>
    <form method="POST">
        <label for="name">Nama:</label>
        <input type="text" name="name" id="name" required><br>

        <label for="product_id">Pilih Produk:</label>
        <select name="product_id" id="product_id" required>
            <?php foreach ($products as $product): ?>
                <option value="<?= $product['id'] ?>"><?= $product['name'] ?> - Price: <?= $product['price'] ?> - Stock: <?= $product['stock'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label for="quantity">Jumlah Produk:</label>
        <input type="number" name="quantity" id="quantity" min="1" required><br>

        <button type="submit">Pesan</button>
    </form>
    <a href="home.php">Kembali</a>
    <a href="add_product.php">Tambah Stok</a>
</body>
</html>
