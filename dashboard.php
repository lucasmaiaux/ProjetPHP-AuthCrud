<?php
session_start();

// Redirection si utilisateur non connecté
if (!isset($_SESSION['user_name'])) {
    header('Location: index.php');
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
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">

        <h1>Dashboard</h1>

        <div>
            Bienvenue <?php echo $_SESSION['user_name'] ?>, un lien vers crud.php et logout.php
        </div>

        <div class="container">
            SID : <?php echo session_id() ?><br>
            <?php if (isset($_SESSION['user_name'])): ?>
                Username (session) : <?php echo $_SESSION['user_name'] ?>
                <a href="logout.php">Logout</a>
            <?php endif; ?>
        </div>

    </div>

</body>

</html>