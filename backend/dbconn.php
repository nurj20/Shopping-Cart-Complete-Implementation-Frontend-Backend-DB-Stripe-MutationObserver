<?php
$localhost = "localhost:3306";
$db="shopping_cart";
$user="root";
$pwd="root";

$conn = new mysqli($localhost, $user, $pwd, $db);
if($conn->connect_errno){
    echo "something wenr wrong" . $conn->connect_error;
    exit();
}

