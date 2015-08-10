<?php
namespace frontend\views\site;

use Yii;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Trail';

$this->registerMetaTag(['name' => 'description', 'content' => 'Trail - ' . Yii::$app->params['description'] . '.']);
?>
<main class="js-b-site_index b-site_index">
    <section class="b-sidebar">
        <div class="b-toolbox">
            <div class="b-toolbox__1">
                <?= Html::button('Create a Trail', array('class' => 'js-b-toolbox__button--create btn btn-default')) ?>
            </div>

            <div class="b-toolbox__2">
                <div class="btn-group">
                    <?= Html::button('Origin', array('class' => 'js-b-toolbox__button--poi btn btn-default active', 'data-poi' => 'origin')) ?>
                    <?= Html::button('Waypoint', array('class' => 'js-b-toolbox__button--poi btn btn-default', 'data-poi' => 'waypoint')) ?>
                    <?= Html::button('Destination', array('class' => 'js-b-toolbox__button--poi btn btn-default', 'data-poi' => 'destination')) ?>
                </div>
            </div>
        </div>

        <div class="b-steps">
            <div class="alert alert-info" role="alert">
                Click on the map to designate the starting point.
            </div>
        </div>

        <div class="b-toolbox b-toolbox--footer">
            <div class="b-toolbox--footer__2">
                <?= Html::button('Cancel', array('class' => 'btn btn-default')) ?>
                <?= Html::button('Save', array('class' => 'btn btn-default')) ?>
            </div>
        </div>
    </section>

    <section class="b-map">
        <div class="b-map__canvas"></div>
    </section>
</main>
