<?php

namespace core\repositories;

use core\entities\user\Token;
use yii\web\NotFoundHttpException;

class TokenRepository
{
    public function save(Token $token)
    {
        return $token->save();
    }

    public function get($refreshToken)
    {
        return Token::find()->andWhere(['refresh_token' => $refreshToken])->limit(1)->one();
    }
}