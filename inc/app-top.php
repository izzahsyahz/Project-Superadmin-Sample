<?php
session_start();
?>
<?php
if($_SESSION["email"] == "" || $_SESSION["admin_login"] != true){
		header('Location: index.php');
}
?>