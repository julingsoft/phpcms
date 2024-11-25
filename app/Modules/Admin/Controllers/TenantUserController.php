<?php

declare(strict_types=1);

namespace App\Modules\Admin\Controllers;

use App\Modules\Admin\Requests\TenantUser\TenantUserCreateRequest;
use App\Modules\Admin\Requests\TenantUser\TenantUserQueryRequest;
use App\Modules\Admin\Requests\TenantUser\TenantUserUpdateRequest;
use App\Modules\Admin\Responses\TenantUser\TenantUserDestroyResponse;
use App\Modules\Admin\Responses\TenantUser\TenantUserQueryResponse;
use App\Modules\Admin\Responses\TenantUser\TenantUserResponse;
use App\Entities\TenantUserEntity;
use App\Exceptions\CustomException;
use App\Services\TenantUserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Juling\Foundation\Enums\BusinessEnum;
use OpenApi\Attributes as OA;
use Throwable;

class TenantUserController extends BaseController
{
    #[OA\Post(path: '/tenantUser/query', summary: '查询列表接口', security: [['bearerAuth' => []]], tags: ['租户用户模块'])]
    #[OA\Parameter(name: 'page', description: '当前页码', in: 'query', required: true, example: 1)]
    #[OA\Parameter(name: 'pageSize', description: '每页分页数', in: 'query', required: false, example: 10)]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: TenantUserQueryRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: TenantUserQueryResponse::class))]
    public function query(TenantUserQueryRequest $queryRequest): JsonResponse
    {
        $page = intval($queryRequest->query('page', 1));
        $pageSize = intval($queryRequest->query('pageSize', 10));
        $request = $queryRequest->validated();

        try {
            $condition = [];

            $tenantUserService = new TenantUserService;
            $result = $tenantUserService->page($condition, $page, $pageSize);

            foreach ($result['data'] as $key => $item) {
                $response = new TenantUserResponse($item);
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

    #[OA\Post(path: '/tenantUser/store', summary: '新增接口', security: [['bearerAuth' => []]], tags: ['租户用户模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: TenantUserCreateRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: TenantUserResponse::class))]
    public function store(TenantUserCreateRequest $createRequest): JsonResponse
    {
        $request = $createRequest->validated();

        DB::beginTransaction();
        try {
            $input = new TenantUserEntity($request);

            $tenantUserService = new TenantUserService;
            if ($tenantUserService->save($input->toArray())) {
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

    #[OA\Get(path: '/tenantUser/show', summary: '获取详情接口', security: [['bearerAuth' => []]], tags: ['租户用户模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: TenantUserResponse::class))]
    public function show(Request $request): JsonResponse
    {
        $id = intval($request->query('id', 0));

        try {
            $tenantUserService = new TenantUserService;
            $tenantUser = $tenantUserService->getOneById($id);
            if (empty($tenantUser)) {
                throw new CustomException(BusinessEnum::NOT_FOUND);
            }

            $response = new TenantUserResponse($tenantUser);

            return $this->success($response->toArray());
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e);
            }

            Log::error($e);

            return $this->error(BusinessEnum::SHOW_ERROR);
        }
    }

    #[OA\Put(path: '/tenantUser/update', summary: '更新接口', security: [['bearerAuth' => []]], tags: ['租户用户模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: TenantUserUpdateRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: TenantUserResponse::class))]
    public function update(TenantUserUpdateRequest $updateRequest): JsonResponse
    {
        $request = $updateRequest->validated();
        $id = intval($request->query('id', 0));

        DB::beginTransaction();
        try {
            $tenantUserService = new TenantUserService;
            $tenantUser = $tenantUserService->getOneById($id);
            if (empty($tenantUser)) {
                throw new CustomException(BusinessEnum::NOT_FOUND);
            }

            $input = new TenantUserEntity($request);

            $tenantUserService->updateById($input->toArray(), $id);

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

    #[OA\Delete(path: '/tenantUser/destroy', summary: '删除接口', security: [['bearerAuth' => []]], tags: ['租户用户模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: TenantUserDestroyResponse::class))]
    public function destroy(Request $request): JsonResponse
    {
        $id = intval($request->query('id', 0));

        DB::beginTransaction();
        try {
            $tenantUserService = new TenantUserService;
            $tenantUser = $tenantUserService->getOneById($id);
            if (empty($tenantUser)) {
                throw new CustomException(BusinessEnum::NOT_FOUND);
            }

            if ($tenantUserService->removeById($id)) {
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
