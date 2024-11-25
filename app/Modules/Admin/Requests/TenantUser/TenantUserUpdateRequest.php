<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\TenantUser;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TenantUserUpdateRequest',
    required: [
        self::getId,
        self::getTenantId,
        self::getUserId,
    ],
    properties: [
        new OA\Property(property: self::getId, description: 'ID', type: 'integer'),
        new OA\Property(property: self::getTenantId, description: '租户ID', type: 'integer'),
        new OA\Property(property: self::getUserId, description: '用户ID', type: 'integer'),
    ]
)]
class TenantUserUpdateRequest extends FormRequest
{
    const string getId = 'id';

    const string getTenantId = 'tenant_id';

    const string getUserId = 'user_id';

    public function rules(): array
    {
        return [
            self::getId => 'require',
            self::getTenantId => 'require',
            self::getUserId => 'require',
        ];
    }

    public function messages(): array
    {
        return [
            self::getId.'.require' => '请设置ID',
            self::getTenantId.'.require' => '请设置租户ID',
            self::getUserId.'.require' => '请设置用户ID',
        ];
    }
}
