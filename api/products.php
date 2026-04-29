<?php
header('Content-Type: application/json');
require_once 'db.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Tek ürün getir
            $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
            $stmt->execute([$_GET['id']]);
            echo json_encode($stmt->fetch());
        } else {
            // Tüm ürünleri getir
            $stmt = $pdo->query("SELECT * FROM products ORDER BY created_at DESC");
            echo json_encode($stmt->fetchAll());
        }
        break;

    case 'POST':
        // Ürün ekle veya Güncelle
        $data = json_decode(file_get_contents('php://input'), true);
        
        if (isset($data['id']) && !empty($data['id'])) {
            // Güncelle
            $stmt = $pdo->prepare("UPDATE products SET name=?, category=?, price=?, is_new=?, images=?, description=? WHERE id=?");
            $stmt->execute([
                $data['name'],
                $data['category'],
                $data['price'],
                $data['is_new'],
                json_encode($data['images']), // Dizi olarak gelen resimleri JSON kaydet
                $data['description'],
                $data['id']
            ]);
            echo json_encode(['success' => true, 'message' => 'Ürün güncellendi']);
        } else {
            // Yeni Ekle
            $stmt = $pdo->prepare("INSERT INTO products (name, category, price, is_new, images, description) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $data['name'],
                $data['category'],
                $data['price'],
                $data['is_new'],
                json_encode($data['images']), // Dizi olarak gelen resimleri JSON kaydet
                $data['description']
            ]);
            echo json_encode(['success' => true, 'message' => 'Ürün eklendi', 'id' => $pdo->lastInsertId()]);
        }
        break;

    case 'DELETE':
        $id = $_GET['id'];
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);
        echo json_encode(['success' => true, 'message' => 'Ürün silindi']);
        break;
}
?>