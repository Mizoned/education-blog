<?php
/**
 * @var $_ROOT
 */
    $post = $_ROOT['post'];
    $title = $post['title'];

    require_once TEMPLATES . "/header.php";
?>

<?php if (!empty($post)) { ?>
    <div class="container mt-5">
        <div class="row h-100">
            <div class="col-lg-8">
                <article class="d-flex flex-column">
                    <header class="mb-4">
                        <h1 class="fw-bolder mb-1"><?=$post['title']?></h1>
                        <div class="text-muted fst-italic mb-2">Опубликован <?=$post['created_at']?></div>
                        <div class="text-muted fst-italic mb-2">Изменен <?=$post['updated_at']?></div>
                    </header>

                    <?php if (!empty($post['img'])) { ?>
                        <figure class="mb-4">
                            <img class="img-fluid rounded" src="uploads/<?=$post['img']?>" alt="<?=$post['title']?>" />
                        </figure>
                    <?php } ?>

                    <section class="mb-5">
                        <p class="fs-5 mb-4"><?=$post['description']?></p>
                    </section>
                </article>
            </div>
        </div>
    </div>
<?php } else {
    require_once TEMPLATES . "/errors/404.php";
} ?>

<?php require_once TEMPLATES . "/footer.php"; ?>