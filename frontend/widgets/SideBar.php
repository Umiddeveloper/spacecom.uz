<?php

namespace frontend\widgets;

use yii\bootstrap\Widget;

class SideBar extends Widget
{
    public $lastItems;
    public $categories;
    public function run()
    {
        return $this->render('_sidebar',[
            'lastItems' => $this->lastItems,
            'categories' => $this->categories,
            ]);
    }

}
