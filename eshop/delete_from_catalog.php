<?php
/**
 * Created by PhpStorm.
 * User: zahra
 * Date: 06.04.2017
 * Time: 21:59
 */
require "inc/lib.inc.php";
require "inc/config.inc.php";

$id = intval($_GET["id"]);
if($id){
    deleteItemFromCatalog($id);
}
header("Location: catalog.php");
exit;