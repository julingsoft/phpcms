<?php

declare(strict_types=1);

namespace app\repository;

use app\entity\SystemRolePermissionEntity;
use Exception;
use Juling\Foundation\Contract\RepositoryInterface;
use Juling\Foundation\Repository\CurdRepository;
use think\Model;

class SystemRolePermissionRepository extends CurdRepository implements RepositoryInterface
{
    private static ?SystemRolePermissionRepository $instance = null;

    /**
     * 单例
     */
    public static function getInstance(): SystemRolePermissionRepository
    {
        if (is_null(self::$instance)) {
            self::$instance = new SystemRolePermissionRepository();
        }

        return self::$instance;
    }

    /**
     * 添加
     */
    public function createByEntity(SystemRolePermissionEntity $entity): int
    {
        return $this->create($entity->toArray());
    }

    /**
     * 按照ID查询返回对象
     */
    public function findOneEntityById(int $id): ?SystemRolePermissionEntity
    {
        $data = $this->findOneById($id);
        if (empty($data)) {
            return null;
        }

        $entity = new SystemRolePermissionEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 按照条件查询
     */
    public function findOneEntity(array $condition): ?SystemRolePermissionEntity
    {
        $data = $this->findOneByWhere($condition);
        if (empty($data)) {
            return null;
        }

        $entity = new SystemRolePermissionEntity();
        $entity->setData($data);

        return $entity;
    }

    /**
     * 查询列表
     *
     * @throws Exception
     */
    public function findAllEntity(array $condition = []): array
    {
        $result = $this->findAll($condition);
        if (empty($result)) {
            return [];
        }

        foreach ($result as $key => $item) {
            $entity = new SystemRolePermissionEntity();
            $entity->setData($item);
            $result[$key] = $entity;
        }

        return $result;
    }

    /**
     * 分页查询
     *
     * @throws Exception
     */
    public function paginateEntity(array $condition, int $page, int $pageSize): array
    {
        $result = $this->paginate($condition, $page, $pageSize);

        foreach ($result['data'] as $key => $item) {
            $entity = new SystemRolePermissionEntity();
            $entity->setData($item);
            $result['data'][$key] = $entity;
        }

        return $result;
    }

    /**
     * 定义数据数据模型类
     */
    public function model(string $modelName = 'SystemRolePermission'): Model
    {
        $model = '\\app\\model\\'.$modelName.'Model';

        return new $model();
    }
}
