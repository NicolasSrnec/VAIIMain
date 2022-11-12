<?php
/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <title><?= \App\Config\Configuration::APP_NAME ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
            crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="public/css/styl.css">
    <script src="public/js/script.js"></script>
</head>
<body>
<nav class="navbar sticky-top navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="?c=home">
            <img src="public/images/navbar_logo.png" title="<?= \App\Config\Configuration::APP_NAME ?>"
                 title="<?= \App\Config\Configuration::APP_NAME ?>">
        </a>

        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="nav-link" href="?c=home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?c=home&a=contact">Contact</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="?c=food">Order</a>
            </li>

        </ul>
        <?php if ($auth->isLogged()) { ?>
            <ul class="navbar-nav ms-auto">
            <span class="navbar-text" <b><?= $auth->getLoggedUserName() ?></b></span>
                <li class="nav-item">
                    <a class="nav-link" href="?c=auth&a=logout">Logout</a>
                </li>
            </ul>
        <?php } else { ?>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= \App\Config\Configuration::LOGIN_URL ?>">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="?c=user&a=create">Register</a>
                </li>
        <?php } ?>

    </div>
</nav>
<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>
</body>
</html>
