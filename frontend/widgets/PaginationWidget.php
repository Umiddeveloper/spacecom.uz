<?php

namespace frontend\widgets;

use yii\bootstrap\Widget;

class PaginationWidget extends Widget
{
    public $page;
    public function run()
    {
        return $this->render('_pagination',['page' => $this->page]);
    }

}
