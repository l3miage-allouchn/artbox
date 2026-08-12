<?php

// connexion a la base artbox
function connexion() {
    $pdo = new PDO('mysql:host=localhost;dbname=artbox;charset=utf8', 'root', '');
    return $pdo;
}
