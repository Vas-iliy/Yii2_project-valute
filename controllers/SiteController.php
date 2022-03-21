<?php

namespace app\controllers;

use yii\rest\Controller;
use yii\web\Response;

class SiteController extends Controller
{
    public function actionIndex()
    {
        \Yii::$app->response->format = Response::FORMAT_XML;
        $items = ['one', 'two', 'three' => ['a', 'b', 'c']];
        return $items;
    }
}
