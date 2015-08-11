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
            <div class="b-toolbox__browse">
                <?= Html::button('Create a Trail', array('class' => 'js-b-toolbox__button--create btn btn-default')) ?>
            </div>

            <div class="b-toolbox__createUpdate">
                <div class="js-b-toolbox__buttons--poi btn-group">
                    <?= Html::button('Origin', array('class' => 'btn btn-default active', 'data-poi-type' => '0')) ?>
                    <?= Html::button('Waypoint', array('class' => 'btn btn-default', 'data-poi-type' => '1')) ?>
                    <?= Html::button('Destination', array('class' => 'btn btn-default', 'data-poi-type' => '2')) ?>
                </div>
            </div>
        </div>

        <div class="b-steps">
            <?php /*
            <div class="alert alert-info" role="alert">
                Click on the map to designate the starting point.
            </div>
            */ ?>
        </div>

        <div class="b-toolbox b-toolbox--footer">
            <div class="b-toolbox--footer__createUpdate">
                <?= Html::button('Cancel', array('class' => 'js-b-toolbox__button--cancel btn btn-default')) ?>
                <?= Html::button('Save', array('class' => 'js-b-toolbox__button--save btn btn-default')) ?>
            </div>
        </div>
    </section>

    <section class="b-map">
        <div class="b-map__canvas"></div>
    </section>
</main>
