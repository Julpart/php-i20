<?php
$category = selectProductsOfCategory($id);
?>
<p class="category__description-text"><?= $description ?></p>
<div class="container">
    <ul class="category-block">
        <?php foreach ($category as $item) : ?>
            <li class="category-block__item">
                <a href="/products.php?id=<?php echo $item['product_id'];
                                            if ($id != $item['mainSection_id']) echo "&main_id=$id" ?>">
                    <div class="category-block__item-main">
                        <img class="category-block_item-img" src="IMG/<?= $item['url'] ?>.jpg" alt="<?= $item['alt'] ?>">
                    </div>
                </a>
                <div class="category-block__item-description">
                    <a href="/products.php?id=<?php echo $item['product_id'];
                                                if ($id != $item['mainSection_id']) echo "&main_id=$id" ?>">
                        <h3><?= $item['name'] ?></h3>
                    </a>
                    <a href="/products.php?cat_id=<?= $item['mainSection_id'] ?>"><?= $item['category'] ?></a>
                </div>
            </li>
        <? endforeach; ?>
    </ul>
</div>