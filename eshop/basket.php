<?php
session_start();
// Проверяем, пусты ли переменные логина и id пользователя
if (empty($_SESSION['login']) or empty($_SESSION['id']))
{
    header("Location: ../index.php");
}
	// подключение библиотек
error_reporting(0);
require "inc/lib.inc.php";
require "inc/config.inc.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <?
    echo "Вы вошли на сайт как ".$_SESSION['login'].".<br>";
    ?>
    <a href="session_destroy.php">Выйти</a>
	<title>Корзина пользователя</title>
</head>
<body>
	<h1>Ваша корзина</h1>
<?php
$goods_in_b=product_count();

echo '<br/>';
if($goods_in_b==0){
    echo "<p>Товаров нет. Верниесь в <a
    href='catalog.php'>каталог</a>";
    exit;
}else{
    echo "<p>Вернуться в <a
    href='catalog.php'>каталог</a>";
}
?>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
<tr>
	<th>N п/п</th>
	<th>Название</th>
	<th>Автор</th>
	<th>Год издания</th>
	<th>Цена, руб.</th>
	<th>Количество</th>
	<th>Удалить</th>
</tr>
<?php
$i = 1;
$sum = 0;
$goods = selectallgoodsfromb();
//print_r($goods);
if($goods === false){
    echo "Произошла ошибка!";
    exit;
}
foreach($goods as $item) {
    ?>
    <tr>
        <td><?= $i ?></td>
        <td><?= $item['title'] ?></td>
        <td><?= $item['author'] ?></td>
        <td><?= $item['pubyear'] ?></td>
        <td><?= $item['price'] ?></td>
        <td><?= $item['quantity'] ?></td>
        <td><a href="delete_from_basket.php?id=<?= $item['id'] ?>">Удалить</a></td>
    </tr>
    <?
    $i++;
    $sum += $item['price'] * $item['quantity'];
}
?>
</table>

<p>Всего товаров в корзине на сумму: <?=$sum?>руб.</p>

<div align="center">
	<input type="button" value="Оформить заказ!"
                      onClick="location.href='orderform.php'" />
</div>

</body>
</html>