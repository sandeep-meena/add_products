<?php
$con  = mysqli_connect("localhost","root","","add_products");

if(mysqli_connect_errno()){
    die("Connection failed".mysqli_connect_errno);
}

define("UPLOAD_SRC",$_SERVER['DOCUMENT_ROOT']."/add_product/images/");
define("FETCH_SRC","http://192.168.29.125:8080/add_product/images/");
?>
