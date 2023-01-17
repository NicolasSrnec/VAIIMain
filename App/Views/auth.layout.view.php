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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
            integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="public/css/styl.css">
    <script src="public/js/script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<nav class="navbar sticky-top navbar-expand-sm navbar-dark" style="background-color: black;">

    <a class="navbar-brand" href="?c=home" style="padding-bottom: 0; padding-top: 0">
        <img src="public/images/navbar_logo.png" title="<?= \App\Config\Configuration::APP_NAME ?>" >
    </a>

    <ul class="navbar-nav me-auto">
        <li class="nav-item">
            <a class="nav-link" href="?c=home">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?c=home&a=contact">Contact</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="?c=food&type=burger">Order</a>
        </li>

    </ul>
    <?php if ($auth->isLogged()) { ?>
        <ul class="navbar-nav ms-auto">
            <button class="nav-link" id="cartButton" onclick="showCart('<?= $auth->getLoggedUserName() ?>')">Cart</button>
            <span class="navbar-text"  <b><?= $auth->getLoggedUserName() ?></b></span>
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


</nav>
<div class="container-fullwidth" id="cartScreen" >
    <div class="row justify-content-center no-gutters" style="background-color: white;"id="cartCloseButton">
        <span class="close"onclick="hideCart()">&times;</span>
    </div>
    <div class="row justify-content-center no-gutters" style="background-color: white;"id="cartContent">
    </div>
</div>
<div class="container-fluid mt-3">
    <div class="web-content">
        <?= $contentHTML ?>
    </div>
</div>
</body>
</html>
