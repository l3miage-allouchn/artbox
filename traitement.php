<?php
    require 'header.php';
    require 'bdd.php'; 

    $titre = trim($_POST['titre'] ?? '');
    $artiste = trim($_POST['artiste'] ?? '');
    $image = trim($_POST['image'] ?? '');
    $description = trim($_POST['description'] ?? '');

    $erreurs = [];

    if ($titre === '') {
        $erreurs[] = 'Le titre est obligatoire.';
    }

    if ($artiste === '') {
        $erreurs[] = 'L\'artiste est obligatoire.';
    }

    if (strlen($description) < 3) {
        $erreurs[] = 'La description doit faire au moins 3 caractères.';
    }

    if (strpos($image, 'https://') !== 0) {
        $erreurs[] = 'Le lien de l\'image doit commencer par https://.';
    }

    if (!empty($erreurs)) {
        echo '<ul class="erreurs">';
        foreach ($erreurs as $erreur) {
            echo '<li>' . htmlspecialchars($erreur) . '</li>';
        }
        echo '</ul>';
        require 'footer.php';
        exit;
    }
    $pdo = connexion();
    $stmt = $pdo-> prepare('INSERT INTO oeuvres (titre, artiste, image, description) VALUES (?, ?, ?, ?)');
    $stmt->execute([
        htmlspecialchars($titre),
        htmlspecialchars($artiste),
        htmlspecialchars($image),
        htmlspecialchars($description)
    ]);

    header('Location: index.php');
    exit;
?>

<?php require 'footer.php'; ?>
