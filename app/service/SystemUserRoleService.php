<?php

declare(strict_types=1);

namespace app\service;

use app\repository\SystemUserRoleRepository;
use Juling\Foundation\Contract\ServiceInterface;
use Juling\Foundation\Service\CommonService;

class SystemUserRoleService extends CommonService implements ServiceInterface
{
    public function getRepository(): SystemUserRoleRepository
    {
        return SystemUserRoleRepository::getInstance();
    }
}
