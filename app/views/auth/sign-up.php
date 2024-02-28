<?php
    $title = "Регистрация";
    $head = "
        <link href='assets/css/sign-in.css' rel='stylesheet'>
    ";

    require_once TEMPLATES . "/header.php";
?>
    <div class="form-signin py-5 d-flex align-content-center justify-content-center h-100">
        <form class="d-flex flex-column align-self-center">
            <img class="mb-4 align-self-center" src="assets/images/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal text-center">Регистрация пользователя</h1>
            <div class="mb-2 text-left">
                <input type="text" placeholder="Имя пользователя" class="form-control" id="name" aria-describedby="nameHelp">
                <div id="nameHelp" class="form-text text-start text-danger">Поле не должно быть пустым!</div>
            </div>
            <div class="mb-2 text-left">
                <input type="email" placeholder="Электронная почта" class="form-control" id="email" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text text-start text-danger">Электронный адрес введен неверно!</div>
            </div>
            <div class="mb-2 text-left">
                <input type="password" placeholder="Пароль" class="form-control" id="password" aria-describedby="passwordHelp">
                <div id="passwordHelp" class="form-text text-start text-danger">Пароль должен состоять из 8-12 символов!</div>
            </div>
            <button type="submit" class="w-100 btn btn-primary">Зарегистрировать</button>
        </form>
    </div>
<?php require_once TEMPLATES . "/footer.php"; ?>