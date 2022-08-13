$(window).on("load resize orientationchange", function () {
    $(".vertical-slider").each(function () {
        let slider = $(this);
        slider.not('.slick-initialized').slick({
            vertical: true,
            verticalSwiping: true,
            slidesToShow: 3,
            infinite: true,
            slidesToScroll: 3,
            prevArrow: slider.parent().find('.wn_block__btnPrev'),
            nextArrow: slider.parent().find('.wn_block__btnNext'),
        });
    });
});
