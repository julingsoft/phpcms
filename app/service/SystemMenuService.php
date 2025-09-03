<?php

declare(strict_types=1);

namespace app\service;

use app\repository\SystemMenuRepository;
use Juling\Foundation\Contract\ServiceInterface;
use Juling\Foundation\Service\CommonService;

class SystemMenuService extends CommonService implements ServiceInterface
{
    public function getRepository(): SystemMenuRepository
    {
        return SystemMenuRepository::getInstance();
    }
}
