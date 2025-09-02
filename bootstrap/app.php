<?php

$app = new think\App();
$app->env->set([
    'APP_NAME' => 'PHPCMS',
    'RELEASE' => '20250902',
    'VERSION' => 'v1.0.0',
]);
return $app;
