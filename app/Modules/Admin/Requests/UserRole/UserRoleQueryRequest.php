<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\UserRole;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'UserRoleQueryRequest',
    required: [

    ],
    properties: [

    ]
)]
class UserRoleQueryRequest extends FormRequest
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
