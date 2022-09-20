<?php
session_start();
$id_item=$_POST['id_item'];
unset($_SESSION['item_to_basket'][array_search($id_item,$_SESSION['item_to_basket'])]);
header('Location: ../account/account.php');
?>