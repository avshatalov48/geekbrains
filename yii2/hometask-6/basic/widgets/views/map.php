<script src="http://api-maps.yandex.ru/2.1.18/?lang=ru_RU" type="text/javascript"></script>

<style>
    #map {
        width: <?=$mapWidth?>;
        height: <?=$mapHeight?>;
        margin: 0 auto;
    }
</style>

<script type="text/javascript">
    var myMap;
    // Дождёмся загрузки API и готовности DOM. jQuery
    ymaps.ready(init);

    function init() {
        // Создание экземпляра карты и его привязка к контейнеру с
        // заданным id ("map").
        myMap = new ymaps.Map('map', {
            // При инициализации карты обязательно нужно указать
            // её центр и коэффициент масштабирования.
            center: [<?=$mapX?>, <?=$mapY?>],
            zoom: <?=$mapZoom?>,
            // Тип покрытия карты
            type: '<?=$mapType?>',
            controls: ['zoomControl', 'typeSelector']
        });
    }
</script>

<div id="map"></div>