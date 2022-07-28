<?php
$header = "Категории товаров";
if (isset($_GET['cat_id'])) {
    $id = (int)$_GET['cat_id'];
    $arr = selectById($id, "section");
    if ($arr) {
        $header = $arr['header'];
        $description = $arr['description'];
        $reference = "<a href='products.php' class=''><button class='header__button-ref'>Назад</button></a>";
        $page = "category";
    } else {
        header("Location: /notfound.php");
        die();
    }
} elseif (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $arr = selectById($id, "product");
    if ($arr) {
        $header = $arr['header'];
        $main_id = $arr['mainSection_id'];
        $description = $arr['description'];
        $page = "product";
        $reference = "<a href='products.php?cat_id=$main_id'><button class='header__button-ref'>Назад</button></a>";
        if (isset($_GET['main_id'])) {
            $cat_id = (int)$_GET['main_id'];
            $secCategory = selectById($cat_id, "section")['header'];
            if (!is_null($secCategory)) {
                $mainCategory = selectById($main_id, "section")['header'];
                $reference = "<span class='header__text-ref'><a href='products.php?cat_id=$main_id'>$mainCategory</a>&#8592<a href='products.php?cat_id=$cat_id' >$secCategory</a></span>";
            } else {
                header("Location: /notfound.php");
                die();
            }
        }
    } else {
        header("Location: /notfound.php");
        die();
    }
} else {
    $page = "catalog";
}
