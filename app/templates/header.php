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
                    <strong>Мой блог</strong>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav ms-auto align-items-md-center gap-2 mb-2 mb-md-0">
                        <?php if (\Core\Classes\Helper::checkAuth()) { ?>
                            <li class="nav-item">
                                <a class="nav-link<?= isset($_GET['admin']) ? ' active' : ''; ?>" href="/admin">Админка</a>
                            </li>
                            <li class="nav-item d-flex align-items-center">
                                <a href="/logout" class="d-flex align-items-center gap-2 btn btn-danger btn-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0z"/>
                                        <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                                    </svg>
                                    Выход
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="bg-light">
        <?php if (isset($_SESSION["_message"])) { ?>
            <div class="container mt-5 mb-5">
                <?php
                    $message = $_SESSION["_message"]["message"] ?? "";
                    $messageType = $_SESSION["_message"]["type"] ?? "";

                    \App\Components\AlertMessage::render($message, $messageType);
                ?>
            </div>
        <?php } ?>