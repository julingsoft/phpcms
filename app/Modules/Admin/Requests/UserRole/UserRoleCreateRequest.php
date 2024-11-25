<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\UserRole;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'UserRoleCreateRequest',
    required: [
        self::getTenantId,
        self::getUserId,
        self::getRoleId,
    ],
    properties: [
        new OA\Property(property: self::getTenantId, description: '租户ID', type: 'integer'),
        new OA\Property(property: self::getUserId, description: '用户ID', type: 'integer'),
        new OA\Property(property: self::getRoleId, description: '角色ID', type: 'integer'),
    ]
)]
class UserRoleCreateRequest extends FormRequest
{
    const string getTenantId = 'tenant_id';

    const string getUserId = 'user_id';

    const string getRoleId = 'role_id';

    public function rules(): array
    {
        return [
            self::getTenantId => 'require',
            self::getUserId => 'require',
            self::getRoleId => 'require',
        ];
    }

    public function messages(): array
    {
        return [
            self::getTenantId.'.require' => '请设置租户ID',
            self::getUserId.'.require' => '请设置用户ID',
            self::getRoleId.'.require' => '请设置角色ID',
        ];
    }
}
