<?php

namespace app\services;

class Db
{
    public function execute($sql, $params = [])
    {
        return true;
    }

    public function queryOne($sql, $params = [])
    {
        return [];
    }

    public function queryAll($sql, $params = []){
        return [];
    }
}