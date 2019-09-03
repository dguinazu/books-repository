<?php

namespace App\Contracts;

use App\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * Class EloquentRepository
 * @package App\Repositories
 */
abstract class EloquentRepository implements RepositoryInterface
{
    /**
     * @var \Illuminate\Database\Connection
     */
    private $connection;

    /**
     * @var Model
     */
    protected $model;

    /**
     * EloquentRepository constructor.
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->connection = $model->getConnection();
    }

    /**
     * @param array|null $relations
     * @param Scope ...$scope
     * @return \Illuminate\Database\Eloquent\Builder|mixed
     */
    protected function buildQuery(array $relations=null, Scope ...$scope)
    {
        $relations = (is_null($relations)) ? [] : $relations;
        return $this->getModel()->newQuery()->with($relations)->scopes($scope)->applyScopes();
    }

    /**
     * @return void
     */
    public function commitTransaction()
    {
        $this->connection->commit();
    }

    /**
     * @param array $data
     * @return Model
     * @throws RepositoryException
     */
    public function create(array $data): Model
    {
        $model = $this->getModel();

        try {
            $model->fill($data);
            if (!$model->save()) {
                $model = null;
            }
        } catch (\Throwable $e) {
            throw new RepositoryException("The resource can't be created", 0, $e);
        }

        return $model;
    }

    /**
     * @param $id
     * @param Scope ...$scope
     * @return bool|mixed|null
     * @throws \Exception
     */
    public function delete($id, Scope ...$scope)
    {
        $deleted = false;

        $model = $this->getById($id, null, ...$scope);

        if ($model) {
            $deleted = $model->delete();
        }

        return $deleted;
    }

    /**
     * @param array|null $relations
     * @param Scope ...$scope
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|mixed|mixed[]
     */
    public function get(array $relations=null, Scope ...$scope)
    {
        return $this->buildQuery($relations, ...$scope)->get();
    }

    /**
     * @param $id
     * @param array|null $relations
     * @param Scope ...$scope
     * @return mixed
     */
    public function getById($id, array $relations=null, Scope ...$scope)
    {
        $keyName = $this->model->getKeyName();
        return $this->buildQuery($relations, ...$scope)->where($keyName, $id)->first();
    }

    /**
     * @return Model
     */
    protected function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function rollbackTransaction()
    {
        $this->connection->rollBack();
    }

    /**
     * @return void
     * @throws \Exception
     */
    public function startTransaction()
    {
        $this->connection->beginTransaction();
    }

    /**
     * @param $id
     * @param array $data
     * @param Scope ...$scope
     * @return Model
     * @throws RepositoryException
     */
    public function update($id, array $data, Scope ...$scope): Model
    {
        $model = $this->getById($id, null, ...$scope);

        try {
            $model->fill($data);
            if (!$model->save()) {
                $model = null;
            }
        } catch (\Throwable $e) {
            throw new RepositoryException("The resource can't be created.", 0, $e);
        }

        return $model;
    }
}