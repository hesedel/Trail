<?php
use yii\helpers\Html;
?>
<div class="b-sidebar">
    <div class="b-sidebar-inner">

        <aside class="b-s-social">
            <ul class="b-s-social__ul">
                <li class="b-s-social__li">
                    <i class="b-s-social__icon-a fa fa-twitter-square"></i>
                </li>
                <li class="b-s-social__li">
                    <i class="b-s-social__icon-a fa fa-facebook-square"></i>
                </li>
                <li class="b-s-social__li"><?= Html::a(
                    '<i class="b-s-social__icon-a fa fa-linkedin-square"></i>',
                    'http://de.linkedin.com/in/hesedel/',
                    array(
                        'class' => 'b-s-social__a',
                        'title' => 'LinkedIn',
                        'rel' => 'nofollow',
                        'target' => '_blank',
                    )
                ) ?></li>
            </ul>
        </aside>

        <aside class="b-s-about">
            <?= Html::a(
                //get_avatar('hes@pajaroncreative.com', '88', null, 'Hes'),
                Html::img(
                    '/img/vendor/slir/w336-q6/img/Hes.gif',
                    array(
                        'class' => 'b-s-about__img',
                        'alt' => 'Hess',
                    )
                ),
                array('/site/index'),
                array('class' => 'b-s-about__a-img')
            ) ?>
            <p class="b-s-about__text">Hallo! Welcome to my blog. My name's Hes Pajaron and I'm a <?= Yii::$app->params['description'] ?>.</p>
        </aside>

        <?php if ( is_active_sidebar('sidebar-1') ) { ?>
            <?php dynamic_sidebar('sidebar-1') ?>
        <?php } ?>

    </div>
</div>
