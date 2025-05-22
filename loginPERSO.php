<?php

$logs = [
    'user_name' => '',
    'user_password' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($logs as $key => $value) {
        $logs[$key] = htmlspecialchars(trim($_POST[$key] ?? ''));
    }

    echo "username : ", $logs['user_name'];
    echo " / password : ", $logs['user_password'];

    if (($logs['user_name'] == 'alice') && ($logs['user_password'] == '1234')) {
        echo "Bienvenue alice";
    }
    else {
        echo "T'es qui?";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>

    <form action="login.php" method="post">
        <div>
            <label for="user_name">Username :</label>
            <input type="text" id="user_name" name="user_name" required>
        </div>

        <div>
            <label for="user_password">Password :</label>
            <input type="password" id="user_password" name="user_password" required>
        </div>

        <div>
            <button type="submit">Envoyer</button>
            <button type="reset">Réinitialiser</button>
        </div>
    </form>

</body>

</html>
