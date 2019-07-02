<?php
session_start();
if ($_SESSION['loggedIn'] !== true){
    if (!empty($_COOKIE['login']) && !empty($_COOKIE['PHPSESSID'])){
        if (!file_exists('db/xmlDataStorage.xml')){
            exit();
        }
        $xml = simplexml_load_file('db/xmlDataStorage.xml');
        $users = $xml->xpath('//user');
        foreach ($users as $user){
            if ($_COOKIE['login'] == $user->login){
                if ($_COOKIE['PHPSESSID'] == $user->phpsessid){
                    $_SESSION['loggedIn'] = true;
                }
            }
        }

    }
}
