$(document).ready(function() {
    var $heroBg = $('.hero-bg');

    if ($heroBg.length) {
        $heroBg.parallax({
            imageSrc: 'img/game-background.jpg',
            speed: 0.2,
            bleed: 10
        });
    }

    $('.tm-nav-link').on('click', function(e) {
    });
});