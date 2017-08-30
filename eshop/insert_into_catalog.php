<?php
/**
 * Created by PhpStorm.
 * User: zahra
 * Date: 09.04.2017
 * Time: 16:31
 */
require "inc/lib.inc.php";
require "inc/config.inc.php";
?>

<form action="insertintocatalog.php" method="post">
    title: <input type="text" name="title"><br>
    author: <input type="text" name="author"><br>
    pubyear: <input type="text" name="pubyear"><br>
    price: <input type="text" name="price"><br>
    <input type="submit" value="Submit">
</form>
