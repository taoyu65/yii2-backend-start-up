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
            <!-- sidebar-search  -->
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
            <?php
            $menuMap = Yii::$app->controller->loadMenus();
            echo "<div class='sidebar-menu'><ul>";
            echo "<li class='header-menu'><span>General</span></li>";
            foreach ($menuMap as $item) {
                $active = $item['active'] ? 'active' : '';
                $isBuildChild = count($item['child']) > 0;
                $url = isset($item['url']) ? $item['url'] : '#';
                $leadingIcon = '';
                $textClass = '';
                if (isset($item['lead'])) {
                    $iconClass = $item['lead'];
                    $iconClass2 = $item['active'] ? 'icon-hover-color' : '';
                    $textClass = $item['active'] ? 'text-hover-color' : '';
                    $leadingIcon = "<i class='$iconClass $iconClass2'></i>";
                }
                $label = $item['label'];
                $parentClass = $isBuildChild ? 'sidebar-dropdown' : '';
                // parent
                echo "<li class='$parentClass $active'>";
                echo "<a href='$url'>";
                echo $leadingIcon;
                echo "<span class='$textClass'>$label</span>";
                echo isset($item['tail']) ? $item['tail'] : '';
                echo "</a>";
                // child
                if ($isBuildChild) {
                    $display = $item['active'] ? 'display: block' : 'display: none';
                    echo "<div class='sidebar-submenu' style='$display'>";
                    echo '<ul>';
                    foreach ($item['child'] as $child) {
                        echo '<li>';
                        $href = $child['url'];
                        $childIconClass = $child['active'] ? 'icon-hover-color' : '';
                        $childTextClass = $child['active'] ? 'text-hover-color' : '';
                        $childLabel = $child['label'];
                        $childTailIcon = isset($child['tail']) ? $child['tail'] : '';
                        echo "<a href='$href' class='$childIconClass'><span class='$childTextClass'>$childLabel</span> $childTailIcon</a>";
                        echo '</li>';
                    }
                    echo '</ul>';
                    echo '</div>';
                }
                echo '</li>';
            }
            echo "</ul></div>";
            ?>
        </div>
        <!--     sidebar footer    -->
        <div class="sidebar-footer">
            <a href="<?= Yii::$app->urlManager->baseUrl; ?>" target="_blank">
                <i class="fa fa-globe"></i>
            </a>
            <a href="/account-other/change-password">
                <i class="fa fa-key"></i>
            </a>
            <a href="/account-other/setting">
                <i class="fa fa-cogs"></i>
            </a>
            <a href="/account/logout">
                <i class="fa fa-power-off"></i>
            </a>
        </div>
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
