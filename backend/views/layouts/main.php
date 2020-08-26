<?php

/* @var $content string */

use backend\assets\AppAsset;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\bootstrap4\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
        <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
        <div class="sidebar-content">
            <div class="sidebar-brand">
                <a href="#">LoveSwapsy</a>
                <div id="close-sidebar">
                    <i class="fas fa-times"></i>
                </div>
            </div>
            <div class="sidebar-header">
                <div class="user-pic">
                    <img class="img-responsive img-rounded" src="/image/user.jpg" alt="User picture">
                </div>
                <div class="user-info">
                    <span class="user-name"><?= Yii::$app->controller->firstName ?>
                        <?= Yii::$app->controller->lastName ?>
                        </span>
                        <span class="user-role">Administrator</span>
                        <span class="user-status">
                        <i class="fa fa-circle"></i>
                        <span>Online</span>
                    </span>
                </div>
            </div>
            <!-- sidebar-header  -->
<!--            <div class="sidebar-search">-->
<!--                <div>-->
<!--                    <div class="input-group">-->
<!--                        <input type="text" class="form-control search-menu" placeholder="Search...">-->
<!--                        <div class="input-group-append">-->
<!--              <span class="input-group-text">-->
<!--                <i class="fa fa-search" aria-hidden="true"></i>-->
<!--              </span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
            <!-- sidebar-search  -->
            <div class="sidebar-menu">
                <ul>
                    <li class="header-menu">
                        <span>General</span>
                    </li>
                    <li class="sidebar-dropdown active">
                        <a href="#">
                            <i class="fa fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                            <span class="badge badge-pill badge-warning">New</span>
                        </a>
                        <div class="sidebar-submenu" style="display: block">
                            <ul>
                                <li class="active" >
                                    <a href="#">Dashboard 1
                                        <span class="badge badge-pill badge-success">Pro</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">Dashboard 2</a>
                                </li>
                                <li>
                                    <a href="#">Dashboard 3</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i>
                            <span>E-commerce</span>
                            <span class="badge badge-pill badge-danger">3</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="#">Products

                                    </a>
                                </li>
                                <li>
                                    <a href="#">Orders</a>
                                </li>
                                <li>
                                    <a href="#">Credit cart</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="far fa-gem"></i>
                            <span>Components</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="#">General</a>
                                </li>
                                <li>
                                    <a href="#">Panels</a>
                                </li>
                                <li>
                                    <a href="#">Tables</a>
                                </li>
                                <li>
                                    <a href="#">Icons</a>
                                </li>
                                <li>
                                    <a href="#">Forms</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-chart-line"></i>
                            <span>Charts</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="#">Pie chart</a>
                                </li>
                                <li>
                                    <a href="#">Line chart</a>
                                </li>
                                <li>
                                    <a href="#">Bar chart</a>
                                </li>
                                <li>
                                    <a href="#">Histogram</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar-dropdown">
                        <a href="#">
                            <i class="fa fa-globe"></i>
                            <span>Maps</span>
                        </a>
                        <div class="sidebar-submenu">
                            <ul>
                                <li>
                                    <a href="#">Google maps</a>
                                </li>
                                <li>
                                    <a href="#">Open street map</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span>Documentation</span>
                            <span class="badge badge-pill badge-primary">Beta</span>
                        </a>
                    </li>

                    <!-- real menus -->


                </ul>
            </div>
            <!-- sidebar-menu  -->
        </div>
        <!-- sidebar-content  -->
<!--        <div class="sidebar-footer">-->
<!--            <a href="#">-->
<!--                <i class="fa fa-bell"></i>-->
<!--                <span class="badge badge-pill badge-warning notification">3</span>-->
<!--            </a>-->
<!--            <a href="#">-->
<!--                <i class="fa fa-envelope"></i>-->
<!--                <span class="badge badge-pill badge-success notification">7</span>-->
<!--            </a>-->
<!--            <a href="#">-->
<!--                <i class="fa fa-cog"></i>-->
<!--                <span class="badge-sonar"></span>-->
<!--            </a>-->
<!--            <a href="#">-->
<!--                <i class="fa fa-power-off"></i>-->
<!--            </a>-->
<!--        </div>-->
    </nav>
    <main class="page-content">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?php
        foreach (Yii::$app->getSession()->getAllFlashes() as $key => $message) {
            switch ($key) {
                case 'success':
                    $icon = "<span class='fa fa-check'></span> ";
                    break;
                case 'danger':
                    $icon = "<span class='fa fa-times'></span> ";
                    break;
                case 'info':
                    $icon = "<span class='fa fa-info'></span> ";
                    break;
                default:
                    $icon = '';
                    break;
            }
            $message = $icon . $message;
            echo Alert::widget(['options' => ['class' => 'alert-' . $key], 'body' => $message]);
        }
        ?>
        <?= $content ?>
        <footer class="text-center">
            <div class="mb-2">
                <small>
                    <?php echo Yii::$app->name; ?> &copy; <?= date('Y') ?>
                </small>
            </div>
        </footer>
    </main>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
