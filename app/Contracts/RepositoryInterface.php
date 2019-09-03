<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

/**
 * Interface RepositoryInterface
 * @package App\Contracts
 */
interface RepositoryInterface
{
    /**
     * @return mixed
     */
    public function commitTransaction();

    /**
     * @param array $data
     * @return Model
     */
    public function create (array $data): Model;

    /**
     * @param $id
     * @param Scope ...$scope
     * @return mixed
     */
    public function delete ($id, Scope ...$scope);

    /**
     * @param array|null $relations
     * @param Scope ...$scope
     * @return mixed
     */
    public function get(array $relations=null, Scope ...$scope);

    /**
     * @param $id
     * @param array|null $relations
     * @param Scope ...$scope
     * @return mixed
     */
    public function getById ($id, array $relations=null, Scope ...$scope);

    /**
     * @param $id
     * @param array $data
     * @param Scope ...$scope
     * @return Model
     */
    public function update ($id, array $data, Scope ...$scope): Model;

    /**
     * @return mixed
     */
    public function rollbackTransaction();

    /**
     * @return mixed
     */
    public function startTransaction();
}