<?php

namespace frontend\widgets;

use abdualiym\cms\entities\Menu;
use yii\bootstrap\Widget;
use yii\helpers\VarDumper;

class FooterWidget extends Widget
{

    public function run()
    {
        return $this->render('footer_template');
    }
}
