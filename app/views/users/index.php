<?php
/**
 * @var $_ROOT
 */
$users = $_ROOT["users"] ?? [];

$message = $_SESSION["_message"] ?? NULL;

require_once TEMPLATES . "/header.php";
?>

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-end gap-2 mb-3">
        <div class="col-auto w-auto">
            <a href="/sign-up" class="d-flex align-items-center gap-2 btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-add" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0m-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                    <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                </svg>
                Создать пользователя
            </a>
        </div>
        <div class="col-auto w-auto p-0">
            <a href="/admin" class="d-flex align-items-center gap-2 btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-postcard-fill" viewBox="0 0 16 16">
                    <path d="M11 8h2V6h-2v2Z"/>
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm8.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7ZM2 5.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5ZM2.5 7a.5.5 0 0 0 0 1H6a.5.5 0 0 0 0-1H2.5ZM2 9.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5Zm8-4v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5Z"/>
                </svg>
                Список постов
            </a>
        </div>
    </div>
    <?php if (!empty($users)) { ?>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) { ?>
                    <tr>
                        <th scope="row" valign="middle"><?= $user["id"]; ?></th>
                        <td valign="middle"><?= $user["name"]; ?></td>
                        <td valign="middle"><?= $user["email"]; ?></td>
                        <td align="right" valign="middle">
                            <?php if ($user["email"] !== $_SESSION["user"]["email"]) { ?>
                                <div class="d-flex gap-2 justify-content-end">
                                    <div class="col-auto p-0">
                                        <form action="/users" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="<?= $user["id"]; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <h3 class="text-center">Список пользователей пуст</h3>
    <?php } ?>
</div>


<?php require_once TEMPLATES . "/footer.php"; ?>
