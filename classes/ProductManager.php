<?php
class ProductManager {
    private $filePath;

    public function __construct($filePath = '../data/products.json') {
        $this->filePath = $filePath;
    }

    public function getProducts() {
        if (!file_exists($this->filePath)) {
            return [];
        }
        $data = file_get_contents($this->filePath);
        return json_decode($data, true);
    }

    public function saveProducts($products) {
        file_put_contents($this->filePath, json_encode($products, JSON_PRETTY_PRINT));
    }

    // Fungsi untuk mengurangi stok produk
    public function reduceStock($productId, $quantity) {
        $products = $this->getProducts();
        
        // Temukan produk berdasarkan ID
        foreach ($products as &$product) {
            if ($product['id'] == $productId) {
                // Periksa apakah stok mencukupi
                if ($product['stock'] >= $quantity) {
                    $product['stock'] -= $quantity; // Kurangi stok berdasarkan kuantitas yang dibeli
                    $this->saveProducts($products); // Simpan kembali perubahan produk
                    return true; // Berhasil mengurangi stok
                } else {
                    return false; // Stok tidak mencukupi
                }
            }
        }
        return false; // Produk tidak ditemukan
    }
}
?>
