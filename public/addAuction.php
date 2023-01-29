<?php
ob_start();
session_start();
require 'database.php';
require 'header.php';
require 'navbar.php';

if(isset($_SESSION['loggedin'])){ 

if(isset($_POST['submit'])){
    $stmt = $pdo->prepare('INSERT INTO auction (title, description, endDate, categoryId, username)
                           VALUES (:title, :description, :endDate, :categoryId, :username)
');

$values = [
    'title'=>$_POST['title'],
    'description'=>$_POST['description'],
    'endDate'=>$_POST['endDate'],
    'categoryId'=>$_POST['categoryId'],
    'username'=>$_POST['username']
];

$stmt->execute($values);

echo "The auction was added.";

}
else{
    ?>

<form action="addAuction.php" method="POST">
                        <input type="hidden" name="username" value="<?php echo $_SESSION['loggedin'] ?>"/>
						<label>Auction Title:</label> <input name = "title" type="text" value="" />
						<label>Description:</label> <textarea name="description"></textarea>
                        <label>Choose a category:</label>
                            <select name="categoryId" id="categoryId">
                                <?php
                                $selectStmt = $pdo->prepare('SELECT * FROM category');
                                $selectStmt->execute();
                                foreach($selectStmt as $row){
                                    echo '<option value="' . $row['categoryId'] . '">' . $row['name'] . '</option>';
                                }
                                ?>
                            </select>
                        <label>End Date: (yyyy/mm/dd) </label> <input name = "endDate" type="text" />
                        <input name = "submit" type="submit" value="Add Auction" />
                        
						</form>

<?php
}
}
