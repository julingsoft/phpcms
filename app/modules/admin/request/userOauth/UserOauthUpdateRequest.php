<?php

declare(strict_types=1);

namespace app\modules\admin\request\userOauth;

use OpenApi\Attributes as OA;
use think\Validate;

#[OA\Schema(
    schema: 'UserOauthUpdateRequest',
    required: [
        'id',
        'create_time',
        'update_time',
        'delete_time',
    ],
    properties: [
        new OA\Property(property: 'id', description: 'ID', type: 'integer'),
        new OA\Property(property: 'create_time', description: '', type: 'string'),
        new OA\Property(property: 'update_time', description: '', type: 'string'),
        new OA\Property(property: 'delete_time', description: '', type: 'string'),
    ]
)]
class UserOauthUpdateRequest extends Validate
{
    protected $rule = [
        'id' => 'require',
        'create_time' => 'require',
        'update_time' => 'require',
        'delete_time' => 'require',
    ];

    protected $message = [
        'id.require' => '请设置ID',
        'create_time.require' => '请设置',
        'update_time.require' => '请设置',
        'delete_time.require' => '请设置',
    ];
}
