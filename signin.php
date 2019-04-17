<?php

function dm($data)
{
    echo "<pre>" . print_r($data, 1) . "</pre>";
}

//Чтение xml базы
$xml = simplexml_load_file('db.xml');


session_start();

$login = $_POST['username'];
$pass1 = $_POST['pass'];

$errors = '';

if (!empty($login) && !empty($pass1)) {


    foreach ($xml->user as $value) {

        if ($login == $value->login) {
            $errors = '';

            $sault = $value->sault;
            $pass = md5($pass1 . $sault);

            if ($pass == $value->password) {
                $_SESSION['username'] = $login;

                if ($_POST['check'] == 'true') {
                    setcookie('username', $login, time() + (60 * 60 * 24 * 31));
                    setcookie('password', $pass1, time() + (60 * 60 * 24 * 31));

                } else {
                    setcookie('username', '');
                    setcookie('password', '');
                }
                break;
            } else $errors = 'Неверный пароль';

        } else $errors = 'Пользователя с таким login не существует';
    }

} else if (empty($login)) {
    $errors = 'Введите login';
} else if (empty($pass)) {
    $errors = 'Введите pass';
}

if(!empty($errors)){
    $response = $errors;
}
else{
    $response =  true;
}

echo json_encode($response);

?>