<?php
session_start();
date_default_timezone_set('Europe/Moscow');
$user_id = $_COOKIE["user_id"];
$total = $_SESSION['total'];
$date = date("H:i:s d/m/Y");
$mysql = new mysqli('localhost', 'root', 'root', 'MY_DATA');
$query_add_purchases = "INSERT INTO `purchases`(`user_id`, `total`, `date_purchase`) 
  VALUES ($user_id,$total,'$date')";
//var_dump($query_add_purchases);
$mysql->query($query_add_purchases);
$id_purchases = mysqli_insert_id($mysql);
$kol_items = [];
foreach ($_POST['kol_item'] as $kol_item) {
    array_push($kol_items, $kol_item);
}
for ($i = 0; $i < count($kol_items); $i++) {
    $kol_item = $kol_items[$i];
    $id_item = $_SESSION['item_to_basket'][$i];

    $query_get_id_prise = 'SELECT * FROM items_info WHERE id_item=' . $id_item;
    $result = $mysql->query($query_get_id_prise);
    $row = $result->fetch_assoc();

    $query_prise = "SELECT * FROM prise WHERE id_prise =" . $row['id_prise'];
    $result_prise = $mysql->query($query_prise);
    $row_prise = $result_prise->fetch_assoc();
    $prise_item=$row_prise['prise'];

    $query_add_item_purchases = "INSERT INTO `connect_table`(`id_purchases`, `id_item`, `kol`, `prise_item`) 
    VALUES ($id_purchases,$id_item,$kol_item,$prise_item)";
    $mysql->query($query_add_item_purchases);
    
    $new_kol=$row_prise['kol']-$kol_item;
    $query_minus_kol_prise = "UPDATE `prise` SET `kol` = '$new_kol' WHERE `prise`.`id_prise` =". $row['id_prise'];
    $mysql->query($query_minus_kol_prise);
}
unset($_SESSION['item_to_basket']);
header('Location: account.php');