<?php
/**
 * @var $_ROOT
 */
    $title = "Авторизация";
    $head = "
        <link href='assets/css/sign-in.css' rel='stylesheet'>
    ";

    $userData = $_ROOT["user"] ?? NULL;
    $validation = $_ROOT["validation"] ?? NULL;

    require_once TEMPLATES . "/header.php";
?>

<div class="form-signin py-5 d-flex align-content-center justify-content-center h-100">
    <form action="" method="POST" class="d-flex flex-column align-self-center w-100">
        <img class="mb-4 align-self-center" src="assets/images/bootstrap-logo.svg" alt="" width="72" height="57">
        <h1 class="h3 mb-3 fw-normal align-self-center"><?= $title; ?></h1>
        <div class="mb-2 text-left">
            <input type="email" placeholder="Электронная почта" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="<?= $userData["email"] ?? ""?>">
            <?php if (isset($validation['email'])) { ?>
                <div id="emailHelp" class="form-text text-start text-danger"><?= $validation["email"][0] ?></div>
            <?php } ?>
        </div>
        <div class="mb-2 text-left">
            <input type="password" placeholder="Пароль" class="form-control" name="password" id="password" aria-describedby="passwordHelp" value="<?= $userData["password"] ?? ""?>">
            <?php if (isset($validation['password'])) { ?>
                <div id="passwordHelp" class="form-text text-start text-danger"><?= $validation["password"][0] ?></div>
            <?php } ?>
        </div>
        <button type="submit" class="w-100 btn btn-primary">Войти</button>
    </form>
</div>

<?php require_once TEMPLATES . "/footer.php"; ?>