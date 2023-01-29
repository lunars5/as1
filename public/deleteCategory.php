<?php
ob_start();
session_start();
require 'database.php';
require 'header.php';
require 'navbar.php';

if(isset($_SESSION['admin'])) {
if(isset($_POST['submit'])) {
    $stmt = $pdo->prepare('DELETE FROM category WHERE name = :name');

$values = [
    'name'=>$_POST['category']
];

$stmt->execute($values);
echo "Category deleted";
}else{
    $nStmt=$pdo->prepare('SELECT * FROM category');

    $nStmt->execute();
    $category=$nStmt->fetchAll();
    
    ?>
    <form action="deleteCategory.php" method="POST">
        <label>Category</label>
        <select name="category">
    <?php
    foreach($category as $row){
        ?>
        <option><?php echo $row['name'] ?></option>
        <?php
    }?>
    </select>
    <input type="submit" name="submit" value="Delete"/>
</form>
<?php
}
}

require 'footer.php';
?>