<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/materialize.css">
    <title>Document</title>
</head>
<nav>
    <div id="branding" class="container">
        <ul>
            <li><a href="index.php">Todolist</a></li>
            <?php if (isset($_SESSION['user'])):?>
                <li><a href="index.php?r=auth&a=getLogout">Déconnexion</a></li>
            <?php endif;?>
        </ul>
    </div>
</nav>
<body>
<?php include $data['view']; ?>
</body>
</html>
