<?php
function dm($data)
{
    echo "<pre>" . print_r($data, 1) . "</pre>";
}

//Чтение xml базы
$xml = simplexml_load_file('db.xml');



    $login = ($_POST['login']);
    $pass = ($_POST['pass']);
    $pass2 = ($_POST['pass2']);
    $mail = ($_POST['mail']);
    $name = ($_POST['name']);


    $errors = [];

    //валидация полей


if (!empty($login)){
    foreach($xml->user as $value){
        if ($login == $value->login){
            $errors[] = 'Пользователь с таким login уже существует';
        }
    }
    if (!empty($mail) && (preg_match('/^[_A-Za-z0-9-\\+]+(\\.[_A-Za-z0-9-]+)*@[A-Za-z0-9-]+(\\.[A-Za-z0-9]+)*(\\.[A-Za-z]{2,})$/', $mail))){
        foreach($xml->user as $value){
            if ($mail == $value->email){
                $errors[] = 'Пользователь с таким email уже существует';
            }
        }
        if (!empty($pass)){
            if ($pass !== $pass2){
                $errors[]='Пароли не совпадают';
            }
            if (empty($name)){
                $errors[]='Введите имя';
            }
        } else $errors[]='Введите пароль';
    } else $errors[] =  'Некорректно введен email';
} else $errors[] =  'Введите имя пользователя';



//Добавление данных пользователя в базу данных
    if (empty($errors)){

        function generateRandomString($length = 8) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $randomString=generateRandomString();
        $pass = md5($pass.$randomString);

        $count = count($xml->user)+1;
        $user = $xml->addChild('user');
        $user->addAttribute('id', $count);
        $user->addChild('login', $login);
        $user->addChild('password', $pass);
        $user->addChild('email', $mail);
        $user->addChild('name', $name);
        $user->addChild('sault', $randomString);

        $xml->asXML('db.xml');

    }



if(!empty($errors)){
    $response = $errors[0];
}
else {
    $response = 'Вы зарегистрированы';
}

echo json_encode($response);




?>