<?php
$catalog = selectCategory();
?>

<ul class="catalog">
    <?php foreach ($catalog as $item) : ?>
        <li class="catalog__item">
            <a class="catalog__text" href="./products.php?cat_id=<?= $item['section_id'] ?>"><?= $item['header'] ?>
                <span class="catalog__text-low">Колчиество товаров: <?= $item['count'] ?></span></a>
        </li>
    <? endforeach; ?>
</ul>