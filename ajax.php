<?php
include 'config.php';
include 'db.php';
$limit = 12;
$page = (int)$_GET['page'];
$page = (empty($page)) ? 1 : $page;
$start = ($page != 1) ? $page * $limit - $limit : 0;
$id = (int)$_GET['cat_id'];
$items = selectProductsOfCategory($id, false, $start, $limit);

foreach ($items as $item) {
?>
    <li class="category-block__item">
        <a href="/index.php?id=<?php echo $item['product_id'];
                                    if ($id != $item['mainSection_id']) echo "&main_id=$id" ?>">
            <div class="category-block__item-main">
                <img class="category-block_item-img" src="IMG/<?= $item['url'] ?>.jpg" alt="<?= $item['alt'] ?>">
            </div>
        </a>
        <div class="category-block__item-description">
            <a href="/index.php?id=<?php echo $item['product_id'];
                                        if ($id != $item['mainSection_id']) echo "&main_id=$id" ?>">
                <h3><?= $item['name'] ?></h3>
            </a>
            <a href="/index.php?cat_id=<?= $item['mainSection_id'] ?>"><?= $item['category'] ?></a>
        </div>
    </li>
<?php
}
