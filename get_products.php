<?php
header('Content-Type: application/json');
$pdo = new PDO('mysql:host=localhost;dbname=products_db', 'root', '');

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$limit = 20; // Nombre d'éléments par page
$offset = ($page - 1) * $limit;

$stmt = $pdo->prepare("SELECT * FROM products LIMIT $limit OFFSET $offset");
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($products);
?>
