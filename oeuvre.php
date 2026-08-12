<?php
    require 'header.php';
    require 'bdd.php';

    // Si l'URL ne contient pas d'id, on redirige sur la page d'accueil
    if(empty($_GET['id'])) {
        header('Location: index.php');
        exit; // sans exit le script continue quand meme et plante plus bas
    }

    $pdo = connexion();
    // requete preparee car l'id vient de l'utilisateur (l'url), jamais de sql brut avec une valeur externe
    $stmt = $pdo->prepare('SELECT * FROM oeuvres WHERE id = ?');
    $stmt->execute([intval($_GET['id'])]);
    $oeuvre = $stmt->fetch();

    // Si aucune oeuvre trouvée, on redirige vers la page d'accueil
    if($oeuvre === false) {
        header('Location: index.php');
        exit;
    }
?>

<article id="detail-oeuvre">
    <div id="img-oeuvre">
        <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
    </div>
    <div id="contenu-oeuvre">
        <h1><?= $oeuvre['titre'] ?></h1>
        <p class="description"><?= $oeuvre['artiste'] ?></p>
        <p class="description-complete">
             <?= $oeuvre['description'] ?>
        </p>
    </div>
</article>

<?php require 'footer.php'; ?>
