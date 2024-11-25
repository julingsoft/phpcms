<?php

declare(strict_types=1);

namespace App\Modules\Admin\Requests\Tenant;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'TenantQueryRequest',
    required: [

    ],
    properties: [

    ]
)]
class TenantQueryRequest extends FormRequest
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
