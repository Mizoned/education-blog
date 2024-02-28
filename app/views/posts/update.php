<?php
/**
 * @var $_ROOT
 */

    $title = "Редактирование поста";

    $post = $_ROOT["post"] ?? NULL;
    $validation = $_ROOT["validation"] ?? NULL;

    require_once TEMPLATES . "/header.php";
?>

<div class="container mt-5 mb-5">
    <div class="row h-100">
        <div class="col-lg-8">
            <h1 class="fw-bolder mb-3">Редактирование поста</h1>
            <form action="/posts" method="POST">
                <input type="hidden" name="_method" value="UPDATE">
                <input type="hidden" name="id" value="<?= $post["id"]; ?>">
                <div class="mb-3">
                    <label for="title" class="form-label">Заголовок</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $post['title'] ?? ''; ?>" aria-describedby="titleHelp">
                    <?php if (isset($validation['title'])) { ?>
                        <div id="titleHelp" class="form-text text-start text-danger"><?= $_ROOT["validation"]["title"][0] ?? "" ?></div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" id="description" rows="3" name="description" aria-describedby="descriptionHelp"><?= htmlspecialchars($post['description'] ?? ""); ?></textarea>
                    <?php if (isset($validation['description'])) { ?>
                        <div id="descriptionHelp" class="form-text text-start text-danger"><?= $_ROOT["validation"]["description"][0] ?? ""?></div>
                    <?php } ?>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Изменить пост</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once TEMPLATES . "/footer.php"; ?>