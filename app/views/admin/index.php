<?php
/**
 * @var $_ROOT
 */
    $posts = $_ROOT["posts"] ?? [];

    $message = $_SESSION["_message"] ?? NULL;

    require_once TEMPLATES . "/header.php";
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-end mb-3">
        <div class="col-auto w-auto">
            <a href="/posts/create" class="d-flex align-items-center gap-2 btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-postcard-fill" viewBox="0 0 16 16">
                    <path d="M11 8h2V6h-2v2Z"/>
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm8.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7ZM2 5.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5ZM2.5 7a.5.5 0 0 0 0 1H6a.5.5 0 0 0 0-1H2.5ZM2 9.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5Zm8-4v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5Z"/>
                </svg>
                Создать
            </a>
        </div>
    </div>
    <div class="row h-100">
        <?php if (!empty($posts)) { ?>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Название</th>
                    <th scope="col">Дата создания</th>
                    <th scope="col">Дата обновления</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach ($posts as $post) { ?>
                        <tr>
                            <th scope="row" valign="middle"><?= $post["id"]; ?></th>
                            <td valign="middle"><a href="posts/?id=<?= $post["id"]; ?>"><?= $post["title"]; ?></a></td>
                            <td valign="middle"><?= $post["created_at"]; ?></td>
                            <td valign="middle"><?= $post["updated_at"]; ?></td>
                            <td align="right" valign="middle">
                                <div class="row row-cols-2 justify-content-end">
                                    <div class="col-auto">
                                        <a href="/posts/update?id=<?= $post["id"]; ?>" type="button" class="btn btn-secondary btn-sm">Редактировать</a>
                                    </div>
                                    <div class="col-auto">
                                        <form action="/posts" method="POST">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="id" value="<?= $post["id"]; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <h3 class="text-center">Список постов пуст</h3>
        <?php } ?>
    </div>
</div>


<?php
    if (isset($_SESSION["_message"])) {
        unset($_SESSION["_message"]);
    }

    require_once TEMPLATES . "/footer.php";
?>
