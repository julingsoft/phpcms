<?php

declare(strict_types=1);

namespace app\service;

use app\repository\UserOauthRepository;
use Juling\Foundation\Contract\ServiceInterface;
use Juling\Foundation\Service\CommonService;

class UserOauthService extends CommonService implements ServiceInterface
{
    public function getRepository(): UserOauthRepository
    {
        return UserOauthRepository::getInstance();
    }
}
