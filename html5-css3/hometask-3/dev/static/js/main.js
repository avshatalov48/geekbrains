;
// Начинать писать отсюда

$(function() {

    // Пользовательские функции

    // Плавно показать/убрать меню
    $(".left__menu-buttons_open").click(function() {
        $(".left__menu-list").slideToggle(0);
        $(".left__menu-buttons_open").slideToggle(0);
        $(".left__menu-buttons_close").slideToggle(0);
    });

    $(".left__menu-buttons_close").click(function() {
        $(".left__menu-list").slideToggle(0);
        $(".left__menu-buttons_open").slideToggle(0);
        $(".left__menu-buttons_close").slideToggle(0);
    });

});


/* ------------------------------------- */
/* 7. Countdown ........................ */
/* ------------------------------------- */

// Set you end date just below
$('#countdown_dashboard').countDown({
    targetDate: {
        'day': 31,
        'month': 12,
        'year': 2017,
        'hour': 23,
        'min': 59,
        'sec': 59
    },
    omitWeeks: true
});