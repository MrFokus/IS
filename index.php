<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Главная</title>
</head>
<body>
    <header>
        <div class="fixed_header">
            <div class="logo">
                <a href="index.php"><img class="img_logo" src="img/Без имени-1.png" alt=""></a>
            </div>
            <div class="btn">
                <ul class="menu">
                    <li><a href="../catalog/catalog.php">Каталог</a></li>
                    <li><a href="../contact/contact.php">Контакты</a></li>
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
            <div class="recommendation">
                <h2>Подобрано для вас</h2>
                <div class="window_items">
                    <div class="items"></div>
                    <div class="items"></div>
                    <div class="items"></div>
                </div>
            </div>
            <div class="quote">
                <div class="table_quote">
                    
                    <img class="img_quote" src="img/birds_table_quote.jpeg" alt="">
                </div>
                <p class="p_quote">
                    — Может выберем стол с птичками? — Ты что, какие птички! Стол должен приглашать: «Присядь, дорогой, поешь!» Может, с божьими коровками? — Конечно! С птичками нам не подходит, а эти мерзкие красные жуки возбуждают аппетит! — Ну все! Хочешь птиц – бери птиц! — Нет уж, теперь не возьму...
            </div>
        </div>
    </div>
    <footer>
         <h1>Не является настоящим магазином</h1>
    </footer>
</body>
</html>
