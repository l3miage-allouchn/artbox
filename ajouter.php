<?php require 'header.php'; ?>

<?php // isset() verifie si une variable existe et n'est pas null. ?>
<?php if (isset($_GET['erreur'])): ?>
    <?php if ($_GET['erreur'] === 'titre'): ?>
        <p class="erreur">Le titre est obligatoire.</p>
    <?php elseif ($_GET['erreur'] === 'artiste'): ?>
        <p class="erreur">L'artiste est obligatoire.</p>
    <?php elseif ($_GET['erreur'] === 'description'): ?>
        <p class="erreur">La description doit faire au moins 3 caractères.</p>
    <?php elseif ($_GET['erreur'] === 'image'): ?>
        <p class="erreur">Le lien de l'image doit commencer par https://.</p>
    <?php endif; ?>
<?php endif; ?>

<form action="traitement.php" method="POST">
    <div class="champ-formulaire">
        <label for="titre">Titre de l'œuvre</label>
        <input type="text" name="titre" id="titre">
    </div>
    <div class="champ-formulaire">
        <label for="artiste">Auteur de l'œuvre</label>
        <input type="text" name="artiste" id="artiste">
    </div>
    <div class="champ-formulaire">
        <label for="image">URL de l'image</label>
        <input type="url" name="image" id="image">
    </div>
    <div class="champ-formulaire">
        <label for="description">Description</label>
        <textarea name="description" id="description"></textarea>
    </div>

    <input type="submit" value="Valider" name="submit">
</form>

<?php require 'footer.php'; ?>