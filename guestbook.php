<?php
 if($_SERVER['REQUEST_METHOD']== 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    $message = nl2br($message);
    $date = date('Y-m-d H:i:s');
    $post = "<p><b>Имя:</b> $name<br><b>Email:</b> $email<br><b>Дата:</b><i> $date</i><br><b>Сообщение:</b><br>$message</p>\n";

    if (!file_exists('data.txt')) {
        touch('data.txt');
    }

    file_put_contents('data.txt',$post,FILE_APPEND);
    header('Location:guestbook.php');
 }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Гостевая книжка</title>
    <style>

        body {

       font-family:Verdana;
       font-size:18px;
    }
        
        
        input, textarea {
            font-size:20px;
            padding:5px 5px;
            margin-bottom:20px;
            border:2px solid #ebb217;
        }

        input[type='submit'] {
            border:1px solid orange;
            border-radius:10px;
            background-color:orange;
        }

    </style>
</head>
<body>
    <h1>Гостевая книга</h1>
    <div>
    <form action='guestbook.php' method='post'>
        <div>
          <input type='text' name='name' placeholder='Введите имя' required>
        </div>
        <div>
        <input type='email' name='email' placeholder='Введите email' required>
        </div>
        <div>
        <textarea name='message' required> </textarea>
        </div>
        <div>
            <input type='submit' value='Оставить сообщение'/>
        </div>
    </form> 
    </div>
    <h1>Сообщения</h1>
    <?php
       $messages = file('data.txt');
       $messages = array_reverse($messages);
       foreach($messages as $message) {
        echo $message;
       }
    ?>
</body>
</html>