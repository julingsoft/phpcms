<?php

declare(strict_types=1);

namespace app\service;

use app\repository\SystemRoleRepository;
use Juling\Foundation\Contract\ServiceInterface;
use Juling\Foundation\Service\CommonService;

class SystemRoleService extends CommonService implements ServiceInterface
{
    public function getRepository(): SystemRoleRepository
    {
        return SystemRoleRepository::getInstance();
    }
}
