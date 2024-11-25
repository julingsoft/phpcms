<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\TenantUser;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TenantUserQueryRequest',
    required: [

    ],
    properties: [

    ]
)]
class TenantUserQueryRequest extends FormRequest
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
