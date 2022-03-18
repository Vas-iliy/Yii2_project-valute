<?php

namespace core\services\auth;

use core\entities\user\Token;
use core\repositories\TokenRepository;
use core\repositories\UserRepository;
use core\entities\user\User;
use core\forms\auth\LoginForm;
use core\forms\auth\SignupForm;

class AuthService
{
    private $users;
    private $tokens;

    public function __construct()
    {
        $this->users = new UserRepository();
        $this->tokens = new TokenRepository();
    }

    public function signup(SignupForm $form)
    {
        $this->users->condition(['username' => $form->username]);
        $this->users->condition(['email' => $form->email]);
        $user = $this->users->save(User::signup($form->username, $form->email, $form->password));
        return $user;
    }

    public function auth(LoginForm $form)
    {
        $user = $this->users->getBy(['username' => $form->username]);
        $user->validatePassword($form->password);
        $token = Token::generateToken($user['id']);
        return $this->tokens->save($token);
    }
}