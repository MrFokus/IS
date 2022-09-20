<?php
session_start();
$table_material = $_POST['table_material'];
$footing_material = $_POST['footing_material'];
$legs = $_POST['legs'];
$shape = $_POST['shape'];
$kol = $_POST['kol'];
$prise = $_POST['prise'];
$name = $_POST['name'];
$mysql = new mysqli('localhost', 'root', 'root', 'MY_DATA');

if (isset($_FILES['file'])) {
  // проверяем, можно ли загружать изображение
  $check = can_upload($_FILES['file']);

  if ($check === true) {
    // загружаем изображение на сервер
    make_upload($_FILES['file']);
    $_SESSION['Message_file'] = "<strong>Файл успешно загружен!</strong>";
    header('Location: ../admin/addItem.php');
    exit();
  } else {
    // выводим сообщение об ошибке
    $_SESSION['Message_file'] = '<strong>' . $check . '</strong>';
    header('Location: ../admin/addItem.php');
    exit();
  }
}

function can_upload($file)
{
  // если имя пустое, значит файл не выбран
  if ($file['name'] == '')
    return 'Вы не выбрали файл.';

  /* если размер файла 0, значит его не пропустили настройки 
	сервера из-за того, что он слишком большой */
  if ($file['size'] == 0)
    return 'Файл слишком большой.';

  // разбиваем имя файла по точке и получаем массив
  $getMime = explode('.', $file['name']);
  // нас интересует последний элемент массива - расширение
  $mime = strtolower(end($getMime));
  // объявим массив допустимых расширений
  $types = array('jpg', 'png', 'gif', 'bmp', 'jpeg');

  // если расширение не входит в список допустимых - return
  if (!in_array($mime, $types))
    return 'Недопустимый тип файла.';

  return true;
}
function make_upload($file)
{
  global $table_material, $footing_material, $legs, $shape, $kol, $prise, $mysql, $name;
  // формируем уникальное имя картинки: случайное число и name
  $name_img = $file['name'];
  $path = $_SERVER['DOCUMENT_ROOT'] . '/img/' . $file['name'];
  move_uploaded_file($file['tmp_name'], $path);
  $query_prise = "INSERT INTO `prise`(`prise`, `kol`) 
  VALUES ('$prise','$kol')";
  $mysql->query($query_prise);
  $id_prise = $mysql->insert_id;
  var_dump($table_material, $footing_material, $legs, $shape, $kol, $prise);
  $query_item_info = "INSERT INTO `items_info`(`table_material`, `footing_material`, `number_legs`, `shape`, `id_prise`, `path_photo`, `Name`) 
  VALUES ('$table_material','$footing_material','$legs','$shape','$id_prise','$name_img','$name')";
  $mysql->query($query_item_info);
}
