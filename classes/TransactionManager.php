<?php
class TransactionManager {
    private $filePath;

    public function __construct($filePath = '../data/transactions.json') {
        $this->filePath = $filePath;
    }

    public function getTransactions() {
        if (!file_exists($this->filePath)) {
            return [];
        }
        $data = file_get_contents($this->filePath);
        return json_decode($data, true);
    }

    public function saveTransaction($transaction) {
        $transactions = $this->getTransactions();
        $transactions[] = $transaction; // Tambahkan transaksi baru
        file_put_contents($this->filePath, json_encode($transactions, JSON_PRETTY_PRINT)); // Simpan ke file
    }
}
?>
