<?php
    $user_id = $_COOKIE["user_id"];
    $addres=$_GET['addres'];
    //echo($addres);
    $query="UPDATE USER SET addres='$addres' WHERE user_id = $user_id";
    $mysql=new mysqli('localhost','root','root','MY_DATA');
    $mysql->query($query);
    header('Location: account.php');
?>