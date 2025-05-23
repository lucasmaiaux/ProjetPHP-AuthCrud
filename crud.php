<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$string = file_get_contents("./articles.json");
$articles = json_decode($string);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/dist/mdb5/standard/core.min.css">
    <link rel="stylesheet" id="roboto-subset.css-css"
        href="https://mdbcdn.b-cdn.net/wp-content/themes/mdbootstrap4/docs-app/css/mdb5/fonts/roboto-subset.css?ver=3.9.0-update.5"
        type="text/css" media="all">
</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <h2>Interface CRUD</h2>
        <p>Bienvenue <?php echo htmlspecialchars($_SESSION['username']); ?> dans l'interface CRUD</p>
        <p><a href="dashboard.php">Retour au tableau de bord</a></p>
        <p><a href="logout.php">Se déconnecter</a></p>
    </div>

    <div class="container">
        <section style="background-color: #eee;">
            <div class="container py-5">
                <?php foreach ($articles as $article): ?>
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-12 col-xl-10">
                            <div class="card shadow-0 border rounded-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                            <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                                <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/img%20(4).webp"
                                                    class="w-100" />
                                                <a href="#!">
                                                    <div class="hover-overlay">
                                                        <div class="mask"
                                                            style="background-color: rgba(253, 253, 253, 0.15);">
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <h5><?php echo $article->title; ?></h5>
                                            <div class="mt-1 mb-0 text-muted small">ID : <?php echo $article->id; ?></div>
                                            <p class="text-truncate mb-4 mb-md-0">Description :
                                                <?php echo $article->content; ?>
                                            </p>
                                        </div>
                                        <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                            <div class="d-flex flex-column mt-4">
                                                <a class="btn btn-primary btn-sm" href="edit.php?id=<?php echo $article->id; ?>" role="button">Modifier</a>
                                                <a class="btn btn-danger btn-sm mt-2" href="delete.php?id=<?php echo $article->id; ?>" role="button">Supprimer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </section>


    </div>

</body>

</html>