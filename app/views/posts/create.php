<?php
/**
 * @var $_ROOT
 */

    $title = "Новый пост";

    $post = $_ROOT["post"] ?? NULL;
    $error = $_ROOT["error"] ?? NULL;
    $success = $_ROOT["success"] ?? NULL;
    $validation = $_ROOT["validation"] ?? NULL;

    require_once TEMPLATES . "/header.php";
?>

<div class="container mt-5">
    <div class="row h-100">
        <?php if ($error || $success) { ?>
            <div class="col-lg-12">
                <?php if ($error) {?>
                    <div class=" alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $error; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
                <?php if ($success) {?>
                    <div class=" alert alert-success alert-dismissible fade show" role="alert">
                        <?= $success; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>

        <div class="col-lg-8">
            <h1 class="fw-bolder mb-3">Новый пост</h1>
            <form action="/posts" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Заголовок</label>
                    <input type="text" class="form-control" id="title" name="title" value="<?= $post['title'] ?? ''; ?>" aria-describedby="titleHelp">
                    <?php if (isset($_ROOT['validation']['title'])) { ?>
                        <div id="titleHelp" class="form-text text-start text-danger"><?= $_ROOT["validation"]["title"][0] ?? "" ?></div>
                    <?php } ?>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Описание</label>
                    <textarea class="form-control" id="description" rows="3" name="description" aria-describedby="descriptionHelp"><?= htmlspecialchars($post['description'] ?? ""); ?></textarea>
                    <?php if (isset($_ROOT['validation']['description'])) { ?>
                        <div id="descriptionHelp" class="form-text text-start text-danger"><?= $_ROOT["validation"]["description"][0] ?? ""?></div>
                    <?php } ?>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Создать пост</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once TEMPLATES . "/footer.php"; ?>