$( document ).ready(function() {
    $('.category').mouseenter(function () {
        $('.category-subcategory').show();
        $('.category-li').mouseleave(function () {
            $('.category-subcategory').hide();
        });
    });
});
