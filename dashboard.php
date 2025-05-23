<?php
session_start();

// Redirection si utilisateur non connecté
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/dist/mdb5/standard/core.min.css">
    <link rel="stylesheet" id="roboto-subset.css-css" href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5" type="text/css" media="all">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <h1>Dashboard</h1>

        <h2>Bienvenue <?php echo htmlspecialchars($_SESSION['username']); ?></h2>

        <!-- Crud.php -->
        <?php //require_once(__DIR__ . '/crud.php'); ?>

        <p><a href="crud.php">Accéder au CRUD</a></p>
        <p><a href="logout.php">Se déconnecter</a></p>

        <!-- Infos user -->
        <div class="container">
            SID : <?php echo session_id() ?><br>
            <?php if (isset($_SESSION['username'])): ?>
                Username (session) : <?php echo $_SESSION['username'] ?>
                <a href="logout.php">Logout</a>
            <?php endif; ?>
        </div>

    </div>

</body>

</html>