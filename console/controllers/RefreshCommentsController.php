<?php


namespace console\controllers;


use afzalroq\cms\entities\Entities;
use afzalroq\cms\entities\Items;
use yii\console\Controller;

class RefreshCommentsController extends Controller
{
    public function actionIndex()
    {
        $entities = Entities::findAll(['use_comments' => [Entities::COMMENT_ON, Entities::COMMENT_ON_REQUIRED]]);
        \Yii::$app->language = 'ru';
        foreach ($entities as $entity) {
            $items = Items::findAll(['entity_id' => $entity->id]);
            foreach ($items as $item) {
                $item->calculateCommentsAndVotes();
            }
        }
        $this->stdout('Done!' . PHP_EOL);
    }
}