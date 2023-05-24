<?php

    $username = 'root';
    $password = '';
    

    try {
        $db = new PDO('mysql:host=localhost;dbname=register;',"$username","$password");

        

    } catch (PDOException $e) {
        echo $e-> getMessage();
    }





?>