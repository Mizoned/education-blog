<?php
    $title = "Регистрация пользователя";
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
            <h1 class="h3 mb-3 fw-normal text-center"><?= $title; ?></h1>
            <div class="mb-2 text-left">
                <input type="text" placeholder="Имя пользователя" class="form-control" id="name" aria-describedby="nameHelp" name="name" value="<?= $userData["name"] ?? ""?>">
                <?php if (isset($validation['name'])) { ?>
                    <div id="nameHelp" class="form-text text-start text-danger"><?= $validation["name"][0] ?></div>
                <?php } ?>
            </div>
            <div class="mb-2 text-left">
                <input type="email" placeholder="Электронная почта" class="form-control" id="email" aria-describedby="emailHelp" name="email" value="<?= $userData["email"] ?? ""?>">
                <?php if (isset($validation['email'])) { ?>
                    <div id="emailHelp" class="form-text text-start text-danger"><?= $validation["email"][0] ?></div>
                <?php } ?>
            </div>
            <div class="mb-2 text-left">
                <input type="password" placeholder="Пароль" class="form-control" id="password" aria-describedby="passwordHelp" name="password" value="<?= $userData["password"] ?? ""?>">
                <?php if (isset($validation['password'])) { ?>
                    <div id="passwordHelp" class="form-text text-start text-danger"><?= $validation["password"][0] ?></div>
                <?php } ?>
            </div>
            <button type="submit" class="w-100 btn btn-primary">Зарегистрировать</button>
        </form>
    </div>
<?php require_once TEMPLATES . "/footer.php"; ?>