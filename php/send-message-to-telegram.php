<?php
$msgs = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
             // токен телеграмм бота и айди группы телеграмма куда бот доставляет сообщения
    $token = "701873402:AAFTqI43DEsG2ZVZJNJ7pES06i4Sqgk_87k";
    $chat_id = "-1001186639647";
 
    if (!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['email']) && !empty($_POST['comment'])){
        $bot_url = "https://api.telegram.org/bot{$token}/";
        $urlForPhoto = $bot_url . "sendPhoto?chat_id=" . $chat_id;
 
        if(!empty($_FILES['file']['tmp_name'])) {
             
            // Путь загрузки файлов
            $path = $_SERVER['DOCUMENT_ROOT'] . '/tmp/';
 
            // Массив допустимых значений типа файла
            $types = array('image/gif', 'image/png', 'image/jpeg');
 
            // Максимальный размер файла
            $size = 1024000;
 
            // Проверяем тип файла
             if (!in_array($_FILES['file']['type'], $types)) {
                 $msgs['err'] = 'Запрещённый тип файла.';
                echo json_encode($msgs);
                die();
             }
              
             // Проверяем размер файла
             if ($_FILES['file']['size'] > $size) {
                 $msgs['err'] = 'Слишком большой размер файла.';
                echo json_encode($msgs);
                die('Слишком большой размер файла.');
             }
              
             // Загрузка файла и вывод сообщения
             if (!@copy($_FILES['file']['tmp_name'], $path . $_FILES['file']['name'])) {
                 $msgs['err'] = 'Что-то пошло не так. Файл не отправлен!';
                 echo json_encode($msgs);
             } else {
                $filePath = $path . $_FILES['file']['name'];
                $post_fields = array('chat_id' => $chat_id, 'photo' => new CURLFile(realpath($filePath)) );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_HTTPHEADER, array( "Content-Type:multipart/form-data" ));
                curl_setopt($ch, CURLOPT_URL, $urlForPhoto);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
                $output = curl_exec($ch);
                unlink($filePath);
             }
				}
				// ЗДЕСЬ СОЗДАЕМ ПЕРЕМЕННУЮ с помощью имени атрибута name и дальше то или иное наименовоние  
				if (isset($_POST['theme'])) {
          if (!empty($_POST['theme'])){
            $theme = "Тема: " .strip_tags($_POST['theme']) . "%0A";
          }
        }
        if (isset($_POST['name'])) {
          if (!empty($_POST['name'])){
            $name = "Имя пославшего: " . strip_tags($_POST['name']) . "%0A";
          }
				}
        if (isset($_POST['phone'])) {
          if (!empty($_POST['phone'])){
            $phone = "Телефон: " . "%2B" . strip_tags($_POST['phone']) . "%0A";
          }
				}
				
				if (isset($_POST['email'])) {
          if (!empty($_POST['email'])){
            $email = "Email: " . strip_tags($_POST['email']) . "%0A";
          }
				}
				
				if (isset($_POST['comment'])) {
          if (!empty($_POST['comment'])){
            $comment = "Комментарий: " . strip_tags($_POST['comment']) . "%0A";
          }
        }
        
        // Формируем порядок текста сообщения и так же здесь вводим имена ПЕРЕМЕННЫХ
        $txt = $theme . $name . $phone . $email . $comment;
        $sendTextToTelegram = file_get_contents("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$txt}");
        if ($output && $sendTextToTelegram) {
            $msgs['okSend'] = 'Спасибо за отправку вашего сообщения!';
            echo json_encode($msgs);
        } elseif ($sendTextToTelegram) {
            $msgs['okSend'] = 'Спасибо за отправку вашего сообщения!';
            echo json_encode($msgs);
          return true;
        } else {
            $msgs['err'] = 'Ошибка. Сообщение не отправлено!';
            echo json_encode($msgs);
            die('Ошибка. Сообщение не отправлено!');
        }
    } else {
        $msgs['err'] = 'Ошибка. Вы заполнили не все обязательные поля!';
        echo json_encode($msgs);;
    }
} else {
  header ("Location: /");
}
?>