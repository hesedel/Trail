<?php
use yii\helpers\Html;
use frontend\assets\AppAsset;
use frontend\assets\AppAsset2;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
AppAsset2::register($this);
if (YII_ENV_DEV) {
    yii\debug\ToolbarAsset::register($this);
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="<?= Yii::$app->language ?>"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" lang="<?= Yii::$app->language ?>"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" lang="<?= Yii::$app->language ?>"><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" lang="<?= Yii::$app->language ?>"><!--<![endif]-->
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <?= Html::csrfMetaTags() ?><?php
    if ( $this->beginCache('metaTags', ['duration' => 0]) ) {
        if ( $this->metaTags ) {
            foreach ( $this->metaTags as $metaTagKey => $metaTagValue ) {
                echo "\n    " . $metaTagValue;
            }
            echo "\n";
        }
        $this->endCache();
    }
    ?>

    <title><?= Html::encode($this->title) ?></title>

    <?php //<link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16"> ?>
    <?php //<link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32"> ?>

    <?php if ( $this->beginCache('css-' . $this->context->module->requestedAction->id, ['duration' => 0, 'enabled' => YII_ENV_PROD ? true : false]) ) { ?><?= Html::style(
        rtrim(
            file_get_contents('css/site-internal.css') . (
                file_exists('css/site_' . $this->context->module->requestedAction->id . '-internal.css') ?
                    file_get_contents('css/site_' . $this->context->module->requestedAction->id . '-internal.css') :
                    ''
            )
        )
    ) ?>


    <!--[if lt IE 9]>
    <?php
    foreach ( $this->assetBundles as $assetBundleKey => $assetBundleValue ) {
        foreach ( $assetBundleValue->css as $cssKey => $cssValue ) {
    ?><link href="<?= $assetBundleValue->baseUrl . '/' . $cssValue ?>" rel="stylesheet">
    <?php
        }
    }
    ?><![endif]-->
    <!--[if gt IE 8]><!-->
    <noscript>
    <?php
    foreach ( $this->assetBundles as $assetBundleKey => $assetBundleValue ) {
        foreach ( $assetBundleValue->css as $cssKey => $cssValue ) {
    ?><link href="<?= $assetBundleValue->baseUrl . '/' . $cssValue ?>" rel="stylesheet">
    <?php
        }
    }
    ?></noscript>
    <!--<![endif]--><?php $this->endCache(); } ?>

    <!--[if lt IE 9]>
    <?= Html::script(null, array('src' => '/js/vendor/modernizr-2.8.3.min.js')) ?>

    <![endif]-->

<?php defined('WP_USE_THEMES') ? wp_head() : '' ?><?php //$this->head() ?>

</head>
<body class="Site_<?= $this->context->module->requestedAction->id . (defined('WP_USE_THEMES') && is_home() ? ' Site_' . $this->context->module->requestedAction->id . '_home' : '') ?>">
    <?php $this->beginBody() ?><!--[if lt IE 10]>
    <div class="container b-lt-ie10">
        <p class="b-lt-ie10__p"><span class="no-js"><?= Html::img(
            //'/img/logo-white-h144.png',
            'http://res.cloudinary.com/pajaroncreative/image/upload/v1424605546/logo-white-h144_fshosy.png',
            array(
                'class' => 'b-lt-ie10__logo',
                'alt' => 'Pajaron Creative',
            )
        ) ?><strong>JavaScript</strong> needs to be <u>enabled</u> for this</span><span class="js">You are using an</span> <strong>outdated</strong> browser. Please <?= Html::a('upgrade your browser', 'http://browsehappy.com/', array('rel' => 'nofollow', 'target' => '_blank')) ?> to improve your experience.</p>
    </div>
    <![endif]-->

    <nav class="b-navbar navbar navbar-default navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Trail</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">Link</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#">Link</a></li>
                </ul>

                <div class="b-search navbar-form" role="search">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="js-b-search__button--currentPosition btn btn-default" type="button"><i class="fa fa-crosshairs"></i></button>
                            </span>
                            <input type="text" class="js-b-search__inputText form-control" placeholder="Search">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="b-body">
        <?= $content ?>
    </div>

    <footer class="b-footer">
        <div class="container">
            <div class="b-footer__familylife"> <?= Html::a('FamilyLife', 'http://www.familylife.com/', array('class' => 'b-footer__a', 'rel' => 'nofollow')) ?></div>
            <div class="b-footer__pajaroncreative"> <?= Html::a('Pajaron Creative', 'http://pajaroncreative.com/', array('class' => 'b-footer__a')) ?></div>
            <div class="b-footer__copyright">&copy; <?= date('Y') ?> Trail</div>
        </div>
    </footer>

    <?php if ( $this->beginCache('js', ['duration' => 0, 'enabled' => YII_ENV_PROD ? true : false]) ) { ?><!--[if gt IE 8]><!-->
    <script>
    // CSS
    (function () {
    var link;
    <?php
    foreach ( $this->assetBundles as $assetBundleKey => $assetBundleValue ) {
        foreach ( $assetBundleValue->css as $cssKey => $cssValue ){
    ?>link = document.createElement('link');
    link.rel = 'stylesheet';
    link.type = 'text/css';
    link.href = '<?= $assetBundleValue->baseUrl . '/' . $cssValue ?>';
    document.getElementsByTagName('head')[0].appendChild(link);
    <?php
        }
    }
    ?>}());
    </script>
    <!--<![endif]--><?php $this->endCache(); } ?>


    <script>
    // Typekit
    /*
    (function(d) {
    var config = {
    kitId: 'jud2zwh',
    scriptTimeout: 3000
    },
    h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='//use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
    })(document);
    */
    </script>
    <?php if ( $_SERVER['HTTP_HOST'] === 'familylife.ph' ) { ?>

    <script>
    // Google Analytics
    /*
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-59938306-1', 'auto');
    ga('send', 'pageview');
    */
    </script>
    <?php } ?>

    <!--[if gt IE 8]><!-->
    <?= Html::script(null, array('src' => '/js/vendor/modernizr-2.6.2.min.js')) ?>

    <!--<![endif]-->
    <?= Html::script(null, array('src' => 'https://maps.googleapis.com/maps/api/js?key=AIzaSyAjuLw6nncCfFh_qaWBlfw7ftnBU_8lkgk&libraries=places')) ?>


<?php $this->endBody() ?>

<!--[if gt IE 8]><!-->
<?= Html::script(null, array('src' => '/js/vendor/isotope.pkgd.min.js')) ?>

<!--<![endif]-->
</body>
</html>
<?php $this->endPage() ?>
