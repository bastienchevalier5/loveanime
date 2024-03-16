<?php
session_start();
include "bd.php";
if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = 'DELETE FROM comptes WHERE id='.$id;
    $temp = $pdo->exec($sql);
    $sql2 = 'DELETE FROM favoris WHERE utilisateur_id='.$id;
    $temp2 = $pdo->exec($sql2);
    $sql3 = 'DELETE FROM watchlist WHERE utilisateur_id='.$id;
    $temp3 = $pdo->exec($sql3);
    session_destroy();
    header("Location: index.php");
}
