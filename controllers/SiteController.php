<?php

namespace app\controllers;

use yii\rest\Controller;

class SiteController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return 'home';
    }
}
