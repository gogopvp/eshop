<?php
session_start();
require "inc/lib.inc.php";
require "inc/config.inc.php";

$id = intval($_GET["id"]);
if($id){
    global $link;
    $sql = "SELECT * FROM `product_table` WHERE `user_id`='".$_SESSION['id']."' AND `product_id`=$id";
    $result=mysqli_query($link, $sql);
    $row=mysqli_fetch_row($result);
    if($row['2']==$id){
        $sql="UPDATE `product_table` SET `quantity`=`quantity`+1 WHERE `user_id`='".$_SESSION['id']."' AND `product_id`=$id";
        mysqli_query($link, $sql);
    }
    else {
        $sql="INSERT INTO `product_table`(`user_id`,`product_id`) VALUES ('".$_SESSION['id']."',$id)";
        mysqli_query($link, $sql);
    }
}
header("Location: catalog.php");
exit;