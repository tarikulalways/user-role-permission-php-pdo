<?php
include 'header.php';

try{
    if(empty($_GET['id'])){
        throw new Exception('The id is required');
    }

    $query = $pdo->prepare("DELETE FROM roles WHERE id=?");
    $query->execute([$_GET['id']]);

    if($query->rowCount()){
        header('location:role-view.php?msg=User delete successfull');
    }else{
        throw new Exception('no use id found');
    }
}catch(Exception $e){
    $message = $e->getMessage();
}