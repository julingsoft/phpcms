<?php

declare(strict_types=1);

namespace app\modules\admin\controller;

use app\bundles\system\service\SystemRolePermissionBundleService;
use app\entity\SystemRolePermissionEntity;
use app\modules\admin\request\systemRolePermission\SystemRolePermissionCreateRequest;
use app\modules\admin\request\systemRolePermission\SystemRolePermissionQueryRequest;
use app\modules\admin\request\systemRolePermission\SystemRolePermissionUpdateRequest;
use app\modules\admin\response\systemRolePermission\SystemRolePermissionQueryResponse;
use app\modules\admin\response\systemRolePermission\SystemRolePermissionResponse;
use Juling\Foundation\Exception\CustomException;
use OpenApi\Attributes as OA;
use think\facade\Db as DB;
use think\facade\Log;
use think\Response;
use Throwable;

class SystemRolePermissionController extends BaseController
{
    #[OA\Post(path: '/systemRolePermission/query', summary: '查询列表接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\Parameter(name: 'page', description: '当前页码', in: 'query', required: true, example: 1)]
    #[OA\Parameter(name: 'pageSize', description: '每页分页数', in: 'query', required: false, example: 10)]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SystemRolePermissionQueryRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: SystemRolePermissionQueryResponse::class))]
    public function query(): Response
    {
        try {
            $request = $this->request->get();
            $page = intval($this->request->param('page', 1));
            $pageSize = intval($this->request->param('pageSize', 10));

            $v = new SystemRolePermissionQueryRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $condition = [
                //
            ];

            $systemRolePermissionBundleService = new SystemRolePermissionBundleService();
            $result = $systemRolePermissionBundleService->page($condition, $page, $pageSize);

            foreach ($result['data'] as $key => $item) {
                $response = new SystemRolePermissionResponse();
                $response->setData($item);
                $result['data'][$key] = $response->toArray();
            }

            return $this->success($result);
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('查询列表错误');
        }
    }

    #[OA\Post(path: '/systemRolePermission/create', summary: '新增接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SystemRolePermissionCreateRequest::class))]
    #[OA\Response(response: 200, description: 'OK')]
    public function create(): Response
    {
        DB::startTrans();
        try {
            $request = $this->request->get();

            $v = new SystemRolePermissionCreateRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $systemRolePermissionEntity = new SystemRolePermissionEntity();
            $systemRolePermissionEntity->setData($request);

            $systemRolePermissionBundleService = new SystemRolePermissionBundleService();
            $insertId = $systemRolePermissionBundleService->save($systemRolePermissionEntity->toArray());
            if ($insertId > 0) {
                DB::commit();

                return $this->success('新增数据成功');
            }

            throw new CustomException('新增数据失败');
        } catch (Throwable $e) {
            DB::rollback();

            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('新增数据错误');
        }
    }

    #[OA\Get(path: '/systemRolePermission/show', summary: '获取详情接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: SystemRolePermissionResponse::class))]
    public function show(): Response
    {
        try {
            $id = intval($this->request->param('id', 0));

            $condition = [
                ['id', '=', $id],
            ];

            $systemRolePermissionBundleService = new SystemRolePermissionBundleService();
            $systemRolePermission = $systemRolePermissionBundleService->getOne($condition);

            if (empty($systemRolePermission)) {
                throw new CustomException('数据不存在或状态异常');
            }

            $response = new SystemRolePermissionResponse();
            $response->setData($systemRolePermission);

            return $this->success($response->toArray());
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('获取详情错误');
        }
    }

    #[OA\Put(path: '/systemRolePermission/update', summary: '更新接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SystemRolePermissionUpdateRequest::class))]
    #[OA\Response(response: 200, description: 'OK')]
    public function update(): Response
    {
        DB::startTrans();
        try {
            $request = $this->request->get();

            $v = new SystemRolePermissionUpdateRequest();
            if (! $v->check($request)) {
                throw new CustomException($v->getError());
            }

            $systemRolePermissionBundleService = new SystemRolePermissionBundleService();
            $systemRolePermission = $systemRolePermissionBundleService->getById($request['id']);
            if (empty($systemRolePermission)) {
                throw new CustomException('数据不存在或状态异常');
            }

            $systemRolePermissionEntity = new SystemRolePermissionEntity();
            $systemRolePermissionEntity->setData($request);

            $systemRolePermissionBundleService->update($systemRolePermissionEntity->toArray(), [
                ['id', '=', $request['id']],
            ]);

            DB::commit();

            return $this->success('更新数据成功');
        } catch (Throwable $e) {
            DB::rollback();

            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('更新数据错误');
        }
    }

    #[OA\Delete(path: '/systemRolePermission/destroy', summary: '删除接口', security: [['bearerAuth' => []]], tags: ['模块'])]
    #[OA\Parameter(name: 'id', description: 'ID', in: 'query', required: true, example: 1)]
    #[OA\Response(response: 200, description: 'OK')]
    public function destroy(): Response
    {
        DB::startTrans();
        try {
            $id = intval($this->request->param('id', 0));

            $condition = [
                ['id', '=', $id],
            ];

            $systemRolePermissionBundleService = new SystemRolePermissionBundleService();
            if ($systemRolePermissionBundleService->remove($condition)) {
                DB::commit();

                return $this->success('删除数据成功');
            }

            throw new CustomException('删除数据失败');
        } catch (Throwable $e) {
            DB::rollback();

            if ($e instanceof CustomException) {
                return $this->error($e->getMessage());
            }

            Log::error($e);

            return $this->error('删除数据错误');
        }
    }
}
