<?php
session_start();
$id_item = $_POST['post_id'];
if ($_SESSION['item_to_basket'] == NULL) {
    $_SESSION['item_to_basket'][sizeof($_SESSION['item_to_basket'])] = $id_item;
    header('Location: ../account/account.php');
    exit();
}
foreach ($_SESSION['item_to_basket'] as $value) {
    if ($value == $id_item) {
        $_SESSION['Message']=$id_item;
        header('Location: catalog.php');
        exit();
    }
}
$_SESSION['item_to_basket'][] = $id_item;
header('Location: ../account/account.php');
