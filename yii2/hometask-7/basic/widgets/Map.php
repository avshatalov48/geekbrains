<?php

namespace app\widgets;

use yii\base\Widget;

class Map extends Widget
{
    public $mapHeight = "500px";
    public $mapWidth = "80%";
    public $mapX = 55.753564;
    public $mapY = 37.621085;
    public $mapZoom = 12;
    /*
     * Схема (yandex#map) — по умолчанию;
     * Спутник (yandex#satellite);
     * Гибрид (yandex#hybrid);
     * Народная карта (yandex#publicMap);
     * Гибрид народной карты (yandex#publicMapHybrid).
     * */
    public $mapType = "yandex#map";

    public function run()
    {
        return $this->render("map",
            [
                'mapHeight' => $this->mapHeight,
                'mapWidth' => $this->mapWidth,
                'mapX' => $this->mapX,
                'mapY' => $this->mapY,
                'mapZoom' => $this->mapZoom,
                'mapType' => $this->mapType
            ]
        );
    }
}