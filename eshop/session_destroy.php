<?php
/**
 * Created by PhpStorm.
 * User: zahra
 * Date: 30.08.2017
 * Time: 16:32
 */
session_start();
session_destroy();
header("Location: catalog.php");
?>