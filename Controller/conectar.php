<?php
require_once('config.php');
function  conectar()
{
    $con = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    mysqli_set_charset($con,"utf8");
    return $con;
}
function desconectar($con){
    mysqli_close($con);
}

?>