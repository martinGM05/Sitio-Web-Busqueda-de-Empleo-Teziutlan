<?php
    $id = $_GET['IdUsers'];
    include "conection.php";
    $sql = "select UrlImagen from Users where idUsers=".$id;
    $resultado = $cn->query($sql);
    $fila = $resultado->fetch(PDO::FETCH_OBJ);
    header("Content-Type: image/png");
    readfile($fila->UrlImagen);
?>