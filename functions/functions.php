<?php
require_once "connect.php";
// подключение файла
function getBase ($changebasa, $limit) {
   global $mysqli;
   connectDB();
   $result = $mysqli->query("SELECT * FROM `$changebasa` ORDER BY 'GlobalNumber' DESC LIMIT $limit");
   closeDB();
   if ($result==0) {
      return 0;
   }
   return resultToArray ($result);
}

function resultToArray ($result) {
   $array = array ();
   while (($row = $result->fetch_assoc()) != false)
      $array[] = $row;
   return $array;
}

function getCompany ($idcompany) {
    global $mysqli;
    connectDB();
    $result = $mysqli->query( "SELECT * FROM `Companies` WHERE `idcompany` = '$idcompany'");
    closeDB();
    $array = $result->fetch_assoc();
    return $array;
}

//Конвертация docx в html
   // function readDocs($filePath) {
   //    // Создать новый ZIP-архив
   //    $zip = new ZipArchive;
   //    $dataFile = 'word/document.xml';
   //    // Открыть полученный архивный файл
   //    if (true === $zip->open($filePath)) {
   //       // Если сделано, выполните поиск файла данных в архиве
   //       if (($index = $zip->locateName($dataFile)) !== false) {
   //          // Если он найден, прочитайте его в строке
   //          $data = $zip->getFromIndex($index);
   //          // Закрыть архивный файл
   //          $zip->close();
   //          // Загрузка XML из строки
   //          // Пропустить ошибки и предупреждения
   //          $xml = DOMDocument::loadXML($data, LIBXML_NOENT | LIMBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
   //          // Возвращать данные без тегов форматирования XML
   //
   //          $contents = explode('\n',strip_tags($xml->saveXML()));
   //          $text = '';
   //          foreach($contents as $i=>$content) {
   //             $text .= $contents[$i];
   //          }
   //          return $text;
   //       }
   //       $zip->close();
   //    }
   //    // В случае отказа возвращать
   //    return "Документ не загружен";
   //
   // }

/**
   * Функция загрузки файла (аплоадер)
   * @param  int    $max_file_size    максимальный размер файла в мегабайтах
   * @param  array  $valid_extensions массив допустимых расширений
   * @param  string $upload_dir       директория загрузки
   * @return array                    сообщение о ходе выполнения
   */


function uploadHandlePng($max_file_size = 1024, $valid_extensions = array(), $upload_dir = '.', $name){
   $error = null;
   $info  = null;
   $max_file_size *= 1048576;  // размер файла в Mb
   if ($_FILES['loadlogo']['error'] === UPLOAD_ERR_OK){
      //если $_FILES = нет ошибок
      // проверяем расширение файла
      $file_extension = pathinfo($_FILES['loadlogo']['name'], PATHINFO_EXTENSION);
      //$file_extension = информация о пути файла (имя файла, расширение) , тоесть переменная =  расщирение
      if (in_array(strtolower($file_extension), $valid_extensions)){
      //есть ли в массиве(переводит все буквы в нижний регистр(переменная=расширение), массив с разрешенным расширениями))
         // проверяем размер файла
         if ($_FILES['loadlogo']['size'] < $max_file_size){
            $file_name = $name .'.png';  // имя файла = имя ид компании.png
            $destination = $upload_dir .'/' . $file_name;
               if (move_uploaded_file($_FILES['loadlogo']['tmp_name'], $destination))
               //move_uploaded_file - перемещает загруженный файл в другое место
               //$_FILES['loadlogo']['tmp_name'] - имя фала с путем.
                  $info = 'Файл успешно загружен';
                  else
                     $error = 'Не удалось загрузить файл';
         }
            else
               $error = 'Размер файла больше допустимого';
      }
         else
         $error = 'У файла недопустимое расширение';
   }
      else {
         // массив ошибок
         $error_values = array(
            UPLOAD_ERR_INI_SIZE   => 'Размер файла больше разрешенного директивой upload_max_filesize в php.ini',
            UPLOAD_ERR_FORM_SIZE  => 'Размер файла превышает указанное значение в MAX_FILE_SIZE',
            UPLOAD_ERR_PARTIAL    => 'Файл был загружен только частично',
            UPLOAD_ERR_NO_FILE    => 'Не был выбран файл для загрузки',
            UPLOAD_ERR_NO_TMP_DIR => 'Не найдена папка для временных файлов',
            UPLOAD_ERR_CANT_WRITE => 'Ошибка записи файла на диск'
         );
         $error_code = $_FILES['loadlogo']['error'];
         if (!empty($error_values[$error_code]))
            $error = $error_values[$error_code];
         else
            $error = 'Случилось что-то непонятное';
      }
   return array('info' => $info, 'error' => $error, 'destination' => $destination);
   }
?>
