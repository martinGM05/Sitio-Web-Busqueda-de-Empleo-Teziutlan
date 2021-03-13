<?php
session_start();
$usuario = $_POST['txtName'];
$password = $_POST['txtPassword'];

include "conection.php";
$sentencia = $cn->prepare("select*from Users where Name=? and Password=?");
$sentencia->execute([$usuario, $password]);
$login = $sentencia->fetch(PDO::FETCH_OBJ);

if($login){
    $_SESSION['NombreUsuario'] = $login->Name;
    $_SESSION['IdUsuario'] = $login->idUsers;
    header("location: ../../principal.php");
}
else{
    header("location: ../../login.php?Error=400");
}
?>