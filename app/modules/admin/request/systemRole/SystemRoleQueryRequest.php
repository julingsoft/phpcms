<?php

declare(strict_types=1);

namespace app\modules\admin\request\systemRole;

use OpenApi\Attributes as OA;
use think\Validate;

#[OA\Schema(
    schema: 'SystemRoleQueryRequest',
    required: [

    ],
    properties: [

    ]
)]
class SystemRoleQueryRequest extends Validate
{
    protected $rule = [

    ];

    protected $message = [

    ];
}
