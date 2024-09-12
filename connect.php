<?php

$db_name = 'student_management';
$localhost = 'localhost';
$username = 'root';
$password = '';

$conn = mysqli_connect($localhost,$username,$password,$db_name);

if (!$conn) 
{
    die("Connection failed: ". mysqli_connect_error());
}
?>
