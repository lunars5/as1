<?php
session_start();
require 'database.php';
require 'header.php';
require 'navbar.php';
?>

<h1> Category Listing <h1>

<?php

if(isset($_GET['categoryId'])){
$stmt = $pdo->prepare('SELECT * FROM auction WHERE categoryId = :categoryId');
$stmt2 = $pdo->prepare('SELECT name FROM category WHERE categoryId = :categoryId');

$values = [
    'categoryId'=>$_GET['categoryId']
];
$stmt->execute($values);
$stmt2->execute($values);

$auct= $stmt->fetchAll();
$cats= $stmt2->fetch();

foreach($auct as $row){
?>

<ul class="productList">
    <li>
        <img src="product.png" alt="<?php echo $row['title'] ?>">
        <article>
            <h2>Title: <?php echo $row['title'] ?></h2>
            <h3>Category name: <?php echo $cats['name']?> </h3>
            <p>Description: <?php echo $row['description'] ?> </p>
            
            <p class="price">Current bid: £</p>
            <a href="auction.php?title=<?php echo $row['title'] ?>&categoryId=<?php echo $row['categoryId'] ?>" class="more auctionLink">More &gt;&gt; </a>
        </article>
    </li>
</ul>

<?php
    }
}  
require 'footer.php';
?>