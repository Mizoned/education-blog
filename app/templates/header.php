<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <base href="<?=BASE_PATH?>/">
    <link href="assets/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="icon" href="assets/images/favicon.ico">
    <?= $head ?? '' ?>
    <title><?= $title ?? "Блог"?></title>
</head>
<body class="main-layout">
    <header>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark">
            <div class="container">
                <a href="/" class="navbar-brand d-flex align-items-center gap-2">
                    <img src="assets/images/bootstrap-logo-white.svg" alt="" height="32">
                    <strong>Блог</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                        <?php if (\Core\Classes\Helper::checkAuth()) { ?>
                            <li class="nav-item">
                                <a class="nav-link<?= isset($_GET['admin']) ? ' active' : ''; ?>" href="/admin"><?= $_SESSION["user"]["name"] ?? $_SESSION["user"]["email"]; ?></a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link<?= isset($_GET['sign-in']) ? ' active' : ''; ?>" href="/sign-in">Вход</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link<?= isset($_GET['sign-up']) ? ' active' : ''; ?>" href="/sign-up">Регистрация</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="bg-light">
