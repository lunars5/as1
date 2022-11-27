<?php
ob_start();
session_start();
require 'database.php';
require 'header.php';
require 'navbar.php';

if(isset($_GET['categoryId'])) {
    $stmt = $pdo->prepare('DELETE FROM category WHERE categoryId = :categoryId');

$values = [
    'categoryId'=>$_GET['categoryId']
];

$stmt->execute($values);
echo "Category deleted";
}

require 'footer.php';
?>