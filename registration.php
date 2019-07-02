<?php

if (!empty($_POST)){
    header('Content-Type: application/json');
    require 'function.php';

    //очищаем, проверяем на валидность данные
    $post = array_map('clean', $_POST);
    $errors = validation($post);

    if (!empty($errors)){
        jsonResponse(false, $errors);
    }

    register($post);
}

//проверка на уникальность полей логин и email. $xml - объект SimpleXMLElement
function isUnique($xml, $login, $email)
{
    $errors = [];
    $users = $xml->xpath('//user');
    foreach ($users as $user){
        if ($login == (string) $user->login){
            $errors[]['login'] = 'Логин уже используется';
        }
        if ($email == (string) $user->email){
            $errors[]['email'] = 'Email уже используется';
        }
    }
    return $errors;
}


function validation($post)
{
    $errors = [];
    $login = $post['login'];
    if (empty($login)){
        $errors[]['login'] = 'Укажите логин';
    }

    $password = $post['password'];
    if (empty($password)){
        $errors[]['password'] = 'Укажите пароль';
    }

    $confirmPassword = $post['confirmPassword'];
    if (empty($confirmPassword)){
        $errors[]['confirmPassword'] = 'Подтвердите пароль';
    }

    if (!empty($password) && !empty($confirmPassword) && $password != $confirmPassword){
        $errors[]['confirmPassword'] = 'Пароли не совпадают';
    }

    $email = $post['email'];
    if (empty($email)){
        $errors[]['email'] = 'Укажите email';
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[]['email'] = 'Неверный формат email';
    }

    $name = $post['name'];
    if (empty($name)){
        $errors[]['name'] = 'Укажите имя';
    }
    return $errors;
}

function hashPassword($password)
{
    $salt = substr(sha1(rand()),0,16);
    $hash = sha1($password.$salt);
    return $salt.$hash;
}

//проверку полей на уникальность совмещаем с регистрацией, чтобы лишний раз не обращаться к xml файлу.
function register($post)
{
    if (file_exists('db/xmlDataStorage.xml')){
        $xml = simplexml_load_file('db/xmlDataStorage.xml');
    }else{
        $xml = new SimpleXMLElement('<users/>');
    }

    $errors = isUnique($xml, $post['login'], $post['email']);
    if (!empty($errors)){
        jsonResponse(false, $errors);
    }

    $user = $xml->addChild('user');

    unset($post['confirmPassword']);
    $post['password'] = hashPassword($post['password']);
    foreach ($post as $key => $value){
        $user->addChild($key, $value);
    }

    saveXml($xml);

}