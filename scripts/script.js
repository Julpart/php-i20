function buy() {
    let count = $('.counter__field-text').html();
    let out;
    if (count > 19) {
        count = count % 10;
    }
    switch (+count) {
        case 1: out = "товар"; break;
        case 2:
        case 3:
        case 4: out = "товарa"; break;
        default: out = "товаров"; break;
    }
    $.notify("В корзину добавлено " + $('.counter__field-text').html() + " " + out, "success");
}

function counterIncrease() {
    let count = $('.counter__field-text').html();
    count++;
    $('.counter__field-text').html(count);
};

function counterDecrease() {
    let count = $('.counter__field-text').html();
    if (count > 1) {
        count--;
        $('.counter__field-text').html(count);
    }
};