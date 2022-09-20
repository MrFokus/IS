<?php session_start();
?>
<?php if ($_COOKIE["user_id"] == '') {
    header('Location: ../log_in_and_sign/log.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="account.css">
    <title>Account</title>
</head>

<body>
    <div class="modal_window">
        <div class="modalDialog">
            <p class="message"> Заполните поле Адрес</p>
            <button class="btn_MD">ОК</button>
        </div>
    </div>
    <div class="modal_window_info">
        <div class="modalDialog">
            <form action="buy.php" method="post">
                <div class="proverka_info">
                    <p>Проверьте данные</p>
                    <?php
                    echo $_SESSION['user_info']['Name'] . '<br>';
                    echo $_SESSION['user_info']['tel'] . '<br>' .
                        '<strong>Адрес:</strong> <br>';
                    echo $_SESSION['user_info']['addres'] . '<br>' .
                        '<strong>Товары:</strong> <br>';
                    ?>
                    <div class="js_info">
                    </div>
                </div>
                <div class="btn_block">
                    <button id="zakaz" type="submit" class="btn_end_zakaz">Заказать</button>
                    <button id="cancel" type="button" class="btn_end_zakaz">Отмена</button>
                </div>
            </form>
        </div>
    </div>
    <header>
        <div class="fixed_header">
            <div class="logo">
                <a href="../index.php"><img class="img_logo" src="../img/Без имени-1.png" alt=""></a>
            </div>
            <div class="btn">
                <ul class="menu">
                    <li><a href="../catalog/catalog.php">Каталог</a></li>
                    <li><a href="../contact/contact.php">Контакты</a></li>
                </ul>
                <a href="account.php"><img class="user_logo" src="../img/profile_icon.png" alt="#"></a>
            </div>
        </div>
    </header>
    <div class="no_header">
        <div class="log">
            <div class="window">
                <div class="information">
                    <?php
                    $user_id = $_COOKIE["user_id"];
                    $value_profile = "SELECT * FROM USER WHERE user_id = '$user_id'";
                    $mysql = new mysqli('localhost', 'root', 'root', 'MY_DATA');
                    $check = $mysql->query($value_profile);
                    $log = $check->fetch_assoc();
                    $_SESSION['user_info'] = $log;
                    echo "<span class=\"info\">" . $log['Name'] . "</span> <br>";
                    echo "<span class=\"info\">" . $log['tel'] . "</span>";
                    ?>
                    <p class="addres">Адрес</p>
                    <form action="change_addres.php" method="get">
                        <textarea disabled style=" height: 5vh; width: 100%;" id="addres_info" class="addres" name="addres"><?php echo ($log['addres']) ?></textarea>
                        <br>
                        <div class="allbtn">
                            <div class="button">
                                <button type="submit" id="save_addres_btn" class="btn_window">Сохранить</button>
                                <button type="button" id="change_addres" class="btn_window">Изменить</button>
                            </div>
                            <?php if ($log['privilege'] == 'admin') {
                                echo "<button onclick=\"document.location='../admin/addItem.php'\" type=\"button\" class=\"btn_window\" id=\"admin_add_item\">Добавить товар</button>";
                            } ?>

                        </div>
                    </form>
                    <p class="info">Корзина</p>
                    <div class="basket">
                        <?php
                        $mysql = new mysqli('localhost', 'root', 'root', 'MY_DATA');
                        $_SESSION['total'];
                        unset($_SESSION['total']);
                        foreach ($_SESSION['item_to_basket'] as $value) {
                            $query = 'SELECT * FROM items_info WHERE id_item=' . $value;
                            $result = $mysql->query($query);
                            $row = $result->fetch_assoc();
                            $query_prise = "SELECT * FROM prise WHERE id_prise =" . $row['id_prise'];
                            $result_prise = $mysql->query($query_prise);
                            $row_prise = $result_prise->fetch_assoc();
                            echo '<div class="item">
                            <div class="photo">
                                <img src="../img/' . $row['path_photo'] . '" class="mini_photo" alt="">
                            </div>
                            <div class="description">';
                            if ($row_prise['kol'] != 0) {
                                $_SESSION['total'] += $row_prise['prise'];
                                echo '<p class="Name_item"><strong class="Name"> "' . $row['Name'] . '"</strong></p>
                                <p><strong>Цена:</strong> <br> <span class="prise">' . $row_prise['prise'] . '</span> Руб.</p>
                                <p><strong>Количество:</strong> <br></p>
                                <form action="delete_item.php" method="post">
                                <div class="set_kol">
                                <button type="button" class="minus">-</button>
                                <input type="text" disabled class="kol_item" value="1">
                                <input type="hidden" class="max_kol" name="post_id" value="' . $row_prise['kol'] . '"/>
                                <input type="hidden" name="id_item" value="' . $row['id_item'] . '"/>
                                <button type="button" class="plus">+</button>
                                <button class="delete_btn">Удалить</button>
                                </div>
                                </form>
                                </div>
                                </div>';
                            } else {
                                echo '<p class="Name_item"><strong class="Name"> "' . $row['Name'] . '"</strong></p>
                                <form action="delete_item.php" method="post">
                                <div class="set_kol">
                                <input type="hidden" name="id_item" value="' . $row['id_item'] . '"/>
                                <h1 style="color: red;">Товара нет в наличии</h1>
                                <button class="delete_btn">Удалить</button>
                                </div>
                                </form>
                                </div>
                                </div>';
                            }
                        }
                        ?>
                    </div>
                    <div class="total">
                        <?php
                        if ($_SESSION['total'] != NULL) {
                            echo '<p> Итого: <span class="span_total">' . $_SESSION['total'] . '</span> Руб.</p>
                            <button class="btn_proverka"> Оформить</button>';
                        }
                        ?>
                    </div>
                    <p class="info">Заказы</p>
                    <div class="history">

                        <?php
                        $mysql = new mysqli('localhost', 'root', 'root', 'MY_DATA');
                        $query = 'SELECT * FROM `purchases` WHERE `user_id`=' . $_COOKIE["user_id"];
                        $result = $mysql->query($query);
                        while ($row = $result->fetch_assoc()) {
                            //var_dump($row);
                            $id_purchases = $row['id_purchases'];
                            $query_CT = 'SELECT * FROM `connect_table` WHERE `id_purchases`=' . $id_purchases;
                            $result_CT = $mysql->query($query_CT);
                            while ($row_CT = $result_CT->fetch_assoc()) {
                                //var_dump($row_CT);
                                $id_item = $row_CT['id_item'];
                                $query_item_info = 'SELECT * FROM items_info WHERE `id_item`=' . $id_item;
                                $result_item_info = $mysql->query($query_item_info);
                                $row_item_info = $result_item_info->fetch_assoc();
                                // $total_item=$row_CT['kol']*
                                //var_dump($row_item_info);
                                echo '<div class="item">
                            <div class="photo">
                                <img src="../img/' . $row_item_info['path_photo'] . '" class="mini_photo" alt="">
                            </div>
                            <div class="description">
                                <p class="Name_item"><strong class="Name"> "' . $row_item_info['Name'] . '"</strong></p>
                                <p><strong>Количество:</strong> <br>' . $row_CT['kol'] . '</p>
                                <p><strong>Цена:</strong> <br>' . $row_CT['prise_item'] . '</p>
                                <p><strong>Дата заказа:</strong> <br>' . $row['date_purchase'] . '</p>
                                </div>
                                </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
                <a class="exit_log" href="unlogin.php">Для выхода нажми на меня</a>
            </div>
        </div>
    </div>
    <script src="account.js"></script>
    <footer></footer>
</body>

</html>