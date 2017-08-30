<?php
/**
 * Created by PhpStorm.
 * User: zahra
 * Date: 06.04.2017
 * Time: 22:08
 */
require "inc/lib.inc.php";
require "inc/config.inc.php";

$id = intval($_GET["id"]);
global $link;
$sql = "SELECT * FROM catalog WHERE id=$id";
$result=mysqli_query($link, $sql);
$row = mysqli_fetch_assoc($result);
print_r($row);

?>
<form action="add2catalog.php" method="post">
    title: <input value="<?php echo $row["title"]?>" type="text" name="title"><br>
    author: <input value="<?php echo $row["author"]?>" type="text" name="author"><br>
    pubyear: <input value="<?php echo $row["pubyear"]?>" type="text" name="pubyear"><br>
    price: <input value="<?php echo $row["price"]?>" type="text" name="price"><br>
           <input value="<?= $id?>" type="hidden" name="id">
  <input type="submit" value="Submit">
</form>
