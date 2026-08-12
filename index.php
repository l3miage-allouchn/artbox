<?php
    require 'header.php';
    require 'bdd.php';

    // on recupere toutes les oeuvres direct depuis la bdd, plus besoin du tableau php en dur
    $pdo = connexion();
    $oeuvres = $pdo->query('SELECT * FROM oeuvres')->fetchAll();
?>
<div id="liste-oeuvres">
    <?php foreach($oeuvres as $oeuvre): ?>
        <article class="oeuvre">
            <a href="oeuvre.php?id=<?= $oeuvre['id'] ?>">
                <img src="<?= $oeuvre['image'] ?>" alt="<?= $oeuvre['titre'] ?>">
                <h2><?= $oeuvre['titre'] ?></h2>
                <p class="description"><?= $oeuvre['artiste'] ?></p>
            </a>
        </article>
    <?php endforeach; ?>
</div>
<?php require 'footer.php'; ?>
