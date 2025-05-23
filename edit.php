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

// Rechercher l'article correspondant
$article = null;
foreach ($articles as $item) {
    if ($item['id'] === $id) {
        $article = $item;
        break;
    }
}

// Vérifier si l'article existe
if (!$article) {
    die("Erreur : aucun article trouvé pour l'ID $id.");
}

/*
// Traitement du formulaire
$error = '';
//product_name
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($users[$username]) && $users[$username] === $password) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Identifiants incorrects";
    }
}
*/
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
        <h1>Edit</h1>
        <section style="background-color: #eee;">
            <div class="container py-5">
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
                                        <h5><?php echo $article['title']; ?></h5>
                                        <div class="mt-1 mb-0 text-muted small">ID : <?php echo $article['id']; ?>
                                        </div>
                                        <p class="text-truncate mb-4 mb-md-0">Description : <?php echo $article['content']; ?></p>
                                    </div>

                                    <form method="POST" action="update.php">
                                        <input type="hidden" name="id" value="<?php echo $article['id']; ?>">
                                        <div class="form-group">
                                            <label for="product_name">Nom</label>
                                            <input type="text" class="form-control" id="product_name" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" reqired>
                                        </div>
                                        <div class="form-group">
                                            <label for="product_description">Description</label>
                                            <textarea type="text" class="form-control" id="product_description" name="content" required><?php echo htmlspecialchars($article['content']); ?></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary mt-3">Modifier</button>
                                    </form>
                                    <div class="mt-2">
                                        <a href="crud.php">Retour à la liste</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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