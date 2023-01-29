<?php
ob_start();
session_start();
require 'database.php';
require 'header.php';
require 'navbar.php';

if(isset($_SESSION['loggedin']) === ['user name'] or isset($_SESSION['admin']))  {

    if(isset ($_POST['submit'])) {
        $stmt = $pdo->prepare ('UPDATE auction SET title = :title, description = :description, endDate = :endDate, categoryId = :categoryId WHERE title = :title');
        

        $values = [
            'title'=>$_POST['title'],
            'description'=>$_POST['description'],
            'endDate'=>$_POST['endDate'],
            'categoryId'=>$_POST['categoryId']
        ];
        
    $stmt->execute($values);
    
    echo "auction Edit Complete";
    }

    else if(isset($_GET['title'])) {
        $getStmt = $pdo->prepare('SELECT * FROM auction WHERE title = :title');
    
        $values = [
            'title' => $_GET['title']
        ];
    
        $getStmt->execute($values);
        
        $names = $getStmt->fetch();
            ?>
            <form action="editAuction.php" method="POST">
                <label>Auction name: </label>
                <input type="text" name="title" value="<?php echo $names['title']; ?>"/>
                <label>Auction description: </label>
                <input type="text" name= "description" value="<?php echo $names['description']; ?>"/>
                <label>Auction end date: </label>
                <input type="datetime" name="endDate" value="<?php echo $names['endDate']; ?>"/>
            
                <input type="hidden" name="categoryId" value="<?php echo $names['categoryId']; ?>"/>


                <input type="submit" name="submit" value="edit auction"/>
            </form>
           
            <?php
    }
    }
    
    require 'footer.php';
    ?>
    