<?php use yii\helpers\Url;

if($count > 0): ?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-bell-o"></i>
    <span class="label label-warning"><?=$count?></span>
</a>
<ul class="dropdown-menu">
    <li class="header">You have <?=$count?> notifications</li>
    <li>
            <ul class="menu">
                <?php foreach ($notifications as $notification) : ?>
                    <li>
                        <a href="<?=Url::to('/notification-items/view?id='.$notification['id'])?>">
                            <?=$notification['notification']['message']?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
    </li>
    <li class="footer"><a href="<?=Url::to('/notification-items/index')?>">View all</a></li>
</ul>
<?php else: ?>
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <i class="fa fa-bell-o"></i>
    <!--<span class="label label-warning">0</span>-->
</a>
<ul class="dropdown-menu">
        <li class="header">There are not any new notifications</li>
</ul>
<?php endif?>

