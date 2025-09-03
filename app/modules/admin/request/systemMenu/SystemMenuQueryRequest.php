<?php

declare(strict_types=1);

namespace app\modules\admin\request\systemMenu;

use OpenApi\Attributes as OA;
use think\Validate;

#[OA\Schema(
    schema: 'SystemMenuQueryRequest',
    required: [

    ],
    properties: [

    ]
)]
class SystemMenuQueryRequest extends Validate
{
    protected $rule = [

    ];

    protected $message = [

    ];
}
