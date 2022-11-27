<?php
ob_start();
session_start();
require 'database.php';
require 'header.php';
require 'navbar.php';

if(isset($_SESSION['loggedin'])){ 

if(isset($_POST['submit'])){
    $stmt = $pdo->prepare('INSERT INTO auction (title, description, endDate, categoryId)
                           VALUES (:title, :description, :endDate, :categoryId)
');

$values = [
    'title'=>$_POST['title'],
    'description'=>$_POST['description'],
    'endDate'=>$_POST['endDate'],
    'categoryId'=>$_POST['categoryId'],
];

$stmt->execute($values);

echo "The auction was added.";

}
else{
    ?>

<form action="addAuction.php" method="POST">

						<label>Auction Title:</label> <input name = "title" type="text" />
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
