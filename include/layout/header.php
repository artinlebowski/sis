<?php
include "./include/config.php";
include "./include/db.php";

$query = "SELECT * FROM categories";
$categories = $db->query($query);
// $posts = $db->query("SELECT * FROM posts ORDER BY id DESC");




// echo "<pre>";
// print_r($categories->fetchAll());


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gold || website</title>

        <!-- Google fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com/">
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600&amp;display=swap" rel="stylesheet">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="css/vendors.css">
  <link rel="stylesheet" href="css/main.css">


    <link rel="stylesheet" href="./maincss/main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>

    <!-- Header -->
    <header id="home">
            <!-- navbar -->
            <nav class="navbar">
                <div class="navbar-center">
                    <div class="nav-header">
                        <h3>goldirom</h3>
                        <button class="nav-toggle" id="nav-toggle" type="button">
                            <i class="bi bi-list-nested"></i>
                        </button>
                    </div>
    
                <ul class="nav-links" id="nav-links">
                        <li>
                        <a class="nav-link" href="./index.html">صفحه اصلی</a>
                        </li>
                        <button class="nav-link" id="nav-button">محصولات</button>
                        <div class="nav-div" id="nav-div">
                        <button class="nav-link" href="./index.html">انگشتر</button>
                        <button class="nav-link" href="./index.html">گردنبند</button>
                        <button class="nav-link" href="./index.html">دستبند</button>
                        <button class="nav-link" href="./index.html">سکه</button>
                        <button class="nav-link" href="./index.html">دستبند</button>
                        <button class="nav-link" href="./index.html">انگشتر</button>


                        </div>
                </ul>
  <!-- <ul class="dropdown-menu" id="navbar-submenu">
    <li><a class="product-btn-link" href="#">انگشتر</a></li>
    <li><a class="product-btn-link" href="#">گردنبند</a></li>
    <li><a class="product-btn-link" href="#">دستبند</a></li>
  </ul> -->
<!-- </li> -->


                </ul>
    
                    <ul class="nav-icons">
                        <li>
                            <a class="nav-icon" href="#">
                                <i class="bi bi-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a class="nav-icon" href="#">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        </li>
                        <li>
                            <a class="nav-icon" href="#">
                                <i class="bi bi-instagram"></i>
                            </a>
                        </li>
                    </ul> 
                </div>
            </nav>
            <br><br>
        <!-- end of navbar -->

        <!-- navbar-items -->
         <div class="nav-items">
            <?php foreach($categories as $category): ?>
                <a href="product1.php?category=<?= $category["id"] ?>"><?= $category["title"] ?></a>
                <?php endforeach ?>
         </div>