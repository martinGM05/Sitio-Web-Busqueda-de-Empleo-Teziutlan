<?php
    session_start();
    $titleBanner = $_POST['txtTitle'];
    $descriptionBanner = $_POST['txtDescription'];
    $salaryBanner = $_POST['txtSalario'];


    include "conection.php";
    try{
        $sql = $cn->prepare("Insert into Banner (Title, Description, Salary, idEnterprise) values (?,?,?,?)");
        $resultado=$sql->execute([$titleBanner,$descriptionBanner,$salaryBanner, $_SESSION['IdEnterprise']]);
        header('location: ../../principalEmpresa.php');
    }catch (Exception $ex){
        echo 'Error= '.$ex;
    }
?>