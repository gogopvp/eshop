<?php
    session_start();
    // Проверяем, пусты ли переменные логина и id пользователя
    if (empty($_SESSION['login']) or empty($_SESSION['id']))
        {
            header("Location: ../index.php");
        }
	// подключение библиотек
	require "inc/lib.inc.php";
	require "inc/config.inc.php";
    error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <?
    echo "Вы вошли на сайт как ".$_SESSION['login'].".<br>";
    ?>
    <a href="session_destroy.php">Выйти</a>
	<title>Каталог товаров</title>
</head>
<body>
<p>Товаров в <a href="basket.php">корзине</a>
    <?php
    $goods_in_b=product_count();
    echo $goods_in_b;
    ?>:
</p>
<table border="1" cellpadding="5" cellspacing="0" width="100%">

<tr>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>В корзину</th>
    <th>Редактировать</th>
    <th>Удалить</th>
</tr>
<?php
$goods = selectAllItems();
if($goods === false){
	echo "Произошла ошибка!";
	exit;
}
foreach($goods as $item){
?>
	<tr>
		<td><?= $item['title']?></td>
		<td><?= $item['author']?></td>
		<td><?= $item['pubyear']?></td>
		<td><?= $item['price']?></td>
        <td><a href="add2basket.php?id=<?= $item['id']?>">В корзину</a></td>
        <td><a href="update_catalog.php?id=<?= $item['id']?>">Edit</a></td>
        <td><a href="delete_from_catalog.php?id=<?= $item['id']?>">Delete</a></td>
	</tr>
<?
}
?>
</table>
<p>Добавить новый товар в таблицу <a href="insert_into_catalog.php">каталог</a>.</p>
</body>
</html>