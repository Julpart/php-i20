<?php
$category = selectProductsOfCategory($id);

$total = (int)selectCountOfCategory($id);
$amt = ceil($total / 12);
?>
<p class="category__description-text"><?= $description ?></p>
<div class="container" id="showmore-list">
    <ul class="category-block">
        <?php if (isset($category)) : ?>
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
        <?php endif ?>
    </ul>
</div>
<?php if ($amt > 1) : ?>
    <div class="category__button-show">
        <a data-page="1" cat_id="<?= $id ?>" data-max="<?php echo $amt; ?>" id="showmore-button" href="#">Показать еще</a>
    </div>
<?php endif ?>
<script>
    $(function() {
        $('#showmore-button').click(function() {
            var $target = $(this);
            var page = $target.attr('data-page');
            page++;
            id = $target.attr('cat_id');

            $.ajax({
                url: '/ajax.php?page=' + page + '&cat_id=' + id,
                dataType: 'html',
                success: function(data) {
                    $('#showmore-list .category-block').append(data);
                }
            });

            $target.attr('data-page', page);
            if (page == $target.attr('data-max')) {
                $target.hide();
            }

            return false;
        });
    });
</script>