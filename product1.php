<?php
include "./include/layout/header.php";

if (isset($_GET['category'])) {
    $categoryId = $_GET['category'];
    $posts = $db->prepare("SELECT * FROM posts WHERE category_id = :id ORDER BY id DESC");
    $posts->execute(['id' => $categoryId]);
} else {
    $posts = $db->query("SELECT * FROM posts ORDER BY id DESC");
}

?>


       <!-- Articles Section -->
        <section class="section" id="articles">
            <div class="section-title">
                <h2>محصولات</h2>
            </div>


            <div class="section-center articles-center">
                <?php foreach ($posts as $post) : ?>
                    <?php if ($posts->rowCount() > 0) : ?>
                            <?php
                            $categoryId = $post['category_id'];
                            $postCategory = $db->query("SELECT * FROM categories WHERE id = $categoryId")->fetch();
                            ?>
                <article class="article-card">
                    <div class="article-img-container">
                        <img
                            class="article-img"
                            src="./uploads/posts/<?= $post['image'] ?>"
                            alt="article-img"
                        />
                        <p class="article-category"><?= $categoryId ?></p>
                    </div>
                    <div class="article-info">
                        <div class="article-title">
                            <h4><?= $post['title'] ?></h4>
                        </div>
                        <p>
                          <?= substr($post['body'], 0, 100)?>
                        </p>
                        <div class="article-footer">
                            <p>
                                <span>
                                    <i class="bi bi-pencil-square"></i>
                                    گلد سنه 
                                </span>
                            </p>
                            <p><?= $post["author"] ?></p>
                            <a href="#">نمایش</a>
                        </div>
                    </div>
                </article>
                <?php endif ?>
                <?php endforeach ?>
                 



           
            </div>

            <div class="article-btn">
                <a href="#" class="btn">مشاهده تمام محصولات</a>
            </div>
        </section>

        <div class="arrow-icon">
            <a href="#" class="arrow-right"><i class="bi bi-arrow-right"></i></a>
            <a href="#" class="arrow-left"><i class="bi bi-arrow-left"></i></a>
        </div>
        <!-- End Articles Section -->
<?php
     include "./include/layout/footer.php";
?>

