<?php

declare(strict_types=1);

namespace app\modules\admin\request\systemUserRole;

use OpenApi\Attributes as OA;
use think\Validate;

#[OA\Schema(
    schema: 'SystemUserRoleQueryRequest',
    required: [

    ],
    properties: [

    ]
)]
class SystemUserRoleQueryRequest extends Validate
{
    protected $rule = [

    ];

    protected $message = [

    ];
}
