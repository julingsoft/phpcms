<?php

declare(strict_types=1);

namespace app\modules\admin\request\systemRolePermission;

use OpenApi\Attributes as OA;
use think\Validate;

#[OA\Schema(
    schema: 'SystemRolePermissionQueryRequest',
    required: [

    ],
    properties: [

    ]
)]
class SystemRolePermissionQueryRequest extends Validate
{
    protected $rule = [

    ];

    protected $message = [

    ];
}
