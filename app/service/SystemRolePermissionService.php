<?php

declare(strict_types=1);

namespace app\service;

use app\repository\SystemRolePermissionRepository;
use Juling\Foundation\Contract\ServiceInterface;
use Juling\Foundation\Service\CommonService;

class SystemRolePermissionService extends CommonService implements ServiceInterface
{
    public function getRepository(): SystemRolePermissionRepository
    {
        return SystemRolePermissionRepository::getInstance();
    }
}
