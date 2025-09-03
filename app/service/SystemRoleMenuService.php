<?php

declare(strict_types=1);

namespace app\service;

use app\repository\SystemRoleMenuRepository;
use Juling\Foundation\Contract\ServiceInterface;
use Juling\Foundation\Service\CommonService;

class SystemRoleMenuService extends CommonService implements ServiceInterface
{
    public function getRepository(): SystemRoleMenuRepository
    {
        return SystemRoleMenuRepository::getInstance();
    }
}
