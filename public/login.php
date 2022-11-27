<?php
ob_start();
	session_start();
	require 'database.php';
	require 'header.php';
  require 'navbar.php';

if (isset($_POST['submit'])) {
  $stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email AND password = :password');
  $values = [
      'email' => $_POST['email'],
      'password' => $_POST['password']
  ];
  $stmt->execute($values);
  $user = $stmt->fetch();
   //if (password_verify($_POST['password'], $user['password'])) {
      $_SESSION['loggedin'] = $user['email'];
     if ($user['admin'] ==='y') {
     $_SESSION['admin'] = 'y';

     echo '<p> logged in as admin </p>';
     }

  else if ($user['admin'] ==='n') {
  echo '<p> Logged in</p>';
   }
   
  else {
    echo '<p>Details incorrect</p>';
  }
}
 // }
  else{

?>
    <h1>Login</h1>
	  <form action= "login.php" method= "POST">
        <label>Email: </label>
        <input type="text" placeholder='Email'  name="email"/>
        <label>Password: </label>
        <input type="password" placeholder='Password' name="password"/>
        <input type="submit" name="submit" value="Submit" />
	  </form>
  <p> <a class="categoryLink" href="register.php">Not a user? Press here to register</a> <p>
<?php
}
?>
  <?php
require 'footer.php'
?>