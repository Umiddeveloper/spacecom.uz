<?php

namespace frontend\controllers;

use afzalroq\cms\entities\Entities;
use afzalroq\cms\entities\front\Comments;
use afzalroq\cms\entities\front\Items;
use afzalroq\cms\entities\front\Options;
use afzalroq\cms\entities\OaI;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\Controller;

class CController extends Controller
{

    public function actionCollection(string $c)
    {

    }

    public function actionOption(string $c, string $o)
    {
        if ($c === 'category') {
            $typeOption = Options::findOne(['slug' => $o]);
            $typeOptionIds = OaI::find()->select('item_id')->where(['option_id' => $typeOption->id])->column();
            return $this->render('pages-list', [
                'articles' => new ActiveDataProvider([
                    'query' => Items::find()
                        ->where(['id' => $typeOptionIds])
                        ->andWhere(['!=', 'text_1' . "_" . \Yii::$app->params['l'][\Yii::$app->language], ""])
                        ->orderBy('date_0 DESC'),
                    'pagination' => [
                        'pageSize' => 6,
                    ],
                ]),
                'entity' => $typeOption,
            ]);
        }

        if ($c === 'tags') {
            $typeOption = Options::findOne(['slug' => $o]);
            $typeOptionIds = OaI::find()->select('item_id')->where(['option_id' => $typeOption->id])->column();
            return $this->render('pages-list', [
                'articles' => new ActiveDataProvider([
                    'query' => Items::find()
                        ->where(['id' => $typeOptionIds])
                        ->andWhere(['!=', 'text_1' . "_" . \Yii::$app->params['l'][\Yii::$app->language], ""])
                        ->orderBy('date_0 DESC'),
                    'pagination' => [
                        'pageSize' => 6,
                    ],
                ]),
                'entity' => $typeOption,
            ]);
        }
    }

    public function actionEntity(string $e)
    {
        if (in_array($e, ['pages', 'teaching-materials', 'presentations', 'presentations', 'meetings', 'published-meterials', 'educational', 'promotions', 'sertificates', 'media-video'])) {
            return $this->render('pages-list', [
                'articles' => new ActiveDataProvider([
                    'query' => Items::find()
                        ->where(['entity_id' => Entities::findOne(['slug' => $e])->id])
                        ->andWhere(['!=', 'text_1' . "_" . \Yii::$app->params['l'][\Yii::$app->language], ""])
                        ->orderBy('date_0 DESC'),
                    'pagination' => [
                        'pageSize' => 6,
                    ],
                ]),
                'entity' => Entities::findOne(['slug' => $e]),
            ]);
        }
        if ($e === 'news') {
            return $this->render('pages-list', [
                'articles' => new ActiveDataProvider([
                    'query' => Items::find()
                        ->where(['entity_id' => Entities::findOne(['slug' => 'news'])->id])
                        ->andWhere(['!=', 'text_1' . "_" . \Yii::$app->params['l'][\Yii::$app->language], ""])
                        ->andWhere(['<', 'date' . "_" . \Yii::$app->params['l'][\Yii::$app->language], time()])
                        ->orderBy('date_0 DESC'),
                    'pagination' => [
                        'pageSize' => 6,
                    ],
                ]),
                'entity' => Entities::findOne(['slug' => $e]),
            ]);
        }

        if ($e === 'photo-gallery') {
            return $this->render('gallery-list', [
                'articles' => new ActiveDataProvider([
                    'query' => Items::find()
                        ->where(['entity_id' => Entities::findOne(['slug' => $e])->id])
                        ->andWhere(['!=', 'text_1' . "_" . \Yii::$app->params['l'][\Yii::$app->language], ""])
                        ->andWhere(['<', 'date' . "_" . \Yii::$app->params['l'][\Yii::$app->language], time()])
                        ->orderBy('date_0 DESC'),
                    'pagination' => [
                        'pageSize' => 6,
                    ],
                ]),
                'entity' => Entities::findOne(['slug' => $e]),
            ]);
        }
    }

    public function actionItem(string $e, int $i)
    {
        if (in_array($e, ['pages', 'news', 'teaching-materials', 'presentations', 'presentations', 'meetings', 'published-meterials', 'educational', 'promotions', 'sertificates', 'media-video'])) {
            $item = Items::findOne($i);
            $entity = Entities::findOne(['slug' => $e]);
            $title = isset($item->options['category']) ? Options::findOne($item->options['category']) : Entities::findOne(['slug' => $e]);

            $comment = new Comments($entity, $item);
            $request = Yii::$app->request;
            $comments = $item->getComments()->getModels();

            if ($request->isPost) {
                if ($comment->load($request->post()) and $comment->save()) {
                    Yii::$app->session->setFlash('success', 'Comment added.');
                    return $this->refresh();
                } else {
                    return $this->render('pages-single', [
                        'item' => $item,
                        'entity' => $entity,
                        'title' => $title,
                        'tags' => isset($item->options['tags']) ? Options::find()->where(['id' => $item->options['tags']])->all() : '',
                        'comment' => $comment,
                        'comments' => $comments,
                    ]);
                }
            }

            return $this->render('pages-single', [
                'item' => $item,
                'entity' => $entity,
                'title' => $title,
                'tags' => isset($item->options['tags']) ? Options::find()->where(['id' => $item->options['tags']])->all() : '',
                'comment' => $comment,
                'comments' => $comments,
            ]);
        }

        if ($e === 'photo-gallery') {
            $item = Items::findOne($i);
            $entity = Entities::findOne(['slug' => $e]);
            $title = isset($item->options['category']) ? Options::findOne($item->options['category']) : Entities::findOne(['slug' => $e]);

            $comment = new Comments($entity, $item);
            $request = Yii::$app->request;
            $comments = $item->getComments()->getModels();

            if ($request->isPost) {
                if ($comment->load($request->post()) and $comment->save()) {
                    Yii::$app->session->setFlash('success', 'Comment added.');
                    return $this->refresh();
                } else {
                    return $this->render('pages-single', [
                        'item' => $item,
                        'entity' => $entity,
                        'title' => $title,
                        'tags' => isset($item->options['tags']) ? Options::find()->where(['id' => $item->options['tags']])->all() : '',
                        'comment' => $comment,
                        'comments' => $comments,
                    ]);
                }
            }

            return $this->render('gallery', [
                'item' => $item,
                'entity' => $entity,
                'comment' => $comment,
                'comments' => $comments,

            ]);

        }
    }
}
