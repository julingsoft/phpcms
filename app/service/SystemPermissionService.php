<?php

declare(strict_types=1);

namespace app\service;

use app\repository\SystemPermissionRepository;
use Juling\Foundation\Contract\ServiceInterface;
use Juling\Foundation\Service\CommonService;

class SystemPermissionService extends CommonService implements ServiceInterface
{
    public function getRepository(): SystemPermissionRepository
    {
        return SystemPermissionRepository::getInstance();
    }
}
