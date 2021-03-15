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
    
    $sql = "select e.idEnterprise from Enterprise as e inner join Users as u on e.idUsers = u.idUsers where e.idUsers =".$_SESSION['IdUsuario'];
    $result = $cn->query($sql);
    $login3 = $result->fetch(PDO::FETCH_OBJ);
    if($login3){
        $_SESSION['IdEnterprise'] = $login3->idEnterprise;
    }

    
    $sentencia2 = $cn->prepare("select*from Users as u inner join People as p on u.idUsers = p.idUsers where Name=? and Password=?");
    $sentencia2->execute([$usuario, $password]);
    $login2 = $sentencia2->fetch(PDO::FETCH_OBJ);
    if($login2){
        header("location: ../../principal.php");
    }else{
        header("location: ../../principalEmpresa.php");
    }
    
}
else{
    header("location: ../../login.php?Error=400");
}
?>