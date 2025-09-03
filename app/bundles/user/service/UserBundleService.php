<?php

declare(strict_types=1);

namespace app\bundles\user\service;

use app\entity\UserEntity;
use app\service\UserService;

class UserBundleService extends UserService
{
    public function test(): array
    {
        $userEntity = new UserEntity();
        $userEntity->setId(1);
        $userEntity->setLastLoginIp('127.0.0.1');
        return $userEntity->toEntity();
    }
}
