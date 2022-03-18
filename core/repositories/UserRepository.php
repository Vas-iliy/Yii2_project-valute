<?php

namespace core\repositories;

use core\entities\user\User;
use yii\web\NotFoundHttpException;

class UserRepository
{
    public function save(User $user)
    {
        if (!$user->save()) throw new \RuntimeException('saving error.');
        return $user;
    }

    public function getBy($condition)
    {
        if (!$user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new NotFoundHttpException('User not found');
        }
        return $user;
    }

    public function condition($condition)
    {
        if ($user = User::find()->andWhere($condition)->limit(1)->one()) {
            throw new \DomainException('User not found');
        }
    }

    public function getUser($user)
    {
        if (!$user) throw new \DomainException('User not found');
        return $user;
    }
}