<?php
namespace frontend\views\site;

use Yii;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'FamilyLife Philippines';

$this->registerMetaTag(['name' => 'description', 'content' => 'FamilyLife Philippines - ' . Yii::$app->params['description'] . '.']);
?>
<main class="b-site_index">
    <section class="b-sidebar">
        <div class="">
            <?= Html::button('Create a Trail', array('class' => 'btn btn-default')) ?>

            <div class="btn-group">
                <?= Html::button('Start', array('class' => 'btn btn-default')) ?>
                <?= Html::button('Waypoint', array('class' => 'btn btn-default')) ?>
                <?= Html::button('Finish', array('class' => 'btn btn-default')) ?>
            </div>
        </div>

        <hr>

        <div class="">
            Steps
        </div>

        <hr>

        <div class="">
            <?= Html::button('Cancel', array('class' => 'btn btn-default')) ?>
            <?= Html::button('Save', array('class' => 'btn btn-default')) ?>
        </div>
    </section>

    <section class="b-map">
        <div class="b-map__canvas"></div>
    </section>
</main>
