<?php
include "conection.php";
session_start();

if (!isset($_SESSION['NombreUsuario'])) {
    header("location: login.php?Error=401");
}
$idUsuario=$_SESSION['IdUsuario'];
$idbanner = $_GET["Idbanner"];

try{
    $sql = $cn->prepare("insert into Favorites (idUsers, idBanner) values (?,?)");
    $resultado = $sql->execute([$idUsuario,$idbanner ]);
    header('location: ../../principal.php');
}catch (Exception $ex){
    echo $ex;
}


?>