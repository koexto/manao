<?php
if(!empty($_POST)){
    header('Content-Type: application/json');
    require 'function.php';

    //очищаем, проверяем на валидность данные
    $post = array_map('clean', $_POST);
    $errors = validation($post);

    if(!empty($errors)) {
        jsonResponse(false, $errors);
    }

    $xml = simplexml_load_file('db/xmlDataStorage.xml');
    if (!$xml) {
        $errors[]['info'] = 'Не удалось проверить данные. Свяжитесь с администрацией.';
        jsonResponse(false, $errors);
    }

    $users = $xml->xpath('//user');
    $login = $post['login'];
    $password = $post['password'];

    //проверяем пользователя, пароль и устанавливаем переменные  SESSION, COOKIE в случае успеха
    foreach ($users as $user){
        if ($login == (string) $user->login){
            if (comparePassword($password, (string) $user->password)){

                session_start();
                $_SESSION['loggedIn'] = true;
                setcookie('name', (string) $user->name, time()+60*60*24*30);
                setcookie('login', $login, time()+60*60*24*30);

                if (empty($user->phpsessid)){
                    $user->addChild('phpsessid', session_id());
                }else{
                    $user->phpsessid = session_id();
                }

                saveXml($xml);

            }else{
                $errors[]['password'] = 'Неверный пароль';
                jsonResponse(false, $errors);
            }

        }
    }

    $errors[]['login'] = 'Пользователь не найден';
    jsonResponse(false, $errors);
}

function validation($post)
{
    $errors = [];

    if (empty($post['login'])){
        $errors[]['login'] = 'Укажите логин';
    }

    if (empty($post['password'])){
        $errors[]['password'] = 'Укажите пароль';
    }

    return $errors;
}

function comparePassword($password, $passwordFromDB)
{
    $salt = substr($passwordFromDB, 0, 16);
    $passwordFromDB = substr($passwordFromDB, 16);
    $hash = sha1($password . $salt);

    if ($hash === $passwordFromDB){
        return true;
    }

    return false;
}
