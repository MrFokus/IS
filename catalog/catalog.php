<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="catalog.css">
    <title>Каталог</title>
</head>

<body>
    <header>
        <div class="fixed_header">
            <div class="logo">
                <a href="../index.php"><img class="img_logo" src="../img/Без имени-1.png" alt=""></a>
            </div>
            <div class="btn">
                <ul class="menu">
                    <li><a href="catalog.php">Каталог</a></li>
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

            <?php
            $mysql = new mysqli('localhost', 'root', 'root', 'MY_DATA');
            $query = 'SELECT * FROM items_info';
            $result = $mysql->query($query);
            while ($row = $result->fetch_assoc()) // получаем все строки в цикле по одной
            {
                $query_prise = "SELECT * FROM prise WHERE id_prise =" . $row['id_prise'];
                $result_prise = $mysql->query($query_prise);
                $row_prise = $result_prise->fetch_assoc();
                if (($row_prise['kol'] != 0) || ($_SESSION['user_info']['privilege'] == 'admin')) {
                    echo '<div class="item">
                     <form action="set_item.php" method="post"> 
                    <div class="photo"> 
                    <img src="../img/' . $row['path_photo'] . '" alt=""> 
                    </div>
                    <div class="description"> 
                    <p class="Name_item"><strong> "' . $row['Name'] . '"</strong></p>
                    <p><strong>Цена:</strong> <br>' . $row_prise['prise'] . ' Руб.</p>
                    <p><strong>Количество:</strong> <br> ' . $row_prise['kol'] . '</p>
                    <p><strong>Материал столешницы:</strong> <br> ' . $row['table_material'] . '</p>
                    <p><strong>Материал подстолья:</strong> <br>' . $row['footing_material'] . '</p>
                    <p><strong>Форма:</strong> <br>' . $row['shape'] . '</p>
                    <input type="hidden" name="post_id" value="' . $row['id_item'] . '"/>
                    </div>';
                    if ($row['id_item'] != $_SESSION['Message']) {
                        if ($_SESSION['user_info']['privilege'] != 'admin') {
                            if ($row_prise['kol'] != 0) {
                                echo '<div class="btn_item"><button class="description" >Добавить в корзину</button>
                        </div>
                        </form>
                        </div>';
                            } else {
                                echo '<div class="btn_item"><button disabled style="background-color: red;" class="description" >Товар закончился</button>
                                </div>
                            </form>
                            </div>';
                            }
                        }
                        else{
                            if ($row_prise['kol'] != 0) {
                                echo '<div class="btn_item"><button class="description" >Добавить в корзину</button>
                        <button class="description" style="margin-top: 10px; background-color: rgb(16, 72, 192);">Редактировать</button>
                        </div>
                        </form>
                        </div>';
                            } else {
                                echo '<div class="btn_item"><button disabled style="background-color: red;" class="description" >Товар закончился</button>
                                </div>
                            </form>
                            </div>';
                            }
                        }
                    } else {
                        echo '<button id="btn_dis" disabled class="description"> Товар уже есть в корзине</button>
                        </form>
                        </div>';
                        unset($_SESSION['Message']);
                    }
                }
            }
            ?>
        </div>

    </div>
    <footer></footer>
</body>

</html>