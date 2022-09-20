<?php
session_start();
if ($_COOKIE["user_id"] == '') {
    var_dump($_COOKIE["user_id"]);
    header('Location: ../log_in_and_sign/log.php');
    exit();
} else {
    $user_id = $_COOKIE["user_id"];
    $value_profile = "SELECT * FROM USER WHERE user_id = '$user_id'";
    $mysql = new mysqli('localhost', 'root', 'root', 'MY_DATA');
    $check = $mysql->query($value_profile);
    $log = $check->fetch_assoc();
    if ($log['privilege'] != 'admin') {
        header('Location: ../account/account.php');
        exit();
    }
}
?>
<?php
include_once('functions.php')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="addItem.css">
    <title>Account</title>
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
                    <li><a href="../contact/contact.php">Контакты</a></li>
                </ul>
                <a href="../account/account.php"><img class="user_logo" src="../img/profile_icon.png" alt="#"></a>
            </div>
        </div>
    </header>
    <div class="no_header">
        <div class="log">
            <div class="window">
                <div class="information">
                    <h1>Добавление товара</h1><br>
                    <form method="post" action="function.php" enctype="multipart/form-data">
                        <ul>
                            <li>
                                <h3>1. Добавьте фотографию товара </h3><br><input class="load_file" type="file" name="file">
                                <?php
                                if ($_SESSION['Message_file']) {
                                    echo '<p class="msg">' . $_SESSION['Message_file'] . '</p>';
                                }
                                unset($_SESSION['Message_file']);
                                ?>
                            </li>
                            <li>
                                <h3>2. Добавьте материал столешницы товара(описание) </h3><br><textarea class="description_item" name="table_material"></textarea>
                            </li>
                            <li>
                                <h3>3. Добавьте материал подстолья товара(описание) </h3><br><textarea class="description_item" name="footing_material"></textarea>
                            </li>
                            <li>
                                <h3>4. Добавьте количество ног товара </h3><br><input class="description_item" type="number" name="legs">
                            </li>
                            <li>
                                <h3>5. Добавьте форму товара </h3><br><textarea class="description_item" name="shape"></textarea>
                            </li>
                            <li>
                                <h3>6. Добавьте количество товара </h3><br><input class="description_item" type="number" name="kol">
                            </li>
                            <li>
                                <h3>7. Добавьте цену товара </h3><br><input class="description_item" type="number" name="prise">
                            </li>
                            <li>
                                <h3>8. Добавьте название товара </h3><br><textarea class="description_item" name="name"></textarea>
                            </li>

                            <button class="additem" id="save_btn" type="submit"> Сохранить </button>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
    <script></script>
    <footer></footer>
</body>

</html>