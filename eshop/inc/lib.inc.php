<?php
function selectAllItems(){
	global $link;
	$sql = 'SELECT id, title, author, pubyear, price FROM catalog';
	if(!$result = mysqli_query($link, $sql))
		return false;
	$items = mysqli_fetch_all($result, MYSQLI_ASSOC);
	mysqli_free_result($result);
	return $items;
}
function saveBasket(){
    global $basket;
    $basket = base64_encode(serialize($basket));
    setcookie('basket', $basket);
}
function basketInit()
{
    global $basket, $count;
    if (!isset($_COOKIE['basket'])) {
        $basket = ['orderid' => uniqid()];
        saveBasket();
    } else {
        $basket = unserialize(base64_decode($_COOKIE['basket']));
        //$count = count($basket) - 1;
    }

}
function add2Basket($id){
    global $link;
    $sql = 'SELECT * FROM product_table';
    $result=mysqli_query($link, $sql);
    $arr=mysqli_fetch_assoc($result);
    if ($arr['product_id']!=$id){

    }
    /*global $basket;
    if (!is_null($basket[$id])){
        $basket[$id]= $basket[$id]+1;
    } else {
        $basket[$id] = 1;
    }
    saveBasket();
    */
}

/**
 * @return bool
 */
function result2Array($data){
    global $basket;
    $arr = [];
    while($row = mysqli_fetch_assoc($data)){
        $row['quantity'] = $basket[$row['id']];
        $arr[] = $row;
    }
    return $arr;
}
function myBasket(){
    global $link, $basket;
    $goods = array_keys($basket);
    array_shift($goods);
    if(!$goods)
        return false;
    $ids = implode(",", $goods);
    $sql = "SELECT id, author, title, pubyear, price FROM catalog WHERE id IN ($ids)";
    if(!$result = mysqli_query($link, $sql))
        return false;
    $items = result2Array($result);
    mysqli_free_result($result);
    return $items;
}
function deleteItemFromBasket($id){

    global $link;
    $sql = "SELECT quantity FROM product_table WHERE product_id = $id";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_row($result);
    if ($row['0']>1){
        $sql="UPDATE `product_table` SET `quantity`=`quantity`-1 WHERE `product_id`=$id";
        mysqli_query($link, $sql);
    }
    else {
        $sql = "DELETE FROM `product_table` WHERE `product_id`=$id";
        mysqli_query($link, $sql);
    }
    /*
    global $basket;
    unset($basket[$id]);
    saveBasket();
    */
    }

function deleteItemFromCatalog($id){
    global $link;
    $sql = "DELETE FROM catalog WHERE id=$id";
    mysqli_query($link, $sql);
}

function clearInt($data){
    return abs((int)$data);
}

function product_count(){
    global $link;
    $sql="SELECT SUM(quantity) FROM `product_table`
          WHERE user_id='".$_SESSION['id']."'";
    $result=mysqli_query($link, $sql);
    $row=mysqli_fetch_row($result);
    return $goods_in_b=$row['0'];
}

function selectallgoodsfromb(){
    global $link;
    $sql="SELECT c.id, c.title, c.author, c.pubyear, c.price, p.quantity 
          FROM catalog c INNER JOIN product_table p ON c.id = p.product_id
          WHERE p.user_id='".$_SESSION['id']."'";
    if(!$result = mysqli_query($link, $sql))
        return false;
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    return $items;
}