<?php
    session_start();

    unset($_SESSION['admin']);
    unset($_SESSION['loggedin']);

	require 'header.php';
    require 'navbar.php';
?>
    <p>Logged Out</p>
<?php
require 'footer.php';
?>