<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\RolePermission;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'RolePermissionQueryRequest',
    required: [

    ],
    properties: [

    ]
)]
class RolePermissionQueryRequest extends FormRequest
{
    public function rules(): array
    {
        return [

        ];
    }

    public function messages(): array
    {
        return [

        ];
    }
}
