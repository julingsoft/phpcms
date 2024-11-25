<?php

declare(strict_types=1);

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Requests\Tenant\TenantCreateRequest;
use App\Modules\Admin\Requests\Tenant\TenantQueryRequest;
use App\Modules\Admin\Requests\Tenant\TenantUpdateRequest;
use App\Modules\Admin\Responses\Tenant\TenantDestroyResponse;
use App\Modules\Admin\Responses\Tenant\TenantQueryResponse;
use App\Modules\Admin\Responses\Tenant\TenantResponse;
use App\Entities\TenantEntity;
use App\Exceptions\CustomException;
use App\Services\TenantService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Juling\Foundation\Enums\BusinessEnum;
use OpenApi\Attributes as OA;
use Throwable;

class TenantController extends BaseController
{
    #[OA\Post(path: '/tenant/query', summary: '查询列表接口', security: [['bearerAuth' => []]], tags: ['租户模块'])]
    #[OA\Parameter(name: 'page', description: '当前页码', in: 'query', required: true, example: 1)]
    #[OA\Parameter(name: 'pageSize', description: '每页分页数', in: 'query', required: false, example: 10)]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: TenantQueryRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: TenantQueryResponse::class))]
    public function query(TenantQueryRequest $queryRequest): JsonResponse
    {
        $page = intval($queryRequest->query('page', 1));
        $pageSize = intval($queryRequest->query('pageSize', 10));
        $request = $queryRequest->validated();

        try {
            $condition = [];

            $tenantService = new TenantService;
            $result = $tenantService->page($condition, $page, $pageSize);

            foreach ($result['data'] as $key => $item) {
                $response = new TenantResponse($item);
                $result['data'][$key] = $response->toArray();
            }

            return $this->success($result);
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e);
            }

            Log::error($e);

            return $this->error(BusinessEnum::QUERY_ERROR);
        }
    }

    #[OA\Post(path: '/tenant/store', summary: '新增接口', security: [['bearerAuth' => []]], tags: ['租户模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: TenantCreateRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: TenantResponse::class))]
    public function store(TenantCreateRequest $createRequest): JsonResponse
    {
        $request = $createRequest->validated();

        DB::beginTransaction();
        try {
            $input = new TenantEntity($request);

            $tenantService = new TenantService;
            if ($tenantService->save($input->toArray())) {
                DB::commit();

                return $this->success();
            }

            throw new CustomException(BusinessEnum::CREATE_FAIL);
        } catch (Throwable $e) {
            DB::rollBack();

            if ($e instanceof CustomException) {
                return $this->error($e);
            }

            Log::error($e);

            return $this->error(BusinessEnum::CREATE_ERROR);
        }
    }

    #[OA\Get(path: '/tenant/show', summary: '获取详情接口', security: [['bearerAuth' => []]], tags: ['租户模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: TenantResponse::class))]
    public function show(Request $request): JsonResponse
    {
        $id = intval($request->query('id', 0));

        try {
            $tenantService = new TenantService;
            $tenant = $tenantService->getOneById($id);
            if (empty($tenant)) {
                throw new CustomException(BusinessEnum::NOT_FOUND);
            }

            $response = new TenantResponse($tenant);

            return $this->success($response->toArray());
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e);
            }

            Log::error($e);

            return $this->error(BusinessEnum::SHOW_ERROR);
        }
    }

    #[OA\Put(path: '/tenant/update', summary: '更新接口', security: [['bearerAuth' => []]], tags: ['租户模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: TenantUpdateRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: TenantResponse::class))]
    public function update(TenantUpdateRequest $updateRequest): JsonResponse
    {
        $request = $updateRequest->validated();
        $id = intval($request->query('id', 0));

        DB::beginTransaction();
        try {
            $tenantService = new TenantService;
            $tenant = $tenantService->getOneById($id);
            if (empty($tenant)) {
                throw new CustomException(BusinessEnum::NOT_FOUND);
            }

            $input = new TenantEntity($request);

            $tenantService->updateById($input->toArray(), $id);

            DB::commit();

            return $this->success();
        } catch (Throwable $e) {
            DB::rollBack();

            if ($e instanceof CustomException) {
                return $this->error($e);
            }

            Log::error($e);

            return $this->error(BusinessEnum::UPDATE_ERROR);
        }
    }

    #[OA\Delete(path: '/tenant/destroy', summary: '删除接口', security: [['bearerAuth' => []]], tags: ['租户模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: TenantDestroyResponse::class))]
    public function destroy(Request $request): JsonResponse
    {
        $id = intval($request->query('id', 0));

        DB::beginTransaction();
        try {
            $tenantService = new TenantService;
            $tenant = $tenantService->getOneById($id);
            if (empty($tenant)) {
                throw new CustomException(BusinessEnum::NOT_FOUND);
            }

            if ($tenantService->removeById($id)) {
                DB::commit();

                return $this->success();
            }

            throw new CustomException(BusinessEnum::DESTROY_FAIL);
        } catch (Throwable $e) {
            DB::rollBack();

            if ($e instanceof CustomException) {
                return $this->error($e);
            }

            Log::error($e);

            return $this->error(BusinessEnum::DESTROY_ERROR);
        }
    }
}
