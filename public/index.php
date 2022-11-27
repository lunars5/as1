<?php
session_start();
require 'database.php';
require 'header.php';
require 'navbar.php';
?>

<h1> Latest Listings <h1>

<?php

$stmt = $pdo->prepare('SELECT * FROM auction ORDER BY endDate ASC LIMIT 10');

$stmt->execute();

$auct= $stmt->fetchAll();

foreach($auct as $row){
	
$stmt2 = $pdo->prepare('SELECT name FROM category WHERE categoryId = :categoryId');

$values = [
	'categoryId'=>$row['categoryId']
];

$stmt2->execute($values);
$cats= $stmt2->fetch();

?>

<ul class="productList">
    <li>
        <img src="product.png" alt="<?php echo $row['title'] ?>">
        <article>
            <h2><?php echo $row['title'] ?></h2>
            <h3>Category name: <?php echo $cats['name']?> </h3>
            <p>Description: <?php echo $row['description'] ?> </p>
            
            <p class="price">Current bid: £</p>
            <a href="auction.php?title=<?php echo $row['title'] ?>&categoryId=<?php echo $row['categoryId'] ?>" class="more auctionLink">More &gt;&gt; </a>
        </article>
    </li>
</ul>

<?php
}
  
require 'footer.php';
?>