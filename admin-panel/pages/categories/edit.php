<?php
include "../../include/layout/header.php";

if (isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    $category = $db->prepare('SELECT * FROM categories WHERE id = :id');
    $category->execute(['id' => $categoryId]);
    $category = $category->fetch();
}

if (isset($_POST['editCategory'])) {
    if (!empty(trim($_POST['title']))) {
        $title = $_POST['title'];
        $categoryUpdate = $db->prepare("UPDATE categories SET title =:title WHERE id=:id");
        $categoryUpdate->execute(['title' => $title, 'id' => $categoryId]);

        header("Location:index.php");
        exit();
    }
}

?>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar Section -->
<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"></button>
        </div>

        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column pe-3">
                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'pages') ? '' : 'text-secondary' ?>" href="../../index.php">
                        <i class="bi bi-house-fill fs-4 text-secondary"></i>
                        <span class="fw-bold">داشبورد</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'posts') ? 'text-secondary' : '' ?>" href="../posts/index.php">
                        <i class="bi bi-file-earmark-image-fill fs-4 text-secondary"></i>
                        <span class="fw-bold">مقالات</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'categories') ? 'text-secondary' : '' ?>" href="index.php">
                        <i class="bi bi-folder-fill fs-4 text-secondary"></i>

                        <span class="fw-bold">دسته بندی</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link link-body-emphasis text-decoration-none d-flex align-items-center gap-2 <?= str_contains($path, 'comments') ? 'text-secondary' : '' ?>"" href="../comments/index.php">
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
    </div>
</div>

        <!-- Main Section -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="fs-3 fw-bold">ویرایش دسته بندی</h1>
            </div>

            <!-- Posts -->
            <div class="mt-4">
                <form method="post" class="row g-4">
                    <div class="col-12 col-sm-6 col-md-4">
                        <label class="form-label">عنوان دسته بندی</label>
                        <input type="text" name="title" class="form-control" value="<?= $category['title'] ?>" />
                    </div>

                    <div class="col-12">
                        <button name="editCategory" type="submit" class="btn btn-dark">
                            ویرایش
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