<?php

function redirectToUrl(string $url): never
{
    header("Location: {$url}");
    exit();
}

$postData = $_POST;
//$sessionData = $_SESSION['user_name'] ?? [];
$users = [
    [
        'user_name' => 'alice',
        'user_password' => '1234',
    ]
];

// Validation du formulaire
if (isset($postData['user_name']) && isset($postData['user_password'])) {
    foreach ($users as $user) {
        if (
            $postData['user_name'] === $user['user_name'] &&
            $postData['user_password'] === $user['user_password']
        ) {
            $loggedUser = [
                'user_name' => $postData['user_name'],
            ];
            $_SESSION['user_name'] = $loggedUser['user_name'];
        }
    }

    if (!isset($loggedUser)) {
        $errorMessage = sprintf(
            'Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
            $postData['user_name'],
            strip_tags($postData['user_password'])
        );
    }
    else {
        redirectToUrl("dashboard.php");
    }
}
?>

<!-- Si utilisateur/trice est non identifié(e), on affiche le formulaire -->
<?php if (!isset($loggedUser)): ?>
    <form action="index.php" method="POST">

        <!-- si message d'erreur on l'affiche -->
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $errorMessage; ?>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <label for="user_name" class="form-label">Username</label>
            <input type="text" class="form-control" id="user_name" name="user_name">
        </div>

        <div class="mb-3">
            <label for="user_password" class="form-label">Password</label>
            <input type="password" class="form-control" id="user_password" name="user_password">
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

    <!-- Si utilisateur/trice bien connectée on affiche un message de succès -->
<?php else: ?>
    <div class="alert alert-success" role="alert">
        Bonjour <?php echo $loggedUser['user_name']; ?> et bienvenue sur le site !
    </div>
<?php endif; ?>