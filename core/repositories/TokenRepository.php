<?php

namespace app\core\repositories;

use app\core\entities\user\Token;

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