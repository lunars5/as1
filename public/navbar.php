<?php
require 'database.php';
?>
<nav>
	<?php
	$stmt= $pdo->prepare ('SELECT * FROM category');

	$stmt->execute();

	$info=$stmt->fetchAll();
?>
<ul>
	<?php
	for($i=0;$i<count($info);$i++) {
	?>
				<li><a class="categoryLink" href="category.php?categoryId=<?php echo $info[$i]['categoryId'] ?>"> <?php echo $info[$i]['name'] ?></a></li>
				<?php
				}
				 if(isset($_SESSION['admin'])) {?>
       				<li><a class="categoryLink" href="adminCategories.php">Admin</a></li>
        		<?php }
				if(isset($_SESSION['loggedin'])){ ?>
				<li><a class="categoryLink" href="addAuction.php">Add Auction</a></li>
				<li><a class="categoryLink" href="logout.php">Logout</a></li>
				<?php
				 }else{
				?>
				<li><a class="categoryLink" href="login.php">Login/Register</a></li>
			<?php } ?>
			</ul>
		</nav>
		<img src="banners/1.jpg" alt="Banner" />
		<main>