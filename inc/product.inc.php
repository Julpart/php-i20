<?php
$productCategories =  selectProductCat($id);
$productImages =  selectProductImg($id);
foreach ($productImages as $item) {
    if ($item['image_id'] == $arr['mainimg_id']) {
        $mainImg = $item['url'];
        $mainAlt = $item['alt'];
    }
}
?>
<div class="container-product">
    <div class="slider">
        <ul class="slider__list">
            <?php foreach ($productImages as $item) : ?>
                <li class="slider__list-item">
                    <img src="./IMG<?= $item['url'] ?>.jpg" width=100 height=130 alt="<?= $item['alt'] ?>">
                </li>
            <? endforeach; ?>
        </ul>
        <button class="slider__button"><img src="./IMG/icons/arrow down.png" alt=""></button>
    </div>
    <div class="card-photo">
        <img src="./IMG<?= $mainImg ?>.jpg" alt="<?= $mainAlt ?>" id="elem" width="340" height="492">
    </div>
    <div class="card-container">
        <div class="card">
            <h2 class="card__name"><?= $arr['header'] ?></h2>
            <nav class="card__links">
                <?php foreach ($productCategories as $item) : ?>
                    <a href="products.php?cat_id=<?= $item['section_id'] ?>" class="card__links-item"><?= $item['header'] ?></a>
                <? endforeach; ?>
            </nav>
            <div class="card__costs">
                <div class="card__costs-old"><?= $arr['price'] ?></div>
                <div class="card__costs-new"><?= $arr['discountprice'] ?> &#8381;</div>
                <div class="card__costs-promo"><?= $arr['promoprice'] ?> &#8381; <span class="card__costs-promo-text">- с
                        промокодом</span></div>
            </div>
            <div class="card__info">
                <ul>
                    <li><img src="./img/icons/tick.png" alt="1" class="card__info-icon" width="17x"> В наличии в
                        магазине <a href="#" class="card__info-link">Lamoda</a>
                    </li>
                    <li><img src="./img/icons/truck.png" alt="2" class="card__info-icon"> Бесплатная доставка
                    </li>
                </ul>
            </div>
        </div>
        <div class="card-counter">
            <button class="counter__button" onclick="counterDecrease()">-</button>
            <div class="counter__field">
                <h3 class="counter__field-text">1</h3>
            </div>
            <button class="counter__button" onclick="counterIncrease()">+</button>
        </div>
        <div class="card-buttons">
            <button class="shop-button" onclick="buy()">купить</button>
            <button class="like-button">в избранное</button>
        </div>
        <div class="card-description">
            <p><?= $arr['description'] ?></p>
        </div>
        <div class="socials">
            <span class="social-text">поделиться: </span>


            <a href="#">
                <img src="./IMG/icons/vk.jpg" alt="" class="icon" width="30">
            </a>
            <a href="#">
                <img src="./IMG/icons/google.jpg" alt="" class="icon" width="30">

            </a>
            <a href="#">
                <img src="./IMG/icons/facebook.jpg" alt="" class="icon" width="30">

            </a>
            <a href="#">
                <img src="./IMG/icons/twitter.jpg" alt="" class="icon" width="30">

            </a>
            <a href="#" class="comments">

                <div class="comments-text">12311</div>

            </a>





        </div>
    </div>



</div>