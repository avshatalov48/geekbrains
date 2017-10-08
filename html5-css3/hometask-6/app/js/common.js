$(function() {

	// Пользовательские функции

    // Плавно показать/убрать меню
    $(".header__top-menu-button").click(function() {
        $(".header__top-menu-list").slideToggle(125);
    });

    // Плавно показать секцию статей - fifth
    $(".under-subscribe__btn-loadmore-link").click(function() {
        $(".under-subscribe__section-fifth").slideDown();
    });

    // Плавный скролл до блока .div по клику на .scroll
    // Документация: https://github.com/flesler/jquery.scrollTo
    $(".header__top-menu-item-link_lifestyle").click(function() {
        $.scrollTo($(".main__section-second"), 600, {
            offset: -90
        });
    });

    $(".header__top-menu-item-link_photodiary").click(function() {
        $.scrollTo($(".main__section-intro-category_up"), 600, {
            offset: -90
        });
    });

    $(".header__top-menu-item-link_music").click(function() {
        $.scrollTo($(".main__section-third"), 600, {
            offset: -90
        });
    });

    $(".header__top-menu-item-link_travel").click(function() {
        $.scrollTo($(".under-subscribe__section-fourth"), 600, {
            offset: -90
        });
    });

    $(".footer__left-menu-item-link_terms").click(function() {
        $.scrollTo($(".header__top"), 600, {
            offset: -90
        });
    });

    $(".footer__left-menu-item-link_privacy").click(function() {
        $.scrollTo($(".header__top"), 600, {
            offset: -90
        });
    });

    $(".footer__right-menu-item-link_follow").click(function() {
        $.scrollTo($(".header__top"), 600, {
            offset: -90
        });
    });

});