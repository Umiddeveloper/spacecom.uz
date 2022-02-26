<?php
/* @var $links */
/* @var $mobile */
?>

<?php if ($mobile): ?>
    <?php foreach ($getmobil as $mobil): ?>
        <li>
            <?= $mobil ?>
        </li>
    <?php endforeach; ?>
<?php else: ?>
    <?php foreach ($options as $option): ?>
        <?= $option ?>
    <?php endforeach; ?>
<?php endif; ?>
