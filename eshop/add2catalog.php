<?php

require "inc/lib.inc.php";
require "inc/config.inc.php";

global $link;

$sql = "UPDATE `catalog`  
        SET                
                           `author`='".$_POST['author']."',
                           `title`='".$_POST['title']."',
                           `pubyear`='".$_POST['pubyear']."',
                           `price` = '".$_POST['price']."'
        WHERE 
                           `id` = '".$_POST['id']."'";
mysqli_query($link, $sql);
header("Location: catalog.php");