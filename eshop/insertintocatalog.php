<?php
/**
 * Created by PhpStorm.
 * User: zahra
 * Date: 09.04.2017
 * Time: 16:49
 */
require "inc/lib.inc.php";
require "inc/config.inc.php";

global $link;

$sql = "INSERT INTO `catalog` (title,author,pubyear,price)
        VALUES
                            ('".$_POST['title']."',
                             '".$_POST['author']."',
                             '".$_POST['pubyear']."',
                             '".$_POST['price']."')";
mysqli_query($link, $sql);
header("Location: catalog.php");