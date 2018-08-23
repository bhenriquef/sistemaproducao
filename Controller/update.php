<?php
require_once("config.php");
require_once("conectar.php");

function pagamento(){
    if(isset($_POST['btnpagar'])){
        $con = conectar();
        $comandosql = "delete from pagamento where id_pagamento = '".$_POST['idpag']."'";
        $sql = mysqli_query($con,$comandosql);
        desconectar($con);
    }
}
function compras(){
    if(isset($_POST['btncomprar'])){
        $con = conectar();
        $comandosql = "delete from compras where id_compras = '".$_POST['idcompras']."'";
        $sql = mysqli_query($con,$comandosql);
        desconectar($con);
    }
}
function etapaColecao(){
    if(isset($_POST['btnprincipal'])){
        $con = conectar();
        $comandosql = "update colecao set ecolecao_id = '0' where ecolecao_id = '1'";
        $sql = mysqli_query($con,$comandosql);
        $comandosql = "update colecao set ecolecao_id = '1' where id_colecao = '".$_POST['idcolecao']."'";
        $sql = mysqli_query($con,$comandosql);
    }
    else if(isset($_POST['btnconcluir'])){
        $con = conectar();
        $comandosql = "update colecao set ecolecao_id = '2' where id_colecao = '".$_POST['idcolecao']."'";
        $sql = mysqli_query($con,$comandosql);
    }
}


?>