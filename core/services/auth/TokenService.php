<?php

namespace app\core\services\auth;

use app\core\repositories\TokenRepository;

class TokenService
{
    private $tokens;

    public function __construct()
    {
        $this->tokens = new TokenRepository();
    }

    public function editSuccessToken($refresh)
    {
        if ($token = $this->tokens->get($refresh)) {
            $token->editAccessToken();
            $this->tokens->save($token);
            return $token;
        }
        return false;
    }
}