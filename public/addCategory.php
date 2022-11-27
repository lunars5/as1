<?php
ob_start();
session_start();
require 'database.php';
require 'header.php';
require 'navbar.php';

if(isset($_SESSION['admin'])) {
if(isset($_POST['submit'])){
    $stmt = $pdo->prepare('INSERT INTO category (name)
                           VALUES (:name)
');

$values = [
    'name'=>$_POST['name']
];

$stmt->execute($values);

echo "The category was added.";

}
else{
?>

<form action="addCategory.php" method="POST">
    <label>Category name</label>
    <input type="text" name="name" value=""/>

    <input type="submit" name="submit" value="add category"/>
</form>

<?php
}

}


require 'footer.php';
?>