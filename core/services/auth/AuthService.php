<?php

namespace core\services\auth;

use core\entities\user\Token;
use core\repositories\TokenRepository;
use core\repositories\UserRepository;
use core\entities\user\User;
use core\forms\auth\LoginForm;
use core\forms\auth\SignupForm;
use Yii;

class AuthService
{
    private $users;
    private $tokens;

    public function __construct()
    {
        $this->users = new UserRepository();
        $this->tokens = new TokenRepository();
    }

    public function signup(SignupForm $form): User
    {
        $this->users->condition(['username' => $form->username]);
        $this->users->condition(['email' => $form->email]);
        $user = $this->users->save(User::signup($form->username, $form->email, $form->password));
        $this->sendEmail($user, $form);
        return $user;
    }

    public function sendEmail(User $user, SignupForm $form)
    {
        $send = Yii::$app->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo($form->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
        if (!$send) {
            throw new \RuntimeException('None');
        }
    }

    public function auth(LoginForm $form)
    {
        $user = $this->users->getBy(['username' => $form->username]);
        if (!$user->validatePassword($form->password)) {
            throw new \DomainException('Undefined password');
        }
        $token = Token::generateToken($user['id']);
        $tokens = $this->tokens->save($token);
        return $tokens;
    }
}