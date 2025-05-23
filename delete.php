<?php
session_start();

// Redirection si utilisateur non connecté
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
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

// Récupérer l'ID depuis l'URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Valider l'ID
if ($id <= 0) {
    die("Erreur : ID invalide.");
}

// Supprimer l'article correspondant
$filteredArticles = array_filter($articles, function($article) use ($id) {
    return $article['id'] !== $id;
});

// Réindexer le tableau pour éviter des clés manquantes
$filteredArticles = array_values($filteredArticles);

// Encoder et sauvegarder le JSON
$jsonData = json_encode($filteredArticles, JSON_PRETTY_PRINT);
if (file_put_contents($jsonFile, $jsonData) === false) {
    die("Erreur : impossible de sauvegarder le fichier JSON.");
}

// Rediriger vers le tableau de bord
header("Location: crud.php");
exit();
?>