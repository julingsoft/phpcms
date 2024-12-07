<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\UserPermission;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'UserPermissionQueryRequest',
    required: [

    ],
    properties: [

    ]
)]
class UserPermissionQueryRequest extends FormRequest
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
