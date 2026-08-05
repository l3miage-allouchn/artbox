
---

# Journal du projet ArtBox

## Le contexte
Site de départ fourni par OpenClassrooms (galerie The ArtBox), avec 15 œuvres codées en dur dans `oeuvres.php`. But : Fatima (com) doit pouvoir ajouter des œuvres sans toucher au code → il faut une base de données + un formulaire qui marche.

## 1. Git + GitHub
git init 
git status
git config --global user.name "l3miage-allouchn"
git config --global user.email "158454979+l3miage-allouchn@users.noreply.github.com"
git add .
git status
git commit -m "Code initial du projet The ArtBox"

j'ai créer le repo sur github 

git remote add origin https://github.com/l3miage-allouchn/artbox.git

git branch -M main
git push -u origin main

mv "/c/Users/allouchn/OpenClassroom/artbox" "/c/xampp/htdocs/artbox"

## 2. Installation XAMPP
- besoin d'Apache + PHP + MySQL pour faire tourner le site en local (mon PC n'est pas un serveur par défaut)
- installé XAMPP, démarré Apache + MySQL
- vérifié que `localhost/artbox` répond bien

## 3. Base de données
- créé la base `artbox` puis la table `oeuvres` dans phpMyAdmin
- colonnes basées sur ce qu'il y avait déjà dans `oeuvres.php` : id, titre, artiste, image, description
- `id` en INT auto-increment + clé primaire, `titre`/`artiste`/`image` en VARCHAR(255), `description` en TEXT (certaines descriptions dépassent 255 caractères)
- `image` = juste le lien vers la photo, pas l'image elle-même, comme demandé
- galères en cours de route : espace en trop dans le nom de colonne, taille manquante sur les VARCHAR → corrigé en relisant le SQL généré avant de valider
- inséré les 15 œuvres d'un coup avec une requête INSERT plutôt qu'à la main

## 4. bdd.php
- un seul fichier avec la fonction `connexion()` qui ouvre la connexion PDO vers `artbox`
- pour ne pas répéter le code de connexion dans chaque page

## 5. index.php
- avant : lisait le tableau `$oeuvres` de `oeuvres.php`
- maintenant : `SELECT * FROM oeuvres` via PDO, résultat stocké dans `$oeuvres`
- le reste du code (affichage) n'a pas bougé, `fetchAll()` renvoie les mêmes clés que le tableau d'avant
- testé : les 15 œuvres s'affichent toujours pareil

## 6. oeuvre.php
- avant : cherchait l'œuvre dans le tableau avec un `foreach`
- maintenant : requête préparée `SELECT * FROM oeuvres WHERE id = ?` (pas d'injection SQL possible puisque l'id vient de l'URL)
- géré les 2 cas d'erreur demandés : pas d'id dans l'URL, ou id qui n'existe pas → redirection vers l'accueil
- testé avec un id valide, sans id, et avec un id bidon (999) → tout redirige bien sans erreur

## 7. traitement.php - validation
- le formulaire existait déjà mais pointait vers un fichier qui n'existait pas
- règles demandées par l'exercice : titre rempli, artiste rempli, description ≥ 3 caractères, image en https://
- si un champ est invalide → message d'erreur affiché, script arrêté
- `htmlspecialchars()` utilisé pour l'affichage, par sécurité
- testé avec des champs vides (les erreurs s'affichent) et avec des données correctes (rien ne s'affiche)

## 8. traitement.php - insertion
- une fois les données valides, `INSERT INTO oeuvres` avec une requête préparée
- chaque valeur passée dans `htmlspecialchars()` avant d'aller en base → si quelqu'un tape du code genre `<script>`, ça devient du texte inoffensif au lieu de s'exécuter (protection XSS)
- redirection vers l'accueil après l'insertion
- testé en soumettant le formulaire : la nouvelle œuvre apparaît bien sur la page d'accueil

## Ce qu'il reste à faire
- remplir la fiche d'auto-évaluation OpenClassrooms

