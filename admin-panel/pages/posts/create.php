<?php
include "../../include/layout/header.php";

$categories = $db->query("SELECT * FROM categories");

$invalidInputTitle = '';
$invalidInputAuthor = '';
$invalidInputImage = '';
$invalidInputBody = '';

if (isset($_POST['addPost'])) {

    if (empty(trim($_POST['title']))) {
        $invalidInputTitle = 'فیلد عنوان مقاله الزامیست';
    }

    if (empty(trim($_POST['author']))) {
        $invalidInputAuthor = 'فیلد نویسنده مقاله الزامیست';
    }

    if (empty(trim($_FILES['image']['name']))) {
        $invalidInputImage = 'فیلد تصویر مقاله الزامیست';
    }

    if (empty(trim($_POST['body']))) {
        $invalidInputBody = 'فیلد متن مقاله الزامیست';
    }

    if (!empty(trim($_POST['title'])) && !empty(trim($_POST['author'])) && !empty(trim($_FILES['image']['name'])) && !empty(trim($_POST['body']))) {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $body = $_POST['body'];
        $categoryId = $_POST['categoryId'];

        $nameImage = time() . "_" . $_FILES['image']['name'];
        $tmpName = $_FILES['image']['tmp_name'];

        if (move_uploaded_file($tmpName, "../../../uploads/posts/$nameImage")) {
            $postInsert = $db->prepare("INSERT INTO posts (title, author,category_id, body, image) VALUES (:title, :author, :category_id, :body, :image)");
            $postInsert->execute(['title' => $title, 'author' => $author, 'category_id' => $categoryId, 'body' => $body, 'image' => $nameImage]);

            header("Location:index.php");
            exit();
        } else {
            echo "Upload Error";
        }
    }
}

?>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Section -->
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column pe-3">
                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'pages') ? '' : 'text-secondary' ?>" href="../../index.php">
                        <i class="bi bi-house-fill fs-4 text-secondary"></i>
                        <span class="fw-bold">داشبورد</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'posts') ? 'text-secondary' : '' ?>" href="index.php">
                        <i class="bi bi-file-earmark-image-fill fs-4 text-secondary"></i>
                        <span class="fw-bold">مقالات</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'categories') ? 'text-secondary' : '' ?>" href="../categories/index.php">
                        <i class="bi bi-folder-fill fs-4 text-secondary"></i>

                        <span class="fw-bold">دسته بندی</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'comments') ? 'text-secondary' : '' ?>"" href="..//comments/index.php">
                        <i class="bi bi-chat-left-text-fill fs-4 text-secondary"></i>

                        <span class="fw-bold">کامنت ها</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2" href="../auth/logout.php">
                        <i class="bi bi-box-arrow-right fs-4 text-secondary"></i>

                        <span class="fw-bold">خروج</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Main Section -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="fs-3 fw-bold">ایجاد مقاله</h1>
            </div>

            <!-- Create Post -->
            <div class="mt-4">
                <form method="post" class="row g-4" enctype="multipart/form-data">
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">عنوان مقاله</label>
                        <input type="text" name="title" class="form-control" />
                        <div class="form-text text-danger"><?= $invalidInputTitle ?></div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">نویسنده مقاله</label>
                        <input type="text" name="author" class="form-control" />
                        <div class="form-text text-danger"><?= $invalidInputAuthor ?></div>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">دسته بندی مقاله</label>
                        <select name="categoryId" class="form-select">
                            <?php if ($categories->rowCount() > 0) : ?>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                                <?php endforeach ?>
                            <?php endif ?>
                        </select>
                    </div>

                    <div class="col-12 col-sm-6 col-md-4">
                        <label for="formFile" class="form-label">تصویر مقاله</label>
                        <input class="form-control" name="image" type="file" />
                        <div class="form-text text-danger"><?= $invalidInputImage ?></div>
                    </div>

                    <div class="col-12">
                        <label for="formFile" class="form-label">متن مقاله</label>
                        <textarea class="form-control" name="body" rows="6"></textarea>
                        <div class="form-text text-danger"><?= $invalidInputBody ?></div>
                    </div>

                    <div class="col-12">
                        <button type="submit" name="addPost" class="btn btn-dark">
                            ایجاد
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</div>

<?php
include "../../include/layout/footer.php"
?>