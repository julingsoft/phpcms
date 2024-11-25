<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\TenantUser;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TenantUserCreateRequest',
    required: [
        self::getTenantId,
        self::getUserId,
    ],
    properties: [
        new OA\Property(property: self::getTenantId, description: '租户ID', type: 'integer'),
        new OA\Property(property: self::getUserId, description: '用户ID', type: 'integer'),
    ]
)]
class TenantUserCreateRequest extends FormRequest
{
    const string getTenantId = 'tenant_id';

    const string getUserId = 'user_id';

    public function rules(): array
    {
        return [
            self::getTenantId => 'require',
            self::getUserId => 'require',
        ];
    }

    public function messages(): array
    {
        return [
            self::getTenantId.'.require' => '请设置租户ID',
            self::getUserId.'.require' => '请设置用户ID',
        ];
    }
}
