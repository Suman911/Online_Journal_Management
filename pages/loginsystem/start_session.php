<?php
session_start();

$_SESSION['loggedin'] = true;
$_SESSION['id'] = $row['UserID'];
$_SESSION['uname'] = $row['name'];
$_SESSION['email'] = $row['address'];
$_SESSION['phone'] = $row['phn'];
$_SESSION['registration_date'] = $row['date'];
$_SESSION['start'] = time();
$_SESSION['end'] = time() + (10 * 60);

?>