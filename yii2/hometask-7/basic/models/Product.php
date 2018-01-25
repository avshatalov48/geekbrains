<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $photo
 * @property string $short_description
 * @property string $description
 * @property double $price
 * @property string $create_date
 *
 * @property Feedback[] $feedbacks
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['name'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['create_date'], 'safe'],
            [['name', 'photo', 'short_description'], 'string', 'max' => 255],
            [['imageFile'], 'file',
//                'on' => 'create',
//                skipOnEmpty - обязательная загрузка файла. Отключить, так можно сделать Update, без необходимости обязательной загрузки нового файла
//                'skipOnEmpty' => false,
//                checkExtensionByMimeType - проверять MIME-тип данных, в соответствии с расширением
//                'checkExtensionByMimeType' => false,
                'mimeTypes' => ['image/jpeg', 'image/png'],
                'extensions' => ['jpg', 'jpeg', 'png']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => Yii::t('app_product', 'categoryId'),
            'name' => Yii::t('app_product', 'name'),
            'photo' => Yii::t('app_product', 'photo'),
            'short_description' => Yii::t('app_product', 'shortDescription'),
            'description' => Yii::t('app_product', 'description'),
            'price' => Yii::t('app_product', 'price'),
            'create_date' => Yii::t('app_product', 'createDate'),
            'imageFile' => Yii::t('app_product', 'imageFile'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @inheritdoc
     * @return ProductQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductQuery(get_called_class());
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
        ];
    }

//    public function afterSave($insert, $changedAttributes){
//        if (parent::afterSave($insert, $changedAttributes)) {
//            return Yii::$app->cache->flush();
//        }
//        return false;
//    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Текущий авторизованный юзер, добавивший товар
            // $this->user_id = Yii::$app->user->id;
            if (empty($this->imageFile))
                unset($this->imageFile);
            return true;
        }
        return false;
    }

    public static function saveImageAndModel($model, $post)
    {
        if ($model->load($post)) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->imageFile->baseName) {
                $model->photo = $model->imageFile->name;
                // Сохранение загружаемого файла
                file_put_contents(Yii::getAlias("@img/products/{$model->photo}"), file_get_contents($model->imageFile->tempName));
                // Создание маленького файла из оригинала c помощью Imagine
                Image::thumbnail("@img/products/{$model->photo}", 200, 150)
                ->save(Yii::getAlias("@img/products/small/{$model->photo}"), ['quality' => 75]);
            }
            return ($model->validate() && $model->save());
        }
        return false;
    }

}