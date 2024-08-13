<?php
session_start();

$_SESSION['loggedin'] = true;
$_SESSION['id'] = $row['UserID'];
$_SESSION['first_name'] = $row['first_name'];
$_SESSION['last_name'] = $row['last_name'];
$_SESSION['email'] = $row['address'];
$_SESSION['phone'] = $row['phn'];
$_SESSION['registration_date'] = $row['date'];
$_SESSION['start'] = time();
$_SESSION['end'] = time() + 24 * 60 * 60;
