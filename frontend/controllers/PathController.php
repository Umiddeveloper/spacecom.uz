<?php


namespace frontend\controllers;

use mihaildev\elfinder\Controller;
use mihaildev\elfinder\volume\Local;
use Yii;
use yii\helpers\ArrayHelper;

class PathController extends Controller
{
    public $roots = [];
    public $disabledCommands = ['netmount'];
    public $watermark;

    private $_options;

    public function getOptions()
    {
        $this->setRoots();

        // Below Parent`s unchanged code
        if ($this->_options !== null) {
            return $this->_options;
        }

        $this->_options['roots'] = [];

        foreach ($this->roots as $root) {
            if (is_string($root)) {
                $root = ['path' => $root];
            }
            if (!isset($root['class'])) {
                $root['class'] = Local::class;
            }

            $root = Yii::createObject($root);

            /** @var \mihaildev\elfinder\volume\Local $root */

            if ($root->isAvailable()) {
                $this->_options['roots'][] = $root->getRoot();
            }
        }

        if (!empty($this->watermark)) {
            $this->_options['bind']['upload.presave'] = 'Plugin.Watermark.onUpLoadPreSave';

            if (is_string($this->watermark)) {
                $watermark = [
                    'source' => $this->watermark
                ];
            } else {
                $watermark = $this->watermark;
            }

            $this->_options['plugin']['Watermark'] = $watermark;
        }

        $this->_options = ArrayHelper::merge($this->_options, $this->connectOptions);

        return $this->_options;
    }

    private function setRoots(): void
    {
        $params = array_merge(
            require __DIR__ . '/../../common/config/params.php',
            require __DIR__ . '/../../common/config/params-local.php'
        );

        $this->roots[] = [
            'baseUrl' => $params['storageHostInfo'],
            'basePath' => '@storageRoot',
            'path' => 'elfinder-files/coordinator-files/' . Yii::$app->user->id,
            'name' => Yii::$app->user->id
        ];
    }
}
