<?php

declare(strict_types=1);

namespace app\controller;

use app\bundles\user\service\UserBundleService;

class AboutController extends BaseController
{
    public function index()
    {
        $userBundleService = new UserBundleService();
        return json_encode($userBundleService->test());
    }
}
