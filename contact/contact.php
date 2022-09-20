<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="contact.css">
    <title>Главная</title>
</head>
<body>
    <header>
        <div class="fixed_header">
            <div class="logo">
                <a href="../index.php"><img class="img_logo" src="../img/Без имени-1.png" alt=""></a>
            </div>
            <div class="btn">
                <ul class="menu">
                    <li><a href="../catalog/catalog.php">Каталог</a></li>
                    <li><a href="contact.php">Контакты</a></li>
                    <?php
                    if ($_COOKIE["user_id"] == '') {
                        echo '<li><a href="../log_in_and_sign/log.php">Войти</a></li> </ul>';
                    } else {
                        echo '</ul> <a href="../account/account.php"><img class="user_logo" src="../img/profile_icon.png" alt="#"></a>';
                    } ?>
            </div>
        </div>
    </header>    
    <div class="shop">
        <div class="scroll">
            <div class="info">
                <p>Данная информационная система является проектом в высшем учебном заведении и не имеет ничего общего с настоящим  магазином.</p> <br>
                <p>Для связи german_glubokov@mail.ru</p>
            </div>
        </div>
    </div>
    <footer></footer>
</body>
</html>