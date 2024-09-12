<?php

include './nav.php';
require_once './connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') 
{

    $delet_id = $_GET['id'];
    $sql = "DELETE FROM students WHERE id = " . $delet_id;
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    if ($result)
    {
        header('Location: index.php');
        exit();
    }
}
