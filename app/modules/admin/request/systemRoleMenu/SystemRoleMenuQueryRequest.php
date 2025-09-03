<?php

declare(strict_types=1);

namespace app\modules\admin\request\systemRoleMenu;

use OpenApi\Attributes as OA;
use think\Validate;

#[OA\Schema(
    schema: 'SystemRoleMenuQueryRequest',
    required: [

    ],
    properties: [

    ]
)]
class SystemRoleMenuQueryRequest extends Validate
{
    protected $rule = [

    ];

    protected $message = [

    ];
}
