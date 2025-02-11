<?php


if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    require_once '../db.php';

    $orderID = $_GET['id'];

    echo json_encode($orderID) ;
}


?>