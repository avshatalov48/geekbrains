<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

//Yii::$app->language = 'en-EN';
//Yii::$app->language = 'ru-RU';

$this->title = Yii::t('app', 'titleForm');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php

    if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            <?= Yii::t('app', 'successFormMessage') ?>
        </div>

        <p>
            <?= Yii::t('app', 'debuggerFormMessage') ?>
            <?php if (Yii::$app->mailer->useFileTransport): ?>
                <?= Yii::t('app', 'notSentFormMessage', ['code' => Yii::getAlias(Yii::$app->mailer->fileTransportPath)]) ?>
            <?php endif; ?>
        </p>

    <?php else:

        $key = 'contact';
        // if ($this->beginCache($key, ['enabled' => Yii::$app->request->isGet])) {
        ?>

            <?php

//                var_dump(Yii::$app->request);
//                echo "<hr><b>Проверка кэширования:</b>" .
//                "<br>static: " . date("H:i:s") .
//                "<br>dynamic: " . $this->renderDynamic('return date("H:i:s");') . "<hr>";

//                echo "<br>" . Yii::$app->request->getMethod();
            ?>

        <p>
            <?= Yii::t('app', 'helloFormMessage') ?>
        </p>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                    <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'email') ?>

                    <?= $form->field($model, 'subject') ?>

                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                    ]) ?>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'send'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                    </div>

                <?php
                    ActiveForm::end();
                    // $this->endCache();
                //}
                ?>


            </div>
        </div>

    <?php endif; ?>
</div>
