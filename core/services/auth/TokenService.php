<?php

namespace core\services\auth;

use core\repositories\TokenRepository;

class TokenService
{
    private $tokens;

    public function __construct()
    {
        $this->tokens = new TokenRepository();
    }

    public function editSuccessToken($refresh)
    {
        if ($tokens = $this->tokens->get($refresh)) {
            $tokens->editAccessToken();
            return $tokens;
        }
        return false;
    }
}