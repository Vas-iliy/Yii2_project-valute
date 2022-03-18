<?php

namespace app\core\entities\user;

use yii\db\ActiveRecord;

class Token extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%user_tokens}}';
    }

    public static function generateToken($id)
    {
        $token = new static();
        $token->expire = time() + \Yii::$app->params['expired.token'];
        $token->access_token = \Yii::$app->security->generateRandomString();
        $token->refresh_token = \Yii::$app->security->generateRandomString();
        $token->user_id = $id;
        return $token;
    }

    public function editAccessToken()
    {
        $this->access_token = \Yii::$app->security->generateRandomString();
        $this->expire = time() + \Yii::$app->params['expired.token'];
    }
}