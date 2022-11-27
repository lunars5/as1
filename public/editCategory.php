<?php
ob_start();
session_start();
require 'database.php';
require 'header.php';
require 'navbar.php';

if(isset ($_POST['submit'])) {
    $stmt = $pdo->prepare ('UPDATE category SET name = :name WHERE categoryId = :categoryId');

$values = [
    'name' => $_POST['name'],
    'categoryId' => $_POST['categoryId']
];

$stmt->execute($values);

echo "Category Edit Complete";
}
else if(isset($_GET['categoryId'])) {
    $getStmt = $pdo->prepare('SELECT * FROM category WHERE categoryId = :categoryId');

    $values = [
        'categoryId' => $_GET['categoryId']
    ];

    $getStmt->execute($values);
    
    $names = $getStmt->fetch();
        ?>
        <form action="editCategory.php" method="POST">
            <input type="hidden" name="categoryId" value="<?php echo $names['categoryId']; ?>"/>
            <label>category name: </label>
            <input type="text" name="name" value="<?php echo $names['name']; ?>"/>
            <input type="submit" name="submit" value="edit category"/>
            <p><a id="delete" href="deleteCategory.php?categoryId=<?php echo $names['categoryId']; ?> ">Delete category</a></p>
        </form>
       
        <?php
}

require 'footer.php';
?>
