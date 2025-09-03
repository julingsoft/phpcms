<?php

declare(strict_types=1);

namespace app\modules\admin\request\userOauth;

use OpenApi\Attributes as OA;
use think\Validate;

#[OA\Schema(
    schema: 'UserOauthQueryRequest',
    required: [

    ],
    properties: [

    ]
)]
class UserOauthQueryRequest extends Validate
{
    protected $rule = [

    ];

    protected $message = [

    ];
}
