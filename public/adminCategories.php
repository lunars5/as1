<?php
ob_start();
session_start();
require 'database.php';
require 'header.php';
require 'navbar.php';

?>
<h1> Category Listing <h1>
<h2> Select Category: </h2>
<?php

if(isset($_SESSION['admin'])) {
    $stmt = $pdo->prepare ('SELECT * FROM category');
    $stmt->execute () ;

    foreach($stmt as $row) {
        echo '<li><a href="editCategory.php?categoryId=' . $row['categoryId'] . '">' . $row ['name'] . '</a></li>';
    }

    ?>
    <h3><a href="addCategory.php"> Add a Category</a></h3>

    <?php
}
require 'footer.php';
?>