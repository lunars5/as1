<?php
session_start();
require 'database.php';
require 'header.php';
require 'navbar.php';
?>

<h1> Product Page <h1>

<?php

if(isset($_GET['title']) && isset($_GET['categoryId'])){
$stmt = $pdo->prepare('SELECT * FROM auction WHERE title= :title');
$stmt2 = $pdo->prepare('SELECT name FROM category WHERE categoryId = :categoryId');

$values = [
    'title'=>$_GET['title']
];

$values2 = [
    'categoryId'=>$_GET['categoryId']
];

$stmt->execute($values);
$stmt2->execute($values2);

$aucttitle= $stmt->fetchAll();
$cats= $stmt2->fetch();

foreach($aucttitle as $row){
?>

<article class="product">
        <img src="product.png" alt="<?php echo $row['title'] ?>">
        <section class="details">
            <h2>Product name: <?php echo $row['title'] ?></h2>
            <h3>Procuct Category: <?php echo $cats['name']?> </h3>
            <p>Auction created by <a href="#">User.Name</a></p>
				<p class="price">Current bid: £123.45</p>
				<time>Time left: 8 hours 3 minutes</time>
				<form action="#" class="bid">
				<input type="text" name="bid" placeholder="Enter bid amount" />
				<input type="submit" value="Place bid" />
				</form>
                </section>
					<section class="description">
					<p> </p>

					</section>

					<section class="reviews">
						<h2>Reviews of User.Name </h2>
						<ul>
							<li><strong>Ali said </strong> great ibuyer! Product as advertised and delivery was quick <em>29/09/2019</em></li>
							<li><strong>Dave said </strong> disappointing, product was slightly damaged and arrived slowly.<em>22/07/2019</em></li>
							<li><strong>Susan said </strong> great value but the delivery was slow <em>22/07/2019</em></li>

						</ul>

                <?php }
				if(isset($_SESSION['loggedin'])){ ?>

						<form>
							<label>Add your review</label> <textarea name="reviewtext"></textarea>
                            <form action="#">
						<label>Review</label> <input name = "reviewText" type="text" />
						<label>Another Text box</label> <input type="text" />
						<input type="checkbox" /> <label>Checkbox</label>
						<input type="radio" /> <label>Radio</label>
						<input name = "submit" type="submit" value="Add Review " />
						</form>
					</section>
					</article>

					<hr />

<?php
    }
}  
require 'footer.php';
?>