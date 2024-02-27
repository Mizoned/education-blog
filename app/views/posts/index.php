<?php
/**
 * @var $_ROOT
 */
    require_once TEMPLATES . "/header.php";
?>
<section class="banner py-5 text-center bg-white">
    <div class="container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-bold">Мой блог</h1>
                <p class="fw-light fs-4 text-muted">Огромный текст баннера</p>
            </div>
        </div>
    </div>
    <img class="banner__img" src="assets/images/main-banner.jpg" alt="Мой блог">
</section>

<div class="py-5 bg-light">
    <div class="container">
        <?php
        use App\Components\PostCard;

        $posts = $_ROOT['posts'];
        ?>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($posts as $post) { ?>
                <div class="col">
                    <?php
                        $postCard = new PostCard($post);
                        $postCard->render();
                    ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php require_once TEMPLATES . "/footer.php"; ?>