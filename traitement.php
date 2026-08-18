<?php
    require 'bdd.php';

    $titre = trim($_POST['titre'] ?? '');
    $artiste = trim($_POST['artiste'] ?? '');
    $image = trim($_POST['image'] ?? '');
    $description = trim($_POST['description'] ?? '');

    // les regles demandees par l'exercice : rien de vide, description un minimum longue, image en vraie url https
    if ($titre === '') {
        header('Location: ajouter.php?erreur=titre');
        exit;
    } elseif ($artiste === '') {
        header('Location: ajouter.php?erreur=artiste');
        exit;
    } elseif (strlen($description) < 3) {
        header('Location: ajouter.php?erreur=description');
        exit;
    } elseif (strpos($image, 'https://') !== 0) {
        header('Location: ajouter.php?erreur=image');
        exit;
    }

    $pdo = connexion();
    $stmt = $pdo->prepare('INSERT INTO oeuvres (titre, artiste, image, description) VALUES (?, ?, ?, ?)');
    // htmlspecialchars avant l'insertion pour qu'un titre/description avec du code html/js ne s'execute jamais quand on l'affiche
    $stmt->execute([
        htmlspecialchars($titre),
        htmlspecialchars($artiste),
        htmlspecialchars($image),
        htmlspecialchars($description)
    ]);

    header('Location: index.php');
    exit;