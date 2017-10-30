<?php
namespace app\models;

class Feedback extends Model
{
    public $id;
    public $user_id;
    public $product_id;
    public $text;

    public function __construct($id = null, $user_id = null, $product_id = null, $text = null, $name = null)
    {
        parent::__construct();
        $this->id = $id;
        $this->user_id = $user_id;
        $this->product_id = $product_id;
        $this->text = $text;
    }

    public function getTableName()
    {
        return 'feedback';
    }
}