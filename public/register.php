<?php
ob_start();
	session_start();
	require 'database.php';
	require 'header.php';
	require 'navbar.php';

if (isset($_POST['submit'])) {
	$stmt = $pdo->prepare('INSERT INTO user(email, name, password, admin)
									VALUES (:email, :name, :password, :admin)
');

$hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

$values = [
	'name' => $_POST['name'],
	'password' => $hash,
	'email' => $_POST['email'],
	'admin' => 'n'
];

$stmt->execute($values);

echo "Account created please login";
//else display form
}
else {
?>
	<h1>Register</h1>
	<form action= "register.php" method= "POST">
    <label>Email</label> 
	<input type="text" placeholder = "email" name="email"/>
	<label>Password</label> 
	<input type="password" placeholder = "password" name="password"/>
    <label> Name</label> 
	<input type="text"  placeholder = "name" name="name"/>
	<input type="submit" name="submit" value="submit" />
</form>
<?php
}
?>
  <?php
require 'footer.php'
?>