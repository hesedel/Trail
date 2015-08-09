<?php
namespace frontend\views\site;

use Yii;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'FamilyLife Philippines';

$this->registerMetaTag(['name' => 'description', 'content' => 'FamilyLife Philippines - ' . Yii::$app->params['description'] . '.']);
?>
<main class="b-site_index">
    <div class="b-site_index__section-group">
        <section class="b-site_index__section b-description">
            <h2 class="container b-description__h2"><?= Yii::$app->params['description'] ?></h2>
        </section>

        <section class="b-site_index__section b-randomImage">
            <?php $images = glob('img/Site/index/b-randomImage/images/*.jpg') ?>
            <?= Html::img(
                '/img/vendor/slir/w780/' . $images[mt_rand(0, count($images) - 1)],
                //'http://res.cloudinary.com/pajaroncreative/image/upload/c_fill,h_1080,w_1920/v1424604576/bg_nj7thv.png',
                array(
                    'class' => 'b-randomImage__img',
                    'alt' => '',
                )
            ) ?>
        </section>

        <section class="b-site_index__section b-about">
            <div class="container">
                <p>GOD, who instituted marriage and the family, offers hope, harmony, health, happiness, to your marriage and family.</p>
                <p>FamilyLife Philippines, a non-denominational, non-partisan, non-government organization, is committed to YOU and YOUR FAMILY!</p>
            </div>
        </section>
    </div>

    <section class="b-site_index__section b-site_index__section_isolated b-events">
        <div class="container">
            <h3 class="b-site_index__heading">Events</h3>

            <div class="row">
                <div class="col-sm-6 b-events__event">
                    <?= Html::img(
                        '/img/vendor/slir/w276/img/isd-logo.png',
                        array(
                            'class' => 'b-events__event-img',
                            'alt' => 'I Still Do logo',
                        )
                    ) ?>
                    <h4 class="b-events__event-title">I Still Do</h4>
                    <p class="b-events__event-description">A one-day seminar that will bring the sparkle back to the vow you made on your wedding day.</p>
                </div>
                <div class="col-sm-6 b-events__event">
                    <?= Html::img(
                        '/img/vendor/slir/w276/img/taom-logo.png',
                        array(
                            'class' => 'b-events__event-img',
                            'alt' => 'The Art of Marriage logo',
                        )
                    ) ?>
                    <h4 class="b-events__event-title">The Art of Marriage</h4>
                    <p class="b-events__event-description">A weekend event on video that weaves together expert teaching, stories and humor to portray the challenges and beauty of God’s design.</p>
                    <?php /*
                    <p>A live presentation of the video event by FamilyLife speakers who blend video content with live teaching and stories from their own marriages.</p>
                    <p>A small-group study version with video where couples learn together and encourage one another to achieve God’s design for their marriages.</p>
                    <p>A series of single-topic small-group studies that deliver biblically centered truth and practical application to make marriages healthy and strong.</p>
                    */ ?>
                </div>
            </div>
        </div>
    </section>

    <section class="b-site_index__section b-site_index__section_isolated b-contact">
        <div class="container">
            <h3 class="b-site_index__heading">Get in touch</h3>

            <div class="b-contact__facebook">
                <?= Html::a(
                    '<i class="fa fa-facebook-official b-contact__facebook-icon"></i>FamilyLife Philippines on Facebook',
                    'https://www.facebook.com/pages/FamilyLife-Philippines/196795831514',
                    array('class' => 'btn btn-default b-contact__facebook-a')
                ) ?>
            </div>

            <ul class="nav nav-tabs b-contact__tabs" role="tablist">
                <li role="presentation" class="active"><?= Html::a(
                    'Manila',
                    '#b-contact-manila',
                    array(
                        'aria-controls' => 'b-contact-manila',
                        'role' => 'tab',
                        'data-toggle' => 'tab',
                    )
                ) ?></li>
                <li role="presentation"><?= Html::a(
                    'Manila 2',
                    '#b-contact-manila-2',
                    array(
                        'aria-controls' => 'b-contact-manila-2',
                        'role' => 'tab',
                        'data-toggle' => 'tab',
                    )
                ) ?></li>
                <li role="presentation"><?= Html::a(
                    'Davao',
                    '#b-contact-davao',
                    array(
                        'aria-controls' => 'b-contact-davao',
                        'role' => 'tab',
                        'data-toggle' => 'tab',
                    )
                ) ?></li>
            </ul>

            <div class="tab-content b-contact__tab-content">
                <div role="tabpanel" class="tab-pane active" id="b-contact-manila">
                    <h4 class="b-contact__tab-pane-title">FamilyLife Philippines in the Philippine Campus Crusade for Christ national office</h4>

                    <ul class="list-group b-contact__tab-pane-info">
                        <li class="list-group-item"><?= Html::a(
                            '<i class="fa fa-phone b-contact__tab-pane-info-icon"></i>(+63) (2) 412-5428',
                            'tel:+63-2-412-5428'
                        ) ?></li>
                        <li class="list-group-item"><?= Html::a(
                            '<i class="fa fa-phone b-contact__tab-pane-info-icon"></i>(+63) (2) 412-5429',
                            'tel:+63-2-412-5428'
                        ) ?></li>
                        <li class="list-group-item"><i class="fa fa-map-marker b-contact__tab-pane-info-icon"></i>40 Sct. Borromeo South Triangle, Quezon City</li>
                    </ul>
                    <div class="b-map b-map--pccc">
                        <div class="b-map__before"></div>
                        <i class="fa fa-map-marker b-map__marker"></i>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="b-contact-manila-2">
                    <h4 class="b-contact__tab-pane-title">FamilyLife Philippines in the International Graduate School of Leadership</h4>

                    <ul class="list-group b-contact__tab-pane-info">
                        <li class="list-group-item"><i class="fa fa-map-marker b-contact__tab-pane-info-icon"></i>12 Daisy Rd. Old Sauyo Novaliches Quezon City</li>
                    </ul>
                    <div class="b-map b-map--igsl">
                        <div class="b-map__before"></div>
                        <i class="fa fa-map-marker b-map__marker"></i>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="b-contact-davao">
                    <h4 class="b-contact__tab-pane-title">FamilyLife Philippines in the Philippine Campus Crusade for Christ Davao city office</h4>

                    <ul class="list-group b-contact__tab-pane-info">
                        <li class="list-group-item"><i class="fa fa-map-marker b-contact__tab-pane-info-icon"></i>420 Champaca St. Juna Subd. Matina Davao City</li>
                    </ul>
                    <div class="b-map b-map--davao">
                        <div class="b-map__before"></div>
                        <i class="fa fa-map-marker b-map__marker"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
