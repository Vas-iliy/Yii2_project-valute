<?php

namespace app\core\services\auth;

use app\core\entities\user\Token;
use app\core\repositories\TokenRepository;
use app\core\repositories\UserRepository;
use app\core\entities\user\User;
use app\core\forms\auth\LoginForm;
use app\core\forms\auth\SignupForm;

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
        $this->tokens->save($token);
        return $token;
    }
}