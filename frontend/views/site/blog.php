<?php
#namespace frontend\views\blog;

#use Yii;
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = (is_single() ? get_the_title() . ' - ' : '') . 'Pajaron Creative Blog';

$this->registerMetaTag(['name' => 'description', 'content' => 'Hes Pajaron - A ' . Yii::$app->params['description'] . '.']);
?>
<main class="b-site_blog<?= is_single() ? ' b-site_blog_is-single' : '' ?>">

    <div class="b-rotated b-rotated_nav">
        <div class="b-rotated__bg b-rotated__bg_split">
            <table>
                <tr>
                    <td<?= is_home() ? ' class="_is-active"' : '' ?>>&nbsp;</td>
                    <td<?= !is_home() && has_category('html') ? ' class="_is-active"' : '' ?>>&nbsp;</td>
                    <td<?= !is_home() && has_category('css') ? ' class="_is-active"' : '' ?>>&nbsp;</td>
                    <td class="visible-sm visible-md visible-lg<?= !is_home() && has_category('js') ? ' _is-active' : '' ?>">&nbsp;</td>
                    <td class="visible-sm visible-md visible-lg<?= !is_home() && has_category('php') ? ' _is-active' : '' ?>">&nbsp;</td>
                    <td class="visible-sm visible-md visible-lg<?= !is_home() && has_category('gallery') ? ' _is-active' : '' ?>">&nbsp;</td>
                </tr>
                <tr class="hidden-sm hidden-md hidden-lg">
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                    <td class="hidden"></td>
                    <td class="hidden"></td>
                    <td class="hidden"></td>
                </tr>
            </table>
        </div>
        <div class="container b-rotated__unrotated">
            <div class="row">
                <div class="b-rotated_nav__a-container col-xs-4 col-sm-2">
                    <?= Html::a('<span class="b-rotated_nav__a-bg"></span><span class="b-rotated_nav__a-text">All</span>', array('/site/blog'), array('class' => 'b-rotated_nav__a' . (is_home() ? ' b-rotated_nav__a_is-active' : ''))) ?>
                </div>
                <div class="b-rotated_nav__a-container col-xs-4 col-sm-2">
                    <?= Html::a('<span class="b-rotated_nav__a-bg"></span><span class="b-rotated_nav__a-text">HTML</span>', array('/site/blog', 'category_name' => 'html'), array('class' => 'b-rotated_nav__a' . (!is_home() && has_category('html') ? ' b-rotated_nav__a_is-active' : ''))) ?>
                </div>
                <div class="b-rotated_nav__a-container col-xs-4 col-sm-2">
                    <?= Html::a('<span class="b-rotated_nav__a-bg"></span><span class="b-rotated_nav__a-text">CSS</span>', array('/site/blog', 'category_name' => 'css'), array('class' => 'b-rotated_nav__a' . (!is_home() && has_category('css') ? ' b-rotated_nav__a_is-active' : ''))) ?>
                </div>
                <div class="hidden-sm hidden-md hidden-lg clear"></div>
                <div class="b-rotated_nav__a-container col-xs-4 col-sm-2">
                    <?= Html::a('<span class="b-rotated_nav__a-bg"></span><span class="b-rotated_nav__a-text">JS</span>', array('/site/blog', 'category_name' => 'js'), array('class' => 'b-rotated_nav__a' . (!is_home() && has_category('js') ? ' b-rotated_nav__a_is-active' : ''))) ?>
                </div>
                <div class="b-rotated_nav__a-container col-xs-4 col-sm-2">
                    <?= Html::a('<span class="b-rotated_nav__a-bg"></span><span class="b-rotated_nav__a-text">PHP</span>', array('/site/blog', 'category_name' => 'php'), array('class' => 'b-rotated_nav__a' . (!is_home() && has_category('php') ? ' b-rotated_nav__a_is-active' : ''))) ?>
                </div>
                <div class="b-rotated_nav__a-container b-rotated_nav__a-container_last-child col-xs-4 col-sm-2">
                    <?= Html::a('<span class="b-rotated_nav__a-bg"></span><span class="b-rotated_nav__a-text">Gallery</span>', array('/site/blog', 'category_name' => 'gallery'), array('class' => 'b-rotated_nav__a' . (!is_home() && has_category('gallery') ? ' b-rotated_nav__a_is-active' : ''))) ?>
                </div>
            </div>
        </div>
    </div>

    <?php /* if ( is_single() && has_post_thumbnail() ) { ?>
    <div class="b-rotated b-rotated_thumbnail">
        <div class="b-rotated__bg"></div>
        <div class="container b-rotated__unrotated">
            <?= Html::img(
                '/img/vendor/slir/w750/' . get_post(get_post_thumbnail_id())->guid,
                array(
                    'class' => 'b-post__thumbnail',
                    'alt' => get_the_title(),
                )
            ) ?>
        </div>
    </div>
    <?php } */ ?>

    <?php
    $is_gallery = false;

    if ( have_posts() && isset($_GET['category_name']) && $_GET['category_name'] === 'gallery' ) {
        $is_gallery = true;
    }
    ?>

    <?php
    if ( is_category() ) {
        if ( category_description() ) {
    ?>
    <div class="b-rotated b-rotated_category<?= $is_gallery ? ' j-rotated_category' : '' ?>">
        <div class="b-rotated__bg"></div>
        <div class="container b-rotated__unrotated">
            <?= category_description() ?>
        </div>
    </div>
    <?php
        }
    }
    ?>

    <div class="b-rotated b-rotated_posts-top<?= ( $is_gallery ? ' j-rotated_posts-top' : '' ) . ( is_category() && category_description() ? ' j-rotated_posts-top_has-categoryDescription' : '' ) ?>">
        <div class="b-rotated__bg"></div>
        <div class="container b-rotated__unrotated"></div>
    </div>

    <div class="b-posts<?= $is_gallery ? ' j-posts j-posts_is-loading' : '' ?>">
        <?php
        if ( have_posts() ) {
            while ( have_posts() ) {
                the_post();
        ?>

        <?php if ( is_single() ) { ?>

        <article class="b-post<?= (get_post_format() ? ' b-post_' . get_post_format() : '') ?>">
            <header>
                <h1 class="b-post__title"><?php the_title() ?></h1>
                <?php comments_popup_link('<i class="fa fa-comments"></i> Be the first to comment', '<i class="fa fa-comments"></i> 1 comment', '<i class="fa fa-comments"></i> % comments', 'btn btn-default btn-sm', '<i class="fa fa-comments"></i> Commenting disabled') ?><!--
                --><hr class="hidden-md hidden-lg"><!--
                --><span class="b-post__time"><i class="fa fa-clock-o"></i> <?php echo get_the_date() ?></span>
                <span class="b-post__author">by <strong><?php the_author(); ?></strong></span>
            </header>

            <?php
            if ( has_post_thumbnail() ) {
                echo Html::img(
                    '/img/vendor/slir/w750/' . get_post(get_post_thumbnail_id())->guid,
                    array(
                        'class' => 'b-post__thumbnail',
                        'alt' => get_the_title(),
                    )
                );
            }
            ?>

            <div class="b-post__content"><?php the_content(false) ?></div>
        </article>

        <?= $this::render('blog/_sidebar') ?>

        <?php if ( comments_open() || get_comments_number() ) {
            comments_template('/../../../../../../frontend/views/site/blog/_comments.php');
        } ?>

        <?php } else { ?>

        <?php
        $thumbnail_height_2 = '';
        $jPost_rowMd2 = false;
        $jPost_colMd2 = false;

        if ( $is_gallery ) {
            $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($post->id), 'full');
            $thumbnail_width = $thumbnail['1'];
            $thumbnail_height = $thumbnail['2'];

            if ( $thumbnail_width < $thumbnail_height ) {
                $jPost_rowMd2 = true;
            }

            if ( $thumbnail_width >= $thumbnail_height * 2 ) {
                $jPost_colMd2 = true;
            }
        }
        ?>

        <article class="b-post<?= (has_post_thumbnail() ? ' b-post_has-thumbnail' : '') . (!get_post_format() ? ' b-post_default' : ' b-post_' . get_post_format()) . ($jPost_rowMd2 ? ' j-post_row-md-2' : '') . ($jPost_colMd2 ? ' j-post_col-md-2' : '') ?>">
            <div class="b-post__right-bg"></div>

            <header class="b-post__left b-post__left_1">
                <div class="b-post__left-inner">
                    <h2 class="b-post__title"><?= Html::a(
                        get_the_title(),
                        get_the_permalink(),
                        array('class' => 'b-post__a-title')
                    ) ?></h2>
                    <span class="b-post__time"><i class="fa fa-clock-o"></i> <?php echo get_the_date() ?></span>
                    <span class="b-post__author">by <strong><?php the_author(); ?></strong></span>
                </div>
            </header>

            <?php if ( has_post_thumbnail() ) { ?>
            <div class="b-post__right">
                <?= Html::a(
                    Html::img(
                        '/img/vendor/slir/w450-h450/' . get_post(get_post_thumbnail_id())->guid,
                        array(
                            'class' => 'b-post__thumbnail',
                            'alt' => get_the_title(),
                        )
                    ) .
                    (
                        $is_gallery ?
                            '<span class="j-post__thumbnail" style="padding-bottom: ' . (100 * ($thumbnail_height / $thumbnail_width)) . '%"></span>' :
                            ''
                    ) .
                    (
                        get_post_format() === 'video' ?
                            '<span class="b-post_video__thumbnail-overlay"><i class="fa fa-video-camera"></i></span>' :
                            ''
                    ),
                    get_the_permalink(),
                    array('class' => 'b-post__a-thumbnail')
                ) ?>
            </div>
            <?php } ?>

            <div class="b-post__left b-post__left_2">
                <div class="b-post__left-inner">
                    <div class="b-post__content"><?php the_content(false) ?></div>
                    <?= Html::a(
                        'Read more',
                        get_the_permalink(),
                        array('class' => 'btn btn-default')
                    ) ?><!--
                    --><?php comments_popup_link('<i class="fa fa-comments"></i> No comments', '<i class="fa fa-comments"></i> 1 comment', '<i class="fa fa-comments"></i> % comments', 'b-post__comment', null) ?>
                </div>
            </div>
        </article>

        <?php } ?>

        <?php } ?>

        <?php
        global $wp_query;
        if ( $wp_query->max_num_pages > 1 ) {
        ?>

        <div class="b-posts__pagination">
            <?php posts_nav_link('<!---->', '‹ Newer posts', 'Older posts ›') ?>
        </div>

        <?php } ?>

        <?php } else { ?>

        <article class="b-post b-post_empty">
            <h2 class="b-post__title">Sorry, nothing to see here.</h2>
        </article>

        <?php } ?>
    </div>

    <?php if ( !is_single() ) {
        echo $this::render('blog/_sidebar');
    } ?>

    <div class="b-rotated b-rotated_posts-bottom<?= $is_gallery ? ' j-rotated_posts-bottom' : '' ?>">
        <div class="b-rotated__bg b-rotated__bg_split">
            <table>
                <tr>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
        <div class="container b-rotated__unrotated"></div>
    </div>

</main>
