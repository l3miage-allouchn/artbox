<?php

// connexion a la base artbox

//PDO (PHP Data Objects) : classe native de PHP
//  servant d'interface unique pour se connecter 
// et échanger avec une base de données
//  (MySQL ici), quel que soit son type.

function connexion() {
    try {
        // pdo = outil php pour parler a une base de donnees. ici : adresse de la bdd, utilisateur, mot de passe
        $pdo = new PDO('mysql:host=localhost;dbname=artbox;charset=utf8', 'root', '');
        return $pdo;
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }
}

// mysql: → on utilise le pilote MySQL 
// host=localhost → le serveur de base de données se trouve sur ma propre machine 
// dbname=artbox → on veut se connecter précisément à la base nommée artbox (celle qu'on a créée dans phpMyAdmin)
// charset=utf8 → on précise l'encodage des caractères, pour que les accents français.
// root ->  l'utilisateur administrateur par défaut créé automatiquement par XAMPP, avec tous les droits sur toutes les bases.
//  le mot de passe : ''
// Une chaîne vide, car XAMPP configure root sans mot de passe par défaut 
// (pratique en développement local, mais à ne jamais faire sur un vrai serveur en production !).