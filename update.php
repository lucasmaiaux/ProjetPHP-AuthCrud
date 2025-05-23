<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Vérifier si la requête est de type POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Erreur : méthode non autorisée.");
}

// Récupérer les données du formulaire
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$title = isset($_POST['title']) ? trim($_POST['title']) : '';
$content = isset($_POST['content']) ? trim($_POST['content']) : '';

// Valider les données
if ($id <= 0 || empty($title) || empty($content)) {
    die("Erreur : données du formulaire invalides.");
}

// Chemin vers le fichier JSON
$jsonFile = 'articles.json';

// Vérifier si le fichier existe
if (!file_exists($jsonFile)) {
    die("Erreur : le fichier JSON n'existe pas.");
}

// Lire et décoder le fichier JSON
$jsonData = file_get_contents($jsonFile);
$articles = json_decode($jsonData, true);

// Vérifier si le JSON est valide
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Erreur : le fichier JSON est invalide.");
}

// Rechercher et mettre à jour l'article
$found = false;
foreach ($articles as &$article) {
    if ($article['id'] === $id) {
        $article['title'] = $title;
        $article['content'] = $content;
        $found = true;
        break;
    }
}

if (!$found) {
    die("Erreur : aucun article trouvé pour l'ID $id.");
}

// Encoder et sauvegarder le JSON
$jsonData = json_encode($articles, JSON_PRETTY_PRINT);
if (file_put_contents($jsonFile, $jsonData) === false) {
    die("Erreur : impossible de sauvegarder le fichier JSON.");
}

// Rediriger vers le tableau de bord
header("Location: crud.php");
exit();
?>