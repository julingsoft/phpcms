<?php

declare(strict_types=1);

use think\App;

$app = new App;
$app->env->set([
    'APP_NAME' => 'PHPCMS',
    'APP_VERSION' => '1.0.0',
    'APP_RELEASE' => '20261014',
]);

return $app;
