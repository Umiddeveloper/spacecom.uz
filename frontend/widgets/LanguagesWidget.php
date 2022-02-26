<?php

namespace frontend\widgets;

use Yii;
use yii\bootstrap\Widget;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 *
 * @property array $links
 */
class LanguagesWidget extends Widget
{
    public $mobile;
    private $languages;
    private $current_url;
    private $current_language;

    public function init()
    {
        $this->languages = \Yii::$app->params['cms']['languageIds'];
        $this->current_url = mb_strcut(Url::current(), 4);
        $this->current_language = Yii::$app->language;
    }

    public function run()
    {
        return $this->render('languages_template', [
            'options' => $this->getLinks(),
            'mobile' => $this->mobile,
            'getmobil' => $this->getMobile()

        ]);

    }

    private function getLinks()
    {
        foreach ($this->languages as $language => $value) {
            if ($language != $this->current_language) {
                $url = rtrim("/$language/$this->current_url", '/');
                $options[] = Html::tag('option', Html::encode(Yii::$app->params['cms']['languages'][$value]), ['value' => $url]);
            }
        }

        return $options;
    }

    private function getMobile()
    {
        foreach ($this->languages as $language => $value) {
            if ($language != $this->current_language) {
                $url = rtrim("/$language/$this->current_url", '/');
                $mobile[] = Html::a('<img style="width:20px;" alt=""> ' . Yii::$app->params['cms']['languages'][$value], $url);
            }

        }
        return $mobile;
    }



}