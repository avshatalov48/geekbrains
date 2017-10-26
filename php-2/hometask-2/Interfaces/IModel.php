<?php
interface IModel
{
    public function getOne($id);

    public function getAll();

    public function getTableName();
}