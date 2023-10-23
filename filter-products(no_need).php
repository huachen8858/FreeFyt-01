<?php
require './index-parts/connect_db.php';

$FilterCategory = isset($_POST['FilterCategory']) ? $_POST['FilterCategory'] : 'all';

$sql = "SELECT * FROM product_list";
if ($FilterCategory !== 'all') {
    $sql .= " WHERE category = :category";
}

$sql .= " ORDER BY sid";

$stmt = $pdo->prepare($sql);
if ($FilterCategory !== 'all') {
    $stmt->bindParam(':category', $FilterCategory, PDO::PARAM_STR);
}
$stmt->execute();

$filterSidResults = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($filterSidResults);