<?php
/**
 * @var $_ROOT
 */
    $posts = $_ROOT["posts"] ?? [];

    $message = $_SESSION["_message"] ?? NULL;

    require_once TEMPLATES . "/header.php";
?>

<div class="container mt-5 mb-5">
    <div class="d-flex justify-content-end gap-2 mb-3">
        <div class="w-auto">
            <a href="/posts/create" class="d-flex align-items-center gap-2 btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-postcard-fill" viewBox="0 0 16 16">
                    <path d="M11 8h2V6h-2v2Z"/>
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm8.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7ZM2 5.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5ZM2.5 7a.5.5 0 0 0 0 1H6a.5.5 0 0 0 0-1H2.5ZM2 9.5a.5.5 0 0 0 .5.5H6a.5.5 0 0 0 0-1H2.5a.5.5 0 0 0-.5.5Zm8-4v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5Z"/>
                </svg>
                Создать пост
            </a>
        </div>
        <div class="w-auto">
            <a href="/users" class="d-flex align-items-center gap-2 btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                </svg>
                Список пользователей
            </a>
        </div>
    </div>
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
                            <div class="d-flex gap-2 justify-content-end flex-wrap">
                                <div class="col-auto p-0">
                                    <a href="/posts/update?id=<?= $post["id"]; ?>" type="button" class="btn btn-secondary btn-sm">Редактировать</a>
                                </div>
                                <div class="col-auto p-0">
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


<?php require_once TEMPLATES . "/footer.php"; ?>
