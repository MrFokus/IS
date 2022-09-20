<?php
    session_start();
    setcookie('user_id','',time()-3600*24*30,"/");
    session_destroy();
    header('Location: ../log_in_and_sign/log.php');
?>